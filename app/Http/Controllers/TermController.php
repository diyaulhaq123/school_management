<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $terms = Term::select('name','id','status')->get();
        return view('terms.index', compact('terms'));
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
        $data = $request->validate(['name' => 'required|integer']);
        try{
            DB::beginTransaction();
            DB::commit();
            Term::create($data);
            return redirect()->back()->with('success', 'Term added successfully');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Error saving information');
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Term $term)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Term $term)
    {
        return view('terms.edit', compact('term'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Term $term)
    {
        $data = $request->validate(['id' => 'required|integer', 'name' => 'required|string']);
        try{
            Term::where('id', $request->id)->update(['name' => $request->name]);
            return redirect()->back()->with('success', 'Session updated successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Error updating session');
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
        }
    }

    public function toogleStatus(Request $request){
        $data = $request->validate(['id' => 'required|integer']);
        try{
        $query = Term::activateTerm($request->id);
            return response()->json(['message' => 'success']);
        }catch(\Exception $e){
            return response()->json(['message' => 'error'], 500);
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Term $term)
    {
        //
    }
}
