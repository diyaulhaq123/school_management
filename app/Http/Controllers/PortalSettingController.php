<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PortalSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\PortalUpdateRequest;
use App\Http\Requests\PortalSettingsRequest;

class PortalSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = PortalSetting::select('name','id','status','type')->get();
        return view('portal_settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('portal_settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PortalSettingsRequest $request)
    {
        try{
            DB::beginTransaction();
            DB::commit();
            PortalSetting::create($request->validated());
            return redirect()->back()->with('success', 'Settings added successfully');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Error saving information');
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(PortalSetting $portalSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PortalSetting $portalSetting)
    {
        return view('portal_settings.edit', compact('portalSetting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PortalUpdateRequest $request)
    {
        $query = PortalSetting::where('id', $request->id)->update($request->validated());
        if($query){
            return response()->json(['message' => 'success']);
        }
        return response()->json(['message' => 'error'], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PortalSetting $portalSetting)
    {
        //
    }

    // public function toogleSettingsStatus(Request $request)
    // {
    //     $request->validate(['id' => 'required', 'status' => 'required']);
    //     $query = PortalSetting::where('id', $request->id)->update(['status' => $request->status]);
    //     if($query){
    //         return redirect()->back()->with('message', 'success');
    //     }
    //     return redirect()->back()->with('message', 'Error updating');
    // }

}
