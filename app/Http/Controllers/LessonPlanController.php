<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Term;
use App\Models\Classes;
use App\Models\Session;
use App\Models\Subject;
use App\Models\LessonPlan;
use Illuminate\Http\Request;
use App\Traits\RoleCheckTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateLessonPlanRequest;
use App\Http\Requests\UpdateLessonPlanRequest;

class LessonPlanController extends Controller
{

    use RoleCheckTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->authorizeRoles(['teacher', 'admin', 'principal']);
        $user = auth()->user();

        if (!$user->hasRole(['teacher', 'admin', 'principal'])) {
            return redirect()->back()->with('error', 'Unauthorised access!');
        }

        $current_session = optional(Session::where('status', '1')->first()) ?? '0';
        if(Auth::check() && Auth::user()->hasRole(['admin','principal'])){
            $lesson_plans = LessonPlan::with('session','subject','class','term','staff')
                ->where([
                    'session_id' => $current_session->id
                    ])
                ->get();
        }else{
            $lesson_plans = LessonPlan::with('session','subject','class','term','staff')
                ->where([
                    'staff_id' => auth()->user()->id,
                    'session_id' => $current_session->id
                    ])
                ->get();
        }
        return view('lesson_plan.index',compact('lesson_plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $allocation = SubjectAllocation::where('id', $request->id)->first();
        $classes = Classes::select('id','name')->where('status', 1)->get();
        $session = Session::where('status', 1)->first();
        $term = Term::where('status', 1)->first();
        // $subjects = Subject::get();
        return view('lesson_plan.create',compact('session','term','classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateLessonPlanRequest $request)
    {
        try{
            DB::beginTransaction();
            DB::commit();
            LessonPlan::create($request->validated());
            return redirect()->back()->with('success','Saved successfully');
        }catch(Exception $e){
            DB::rollback();
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
            return redirect()->back()->with('error','Error Saving information');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LessonPlan $lessonPlan)
    {
        // $school_info =
        return view('lesson_plan.show', compact('lessonPlan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LessonPlan $lessonPlan)
    {
        $subjects = Subject::select('name','id')->where('class_id', $lessonPlan->class_id)->get();
        $classes = Classes::select('name','id')->orderBy('id')->get();
        return view('lesson_plan.edit',compact('lessonPlan','classes','subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLessonPlanRequest $request, LessonPlan $lessonPlan)
    {
        try{
            DB::beginTransaction();
            DB::commit();
            $lessonPlan->update($request->validated());
            return redirect()->back()->with('success','Update saved successfully');
        }catch(Exception $e){
            DB::rollback();
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
            return redirect()->back()->with('error','Error Saving information');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LessonPlan $lessonPlan)
    {
        //
    }


    public function approveLessonPlan(Request $request){
        $request->validate(['status' => 'required|integer', 'reviewed_on' => 'required', 'reviewed_by' => 'required', 'remark' => 'required']);
        $lesson_plan = LessonPlan::where('id', $request->id)->first();
        try{
            DB::beginTransaction();
            $lesson_plan->update([
                'status' => $request->status,
                'reviewed_on' => $request->reviewed_on,
                'reviewed_by' => $request->reviewed_by,
                'remark' => $request->remark
            ]);
            DB::commit();
            return redirect()->back()->with('success','Saved successfully');
        }catch(Exception $e){
            DB::rollback();
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
            return redirect()->back()->with('error','An error occured');
        }
    }

}
