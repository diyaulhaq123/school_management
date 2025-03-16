<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Term;
use App\Models\User;
use App\Models\Wing;
use App\Models\Classes;
use App\Models\Session;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\SubjectAllocation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateSubjectAllocationRequest;
use App\Http\Requests\UpdateSubjectAllocationRequest;

class SubjectAllocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check() && Auth::user()->hasRole('admin')){
            $subject_allocations = SubjectAllocation::with('user','class','term','session','subject')->orderBy('session_id','asc')->get();
        }else{
            $subject_allocations = SubjectAllocation::with('user','class','term','session','subject')->orderBy('session_id','asc')->where('staff_id', auth()->user()->id)->get();
        }
        return view('subject_allocation.index', compact('subject_allocations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $staffs = User::orderBy('name', 'asc')->select('id','name','email')->where('type', 'teacher')->get();
        $subjects = Subject::orderBy('name', 'asc')->select('id','name')->get();
        $classes = Classes::orderBy('id', 'asc')->select('id','name')->get();
        $terms = Term::select('id','name')->get();
        $sessions = Session::select('id','name')->get();
        $wings = Wing::select('id','name')->get();
        return view('subject_allocation.create', compact('wings','subjects', 'staffs', 'classes','terms', 'sessions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSubjectAllocationRequest $request)
    {
        try{
            DB::beginTransaction();
            DB::commit();
            SubjectAllocation::create($request->validated());
            return redirect()->back()->with('success', 'Allocation saved successfully');
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
    public function show(SubjectAllocation $subjectAllocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubjectAllocation $subjectAllocation)
    {
        $staffs = User::orderBy('name', 'asc')->select('id','name','email')->where('type', 'teacher')->get();
        // $subjects = Subject::orderBy('name', 'asc')->select('id','name')->get();
        $subjects = Subject::where('class_id', $subjectAllocation->class_id)->orderBy('name', 'asc')->select('name','id','class_id')->get();
        $classes = Classes::orderBy('id', 'asc')->select('id','name')->get();
        $terms = Term::select('id','name')->get();
        $sessions = Session::select('id','name')->get();
        $wings = Wing::select('id','name')->get();
        if(Auth::check() && !Auth::user()->hasRole('admin')){
            if($subjectAllocation->staff_id != Auth::user()->id){
                return redirect()->back()->with('error', 'You cannot access these resources!');
            }
        }
        return view('subject_allocation.edit', compact('wings','subjects', 'staffs', 'classes','terms', 'sessions', 'subjectAllocation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubjectAllocationRequest $request, SubjectAllocation $subjectAllocation)
    {
        try{
            DB::beginTransaction();
            DB::commit();
            SubjectAllocation::where('id', $request->id)->update($request->validated());
            return redirect()->back()->with('success', 'Allocation updated successfully');
        }catch(Exception $e){
            if($e->getCode() == '23000'){
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
    public function destroy(SubjectAllocation $subjectAllocation)
    {

        try{
            SubjectAllocation::where('id', $request->id)->delete();
            return redirect()->back()->with('success', 'Allocation deleted successfully');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error deleting information');
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
        }

    }
}
