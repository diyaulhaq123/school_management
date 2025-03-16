<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Term;
use App\Models\Classes;
use App\Models\Session;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use App\Models\ClassCategory;
use App\Models\PaymentActivation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentActivationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activations = PaymentActivation::with('session','term','class','paymentType')->get();
        $classes = Classes::orderBy('id', 'asc')->select('id','name')->get();
        $terms = Term::select('id','name')->get();
        $sessions = Session::select('id','name')->get();
        $payment_types = PaymentType::select('id','name')->get();
        $class_categories = ClassCategory::select('name','id')->get();
        return view('payment_activation.index', compact('activations','class_categories','payment_types','terms','classes','sessions'));
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
        $data = $request->validate([
            'session_id' => 'required|integer',
            'term_id' => 'required|integer',
            'class_id' =>  'sometimes|nullable|integer',
            'payment_type_id' =>  'sometimes|nullable|integer',
            'class_category_id' =>  'sometimes|nullable|integer',
            'amount' => 'required|numeric',
        ]);
        try{
            DB::beginTransaction();
            DB::commit();
            PaymentActivation::create($data);
            return redirect()->back()->with('success', 'Saved successfully');
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
    public function show(PaymentActivation $paymentActivation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentActivation $paymentActivation)
    {
        $classes = Classes::orderBy('id', 'asc')->select('id','name')->get();
        $terms = Term::select('id','name')->get();
        $sessions = Session::select('id','name')->get();
        $payment_types = PaymentType::select('id','name')->get();
        $class_categories = ClassCategory::select('name','id')->get();
        return view('payment_activation.edit', compact('paymentActivation','class_categories','payment_types','terms','classes','sessions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentActivation $paymentActivation)
    {
        $data = $request->validate([
            'session_id' => 'required|integer',
            'term_id' => 'required|integer',
            'class_id' => 'sometimes|nullable|integer',
            'payment_type_id' => 'sometimes|nullable|integer',
            'class_category_id' =>  'sometimes|nullable|integer',
            'amount' => 'required|numeric',
        ]);
        try{
            DB::beginTransaction();
            DB::commit();
            PaymentActivation::where('id', $paymentActivation->id)->update($data);
            return redirect()->back()->with('success', 'Updated successfully');
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
    public function destroy(PaymentActivation $paymentActivation)
    {
        try{
            PaymentActivation::where('id', $request->id)->delete();
            return redirect()->back()->with('success', 'Deleted successfully');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error deleting information');
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
        }
    }


    public function toogleStatus(Request $request){
        $request->validate(['id' => 'required|integer']);
         try{
         // $query = Result::toogleStatus($request->id);
         $result = PaymentActivation::where('id', $request->id)->first();
         if ($result) {
             if ($result->status == 0) {
                 $result->update(['status' => 1]);
             } else {
                 $result->update(['status' => 0]);
             }
         }
             return response()->json(['message' => 'success']);
         }catch(Exception $e){
             return response()->json(['message' => 'error'.$e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine()], 500);
             Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
         }
     }

}
