<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment_types = PaymentType::get();
        return view('payment_type.index', compact('payment_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('payment_type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|string', 'status' => 'required|int']);
        try{
            DB::beginTransaction();
            DB::commit();
            PaymentType::create($data);
            return redirect()->back()->with('success', 'Save successfully');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Error saving information');
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentType $paymentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentType $paymentType)
    {
        return view('payment_type.edit', compact('paymentType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentType $paymentType)
    {
        $data = $request->validate(['id' => 'required|integer', 'name' => 'required|string']);
        try{
            PaymentType::where('id', $request->id)->update(['name' => $request->name]);
            return redirect()->back()->with('success', 'Updated successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Error updating');
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentType $paymentType)
    {
        //
    }

    // Toogle status of a payment type
    public function toogleStatus(Request $request){
        $data = $request->validate(['id' => 'required|integer']);
        try{
        $query = PaymentType::toogleStatus($request->id);
            return response()->json(['message' => 'success']);
        }catch(Exception $e){
            return response()->json(['message' => 'error'], 500);
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
        }
    }


}
