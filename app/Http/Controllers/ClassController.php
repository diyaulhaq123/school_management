<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Classes;
use Illuminate\Http\Request;
use App\Models\ClassCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Classes::select('name','id','status')->get();
        return view('classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $class_categories = ClassCategory::select('name','id')->get();
        return view('classes.create', compact('class_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'class_category_id' => 'required|string',
            'status' => 'required|integer',
        ]);
        try{
            DB::beginTransaction();
            DB::commit();
            Classes::create($data);
            return redirect()->back()->with('success', 'Class saved successfully');
        }catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Error saving information');
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Classes $classes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classes $class)
    {
        $class_categories = ClassCategory::select('name','id')->get();
        return view('classes.edit', compact('class_categories','class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classes $classes)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'class_category_id' => 'required|string',
            'status' => 'required|integer',
        ]);
        try{
            DB::beginTransaction();
            DB::commit();
            Classes::where('id', $request->id)->update($data);
            return redirect()->back()->with('success', 'Class saved successfully');
        }catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Error saving information');
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classes $classes)
    {
        try{
            Classes::where('id', $request->id)->delete();
            return redirect()->back()->with('success', 'Deleted successfully');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error deleting information');
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
        }
    }
}
