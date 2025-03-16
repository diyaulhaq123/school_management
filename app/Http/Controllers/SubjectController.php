<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\ClassCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CreateSubjectRequest;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::select('name','id','status')->get();
        return view('subject.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = json_decode(json_encode([
            ['id' => '1', 'name' => 'Sciences'],
            ['id' => '2', 'name' => 'Socials'],
            ['id' => '3', 'name' => 'Commercials']
        ]));
        $classes = Classes::orderBy('id', 'asc')->select('id','name')->get();
        $class_categories = ClassCategory::select('id','name')->get();
        return view('subject.create', compact('categories','class_categories','classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSubjectRequest $request)
    {
        try{
            DB::beginTransaction();
            DB::commit();
            Subject::create($request->validated());
            return redirect()->back()->with('success', 'Subject saved successfully');
        }catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Error saving information'.$e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        $categories = json_decode(json_encode([
            ['id' => '1', 'name' => 'Sciences'],
            ['id' => '2', 'name' => 'Socials'],
            ['id' => '3', 'name' => 'Commercials']
        ]));
        $classes = Classes::orderBy('id', 'asc')->select('id','name')->get();
        $class_categories = ClassCategory::select('id','name')->get();
        return view('subject.edit', compact('subject','classes','categories','class_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'status' => 'required|integer',
        ]);
        try{
            DB::beginTransaction();
            DB::commit();
            Subject::where('id', $request->id)->update($data);
            return redirect()->back()->with('success', 'Updated successfully');
        }catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Error saving information');
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        try{
            Subject::where('id', $request->id)->delete();
            return redirect()->back()->with('success', 'Deleted successfully');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error deleting information');
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
        }
    }


    public function getSubjectsByClass(Request $request){
        $lists = Subject::where('class_id', $request->class_id)->select('name','id','class_id')->get();
        return json_encode($lists);
    }

}
