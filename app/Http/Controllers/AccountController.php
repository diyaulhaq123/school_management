<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\StaffType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateAccountRequest;
use App\Http\Requests\UpdateAccountRequest;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $accounts = User::with('role')->where('type', $request->type)->get();
        $type = $request->type;
        return view('account.index', compact('accounts','type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $type = $request->type;
        return view('account.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAccountRequest $request)
    {
        try{
            DB::beginTransaction();
            DB::commit();
            $user = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'type' => $request->type,
                'password' => Hash::make($request->phone)
            ]);
            $user->assignRole($type);
            return redirect()->back()->with('success', 'Account registered successfully');
        }catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Error saving information'.$e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('account.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $types = StaffType::get();
        $account = User::where('id', $request->account)->first();
        $type = $request->type;
        return view('account.edit', compact('type','account','types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccountRequest $request, string $id)
    {
        try{
            DB::beginTransaction();
            DB::commit();
            User::where('id', $request->id)->update($request->validated());
            return redirect()->back()->with('success', 'Account updated successfully');
        }catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Error saving information');
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
