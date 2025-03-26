<?php

namespace App\Http\Controllers;

use App\Models\Term;
use App\Models\Session;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $session_id = Session::where('status', 1)->value('id') ?? 0;
        $term_id = Term::where('status', 1)->value('id') ?? 0;
        $today = now()->toDateString();
        if(auth()->user()->hasRole('admin')){
            if(!$request->has('session_id', 'term_id', 'class_id','date')){
                $attendances = Attendance::with('session','term','class', 'user', 'student')
                    ->where(['session_id' => $session_id, 'term_id' => $term_id, 'date' => $today])->get();
                $students = Student::with('attendances')->get();

            }else{
                $attendances = Attendance::with('session','term','class', 'user', 'student')
                    ->where(['session_id' => $request->session_id,
                    'term_id' => $request->term_id, 'class_id' => $request->class_id, 'date' => $request->date])->get();
            }
        }else{
            if(!$request->has('session_id', 'term_id', 'class_id','date')){
                $attendances = Attendance::with('session','term','class', 'user', 'student')
                    ->where(['session_id' => $session_id, 'term_id' => $term_id, 'staff_id' => auth()->user()->id, 'date' => $today])->get();
                    $students = Student::with('attendances')->get();
            }else{
                $attendances = Attendance::with('session','term','class', 'user', 'student')
                    ->where(['session_id' => $request->session_id,
                    'term_id' => $request->term_id, 'class_id' => $request->class_id, 'date' => $request->date])->get();
            }
        }
        return view('attendance.index', compact('attendances','students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }


    public function markAttendance(Request $request)
    {
        // Fetch the class allocation details
        $allocation = DB::table('class_allocations')->where('id', $request->allocation_id)->first();

        if (!$allocation) {
            return back()->with('error', 'Class allocation not found.');
        }

        $today = now()->toDateString();

        // Fetch students for this class, session, and term
        $students = DB::table('students')
            ->where('class_id', $allocation->class_id)
            ->where('wing', $allocation->wing)
            ->where('session_id', $allocation->session_id)
            ->get();

        foreach ($students as $student) {
            // Check if attendance record already exists for today
            $exists = DB::table('attendances')
                ->where('student_id', $student->id)
                ->where('date', $today)
                ->exists();

            if (!$exists) {
                // If attendance doesn't exist, insert as "Absent"
                DB::table('attendances')->insert([
                    'student_id' => $student->id,
                    'admission_no' => $student->admission_no,
                    'class_id' => $allocation->class_id,
                    'term_id' => $allocation->term_id,
                    'wing' => $allocation->wing,
                    'staff_id' => auth()->id(),
                    'session_id' => $allocation->session_id,
                    'active_status' => 'absent',
                    'status' => 1, // Default to Absent
                    'date' => $today,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Retrieve attendance records after ensuring all students are listed
        $attendances = Attendance::with('student')
            ->where('class_id', $allocation->class_id)
            ->where('session_id', $allocation->session_id)
            ->where('term_id', $allocation->term_id)
            ->where('date', $today)
            ->get();

        return view('attendance.mark', compact('attendances', 'allocation'));
    }


    public function updateAttendance(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required',
            'session_id' => 'required',
            'term_id' => 'required',
            'attendance' => 'nullable|array'
        ]);

        // Get all students in this class for today
        $students = DB::table('attendances')
            ->where('class_id', $validated['class_id'])
            ->where('session_id', $validated['session_id'])
            ->where('term_id', $validated['term_id'])
            ->where('date', now()->toDateString())
            ->get();

        foreach ($students as $student) {
            $status = isset($validated['attendance'][$student->student_id]) ? 'present' : 'absent';

            DB::table('attendances')
                ->where('student_id', $student->student_id)
                ->where('date', now()->toDateString())
                ->update(['active_status' => $status]);
        }

        return back()->with('success', 'Attendance saved.');
    }





}
