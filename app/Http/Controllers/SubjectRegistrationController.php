<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Term;
use App\Models\Classes;
use App\Models\Session;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\ClassCategory;
use Illuminate\Support\Facades\DB;
use App\Models\SubjectRegistration;
use Illuminate\Support\Facades\Log;

class SubjectRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lists = SubjectRegistration::with('class','session','subject','term')->select('session_id','subject_id','class_id','term_id')->get();
        return view('subject_registration.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::orderBy('name', 'asc')->select('id','name')->get();
        $classes = Classes::orderBy('id', 'asc')->select('id','name')->get();
        $terms = Term::select('id','name')->get();
        $sessions = Session::select('id','name')->get();
        $class_categories = ClassCategory::select('id','name')->get();
        return view('subject_registration.create', compact('classes','subjects','sessions','terms','class_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            DB::commit();
            SubjectRegistration::create($request->validated());
            return redirect()->back()->with('success', 'Subject has been registered successfully');
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
     * Display the specified resource.
     */
    public function show(SubjectRegistration $subjectRegistration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubjectRegistration $subjectRegistration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubjectRegistration $subjectRegistration)
    {
        try{
            DB::beginTransaction();
            DB::commit();
            SubjectRegistration::where('id', $request->id)->update($request->validated());
            return redirect()->back()->with('success', 'Updated successfully');
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
    public function destroy(SubjectRegistration $subjectRegistration)
    {
        try{
            SubjectAllocation::where('id', $request->id)->delete();
            return redirect()->back()->with('success', 'Removed successfully');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error removing resource');
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
        }
    }
}
