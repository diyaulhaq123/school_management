<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivateUpload;

class ActivateUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $uploads = ActivateUpload::with('class','session','term')->select('id','class_id','session_id','term_id')->get();
        return view('activate_upload.index', compact('uploads'));
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
    public function show(ActivateUpload $activateUpload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ActivateUpload $activateUpload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ActivateUpload $activateUpload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ActivateUpload $activateUpload)
    {
        //
    }
}
