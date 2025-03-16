<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Term;
use App\Models\Wing;
use App\Models\Result;
use App\Models\Classes;
use App\Models\Session;
use App\Models\Student;
use App\Models\GradeBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Classes::orderBy('id', 'asc')->select('id','name')->get();
        $terms = Term::select('id','name')->get();
        $sessions = Session::select('id','name')->get();
        $results = Result::with('term','session','class')->select('status','term_id','session_id','class_id','id')->get();
        return view('result.index', compact('terms','sessions','classes','results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'session_id' => 'required|integer',
            'term_id' => 'required|integer',
            'class_id' => 'required|integer'
        ]);
        try{
            DB::beginTransaction();
            DB::commit();
            Result::create($data);
            return redirect()->back()->with('success', 'Added successfully');
        }catch(Exception $e){
            if($e->getCode() === '23000'){
                return redirect()->back()->with('error', 'Duplicate entry not allowed');
            }
            DB::rollback();
            return redirect()->back()->with('error', 'Error saving information');
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Result $result)
    {
        $classes = Classes::orderBy('id', 'asc')->select('id','name')->get();
        $terms = Term::select('id','name')->get();
        $sessions = Session::select('id','name')->get();
        return view('result.edit', compact('terms','sessions','classes','result'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Result $result)
    {
        $data = $request->validate([
            'session_id' => 'required|integer',
            'term_id' => 'required|integer',
            'class_id' => 'required|integer'
        ]);
        try{
            DB::beginTransaction();
            DB::commit();
            Result::where('id', $result->id)->update($data);
            return redirect()->back()->with('success', 'Updated successfully');
        }catch(Exception $e){
            if($e->getCode() === '23000'){
                return redirect()->back()->with('error', 'Duplicate entry not allowed');
            }
            DB::rollback();
            return redirect()->back()->with('error', 'Error saving information');
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Result $result)
    {
        try{
            Result::where('id', $request->id)->delete();
            return redirect()->back()->with('success', 'Deleted successfully');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error deleting information');
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
        }
    }


    public function toogleStatus(Request $request){
       $request->validate(['id' => 'required|integer']);
        try{
        // $query = Result::toogleStatus($request->id);
        $result = Result::where('id', $request->id)->first();
        if ($result) {
            if ($result->status == 0) {
                $result->update(['status' => 1]);
            } else {
                $result->update(['status' => 0]);
            }
        }
            return response()->json(['message' => 'success']);
        }catch(Exception $e){
            return response()->json(['message' => 'error'.$e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine()], 500);
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
        }
    }



    public function resultHome(Request $request){
        $classes =  Classes::select('name','id')->orderBy('id','asc')->get();
        $terms = Term::select('name','id')->get();
        $sessions = Session::select('name','id')->get();
        $wings = Wing::select('name','id')->get();
        if($request->has('class_id','wing')){
            $request->validate([
                'class_id' => 'required|int',
                'wing' => 'required'
            ]);

            $students = Student::with('session')->select('last_name','first_name','other_name','class_id','session_id','admission_no','id')
            ->where(['class_id' => $request->class_id, 'wing' => $request->wing])->get();
            // $grades = GradeBook::with('student','session','term','class')
            //     ->where([
            //     'class_id' => $request->class,
            //     'session_id' => $request->session_id,
            //     'term_id' => $request->term_id,
            //     'student_id' => $request->student_id,
            //     'wing' => $request->wing
            // ])->get();
            $class = Classes::select('name','id')->where('id', $request->class_id)->first();
            $term = Term::select('name','id')->where('id', $request->term_id)->first();
            $session = Session::select('name','id')->where('id', $request->session_id)->first();
        }else{
            $class = [];
            $session = [];
            $term = [];
            $students = [];
        }
        return view('result.view.index', compact('session','term','class','wings','sessions','terms','classes','students'));
    }


    public function gradestHome(Request $request){
        $classes = $this->academicRepo->getClasses();
        $terms = $this->academicRepo->getTerms();
        $sessions = $this->academicRepo->getSessions();
        $subjects = $this->academicRepo->getSubjects();
        $wings = $this->academicRepo->getWings();
        if($request->has('class')){
            $request->validate([
                'class' => 'required|int',
                'subject' => 'required|int',
                'term' => 'required|int',
                'session' => 'required|int',
            ]);
            $grades = $this->eoRepo->getGradesBySession($request->class, $request->session, $request->term, $request->subject);
            $class = $this->academicRepo->getClassById($request->class);
        }else{
            $grades = [];
            $class = [];
        }
        return view('result.view.grades', compact('class','grades','wings','subjects','sessions','terms','classes'));
    }


    public function resultSlip(Request $request){
        $request->validate(['session_id' => 'required|integer', 'term_id' => 'required|integer', 'student_id' => 'required|integer']);
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
        $average = $remarks->total_score / $count_subjects;
        return view('result.view.result_slip', compact('top_student','position','average','grades','term','session','remarks'));
    }

}
