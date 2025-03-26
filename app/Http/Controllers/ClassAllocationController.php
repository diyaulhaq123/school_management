<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Term;
use App\Models\User;
use App\Models\Wing;
use App\Models\Classes;
use App\Models\Session;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\ClassAllocation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateClassAllocationRequest;
use App\Http\Requests\UpdateClassAllocationRequest;

class ClassAllocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check() && Auth::user()->hasRole('admin')){
            $class_allocations = ClassAllocation::with('user','class','term','session')->get();
        }else{
            $class_allocations = ClassAllocation::with('user','class','term','session')->where('staff_id', auth()->user()->id)->get();
        }
        return view('class_allocation.index', compact('class_allocations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $staffs = User::orderBy('name', 'asc')->select('id','name','email')->where('type', 'teacher')->get();
        $classes = Classes::orderBy('id', 'asc')->select('id','name')->get();
        $terms = Term::select('id','name')->get();
        $sessions = Session::select('id','name')->get();
        $wings = Wing::select('id','name')->get();
        return view('class_allocation.create', compact('wings', 'staffs', 'classes','terms', 'sessions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateClassAllocationRequest $request)
    {
        try{
            DB::beginTransaction();
            DB::commit();
            ClassAllocation::create($request->validated());
            return redirect()->back()->with('success', 'Allocation saved successfully');
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
    public function show(ClassAllocation $classAllocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassAllocation $classAllocation)
    {
        $staffs = User::orderBy('name', 'asc')->select('id','name','email')->where('type', 'teacher')->get();
        $classes = Classes::orderBy('id', 'asc')->select('id','name')->get();
        $terms = Term::select('id','name')->get();
        $sessions = Session::select('id','name')->get();
        $wings = Wing::select('id','name')->get();
        if(Auth::check() && !Auth::user()->hasRole('admin')){
            if($classAllocation->staff_id != Auth::user()->id){
                return redirect()->back()->with('error', 'You cannot access these resources!');
            }
        }
        return view('class_allocation.edit', compact('wings','staffs', 'classes','terms', 'sessions', 'classAllocation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassAllocationRequest $request, ClassAllocation $classAllocation)
    {
        try{
            DB::beginTransaction();
            DB::commit();
            ClassAllocation::where('id', $request->id)->update($request->validated());
            return redirect()->back()->with('success', 'Allocation updated successfully');
        }catch(Exception $e){
            if($e->getCode() == '23000'){
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
    public function destroy(ClassAllocation $classAllocation)
    {
        try{
            ClassAllocation::where('id', $request->id)->delete();
            return redirect()->back()->with('success', 'Allocation deleted successfully');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error deleting information');
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
        }
    }

    public function classStudents(Request $request){
        $class_allocation = ClassAllocation::where([
            'staff_id' => auth()->user()->id,
            'id' => $request->id
            ])->exists();
        $allocation = ClassAllocation::where([
            'staff_id' => auth()->user()->id,
            'id' => $request->id
            ])->first();

        if(!$class_allocation){
            return redirect()->route('class-allocations.index')->with('error', 'Allocation does not exist');
        }

        if(!$allocation){
            return redirect()->route('class-allocations.index')->with('error', 'You do not have access to these resources');
        }

        // if ($allocation && $allocation->staff_id != auth()->user()->id && !auth()->user()->hasRole(['teacher','eo'])) {
        //     return redirect('subject-allocations')->with('error', 'You do not have access to there resource');
        // }
        $wing = $allocation->wing ?? '';
        $students = Student::with('class','session')->where('class_id', $allocation->class_id)
            ->when($wing, function ($query) use ($wing) {
            $query->where('wing', $wing);
            })->get();

        return view('class_allocation.students', compact('students'));
    }

}
