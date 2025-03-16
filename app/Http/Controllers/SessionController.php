<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Container\Attributes\DB;
use Illuminate\Container\Attributes\Log;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sessions = Session::select('id', 'name', 'status')->get();
        return view('sessions.index', compact('sessions'));
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
        try{
            DB::beginTransaction();
            DB::commit();
            Session::create($request->validated());
            return redirect()->back()->with('success', 'Session added successfully');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Error saving information');
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Session $session)
    {
        return view('sessions.edit', compact('session'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Session $session)
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
        $query = Session::activateTerm($request->id);
            return response()->json(['message' => 'success']);
        }catch(\Exception $e){
            return response()->json(['message' => 'error'], 500);
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Session $session)
    {
        //
    }
}
