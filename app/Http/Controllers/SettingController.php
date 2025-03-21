<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::find(1);
        return view('settings.index', compact('settings'));
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
        try{
            DB::beginTransaction();
            DB::commit();
            Setting::create($data);
            return redirect()->back()->with('success', 'Information saved successfully');
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
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $data = $request->validate(['name' => 'required|string', 'description' => 'required|string', 'address' => 'required|string',
        'email' => 'required|email', 'slug' => 'required|string', 'phone_number' => 'required|numeric']);
        try{
            DB::beginTransaction();
            DB::commit();
            $setting->update($data);
            return redirect()->back()->with('success', 'Information saved successfully');
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
    public function destroy(Setting $setting)
    {
        //
    }

    public function uploadLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $settings = Setting::find(1);
        $oldLogo = $settings->logo;

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('images', $filename, 'public');

            // Delete old logo if it exists
            if ($oldLogo && Storage::disk('public')->exists('images/' . $oldLogo)) {
                Storage::disk('public')->delete('images/' . $oldLogo);
            }

            // Update the logo path in the database
            $settings->update(['logo' => $filename]);

            return back()->with('success', 'Logo updated successfully!')->with('path', $path);
        }

        return back()->with('error', 'No file selected!');
    }

}
