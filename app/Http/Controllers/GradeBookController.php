<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Term;
use App\Models\Classes;
use App\Models\Session;
use App\Models\Student;
use App\Models\Subject;
use App\Models\GradeBook;
use Illuminate\Http\Request;
use App\Models\ActivateUpload;
use App\Models\SubjectAllocation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GradeBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(GradeBook $gradeBook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GradeBook $gradeBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GradeBook $gradeBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GradeBook $gradeBook)
    {
        //
    }


    public function getStudentResult(Request $request){
        // $grades = GradeBook::where([
        //     'student_id' => $request->student_id,
        //     'class_id' => $request->class_id,
        //     'session_id' => $request->session_id,
        //     'term_id' => $request->term_id,
        // ])->get();
        // $request->validate(['session_id' => 'required|integer', 'term_id' => 'required|integer', 'student_id' => 'required|integer']);
        $grades = GradeBook::where([
            'student_id' => $request->student_id,
            'session_id' => $request->session_id,
            'term_id' => $request->term_id
        ])->get();
        $count_subjects = count($grades);
        $remarks = GradeBook::with(['student', 'class', 'term', 'session', 'subject'])
            ->select('student_id','class_id','session_id','term_id','subject_id', DB::raw('SUM(ca1 + ca2 + ca3 + exam) as total_score'))
            ->where('session_id', $request->session_id)
            ->where('term_id', $request->term_id)
            ->where('student_id', $request->student_id)
            ->groupBy('student_id')
            ->orderByDesc('total_score')
            ->first();
        $all_remarks = GradeBook::select('student_id','class_id','session_id','term_id','subject_id', DB::raw('SUM(ca1 + ca2 + ca3 + exam) as total_score'))
            ->where('session_id', $request->session_id)
            ->where('term_id', $request->term_id)
            ->groupBy('student_id')
            ->orderByDesc('total_score')
            ->get();
        $top_student = GradeBook::select('student_id', 'class_id', 'session_id', 'term_id', 'subject_id', DB::raw('SUM(ca1 + ca2 + ca3 + exam) as total_score'))
            ->where('session_id', $request->session_id)
            ->where('term_id', $request->term_id)
            ->groupBy('student_id')
            ->orderByDesc('total_score') // Highest score first
            ->first();
        $position = '';
        foreach($all_remarks as $key => $student){
            if ($student->student_id == $request->student_id) {
                $position = $key + 1; // Assign the position based on index
                break;
            }else{
                $position = '';
            }
        }
        // $class = Classes::where('id', $request->class_id)->first();
        $term = Term::select('name','id')->where('id', $request->term_id)->first();
        $session = Session::select('name','id')->where('id', $request->session_id)->first();
        // $average = $remarks->total_score / $count_subjects;
        $average = 2;
        return view('student.result_slip', compact('top_student','position','average','grades','term','session','remarks'));
    }

    public function gradeMySubjectAllocation(Request $request){
        $allocation = SubjectAllocation::with('subject')
        ->where(['id' => $request->id, 'staff_id' => auth()->user()->id])
        ->first();
        $has_allocation = '';
        if (!$allocation) {
            return redirect('subject-allocations')->with('error', 'Allocation not found');
        }

        if ($allocation && $allocation->staff_id != auth()->user()->id && !auth()->user()->hasRole(['teacher','eo'])) {
            return redirect('subject-allocations')->with('error', 'You do not have access to there resource');
        }
        // Safely retrieve optional values
        $subjectCategory = optional($allocation->subject)->category;
        $wing = $allocation->wing;

        // Fetch students with safe conditions
        $students = Student::where('class_id', $allocation->class_id)
            ->when($subjectCategory, function ($query) use ($subjectCategory) {
                $query->where('category', $subjectCategory);
            })
            ->when($wing, function ($query) use ($wing) {
                $query->where('wing', $wing);
            })
            ->get();

        // Fetch class and session details
        $class = Classes::where('id', $allocation->class_id)->first();
        $session = Session::where('id', $allocation->session_id)->first();

        foreach ($students as $student) {
            // Check if this student's gradebook record exists for the session
            $exists = GradeBook::where('student_id', $student->id)
                ->where('class_id', $allocation->class_id)
                ->where('session_id', $allocation->session_id)
                ->where('term_id', $allocation->term_id)
                ->exists();

            if (!$exists) {
                // Create a new GradeBook record
                GradeBook::create([
                    'subject_id'    => $allocation->subject_id,
                    'student_id'    => $student->id,
                    'admission_no'  => $student->admission_no,
                    'session_id'    => $allocation->session_id,
                    'term_id'       => $allocation->term_id,
                    'class_id'      => $student->class_id,
                    'wing'          => $student->wing,
                ]);
            }
        }
        $students_id = $students->pluck('id')->toArray();
        $grades = GradeBook::with('student')->whereIn('student_id', $students_id)
                ->where('class_id', $allocation->class_id)
                ->where('session_id', $allocation->session_id)
                ->where('term_id', $allocation->term_id)
                ->get();
        $activation = ActivateUpload::where([
            'session_id' => $allocation->session_id,
            'term_id'       => $allocation->term_id,
            'class_id'      => $allocation->class_id,
        ])->exists();
        return view('grade.create', compact('has_allocation','students','class','wing','session','grades','activation'));
    }


    public function getGrade(Request $request){
        $grade = GradeBook::with('student')->where('id', $request->id)->first();
        return view('grade.view_grade',compact('grade'));
    }

    public function saveGrades(Request $request){
        // /save_ca_result
        $data = GradeBook::where('id', $request->id)->first();
        try{
            DB::beginTransaction();
            if($request->type == 1){
                $data->update(['ca1' => $request->ca]);
            }
            if($request->type == 2){
                $data->update(['ca2' => $request->ca]);
            }
            if($request->type == 3){
                $data->update(['ca3' => $request->ca]);
            }
            if($request->type == 4){
                $data->update(['exam' => $request->exam]);
            }
            DB::commit();
            return response()->json(['message' => 'Success']);
        }catch(Exception $e){
            if($e->getCode() === '23000'){
                return response()->json(['message' => 'Error:Duplicate entry not allowed']);
            }
            DB::rollback();
            return response()->json(['message' => 'Error']);
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
        }
    }

    public function uploadeScores(Request $request){
        $sessions = Session::select('name','id')->orderBy('id', 'asc')->get();
        $terms = Term::select('name','id')->orderBy('id', 'asc')->get();
        $classes = Classes::select('name','id')->orderBy('id', 'asc')->get();
        $subjects = Subject::select('name','id')->orderBy('id', 'asc')->get();
        if($request->has('session_id','subject_id')){
            $grades = GradeBook::with('student')
                ->where('class_id', $request->class_id)
                ->where('session_id', $request->session_id)
                ->where('term_id', $request->term_id)
                ->where('subject_id', $request->subject_id)
                ->get();
                $session = Session::select('name','id')->where('id', $request->session_id)->first();
                $term = Term::select('name','id')->where('id', $request->session_id)->first();
                $class = Classes::select('name','id')->where('id', $request->session_id)->first();
                $subject = Subject::select('name','id')->where('id', $request->session_id)->first();
        }else{
            $grades = [];
            $session = '';
            $term = '';
            $class = '';
            $subject = '';
        }
        return view('grade.scores', compact('subjects','classes','sessions','terms','grades','session','term','subject','class'));
    }

}
