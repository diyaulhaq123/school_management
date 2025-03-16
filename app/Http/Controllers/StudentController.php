<?php

namespace App\Http\Controllers;

use Log;
use Exception;
use App\Models\Lga;
use App\Models\Term;
use App\Models\User;
use App\Models\Wing;
use App\Models\State;
use App\Models\Result;
use App\Models\Classes;
use App\Models\Payment;
use App\Models\Session;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\ClassCategory;
use App\Models\StudentRecord;
use App\Imports\ImportStudents;
use Yajra\DataTables\DataTables;
use App\Models\PaymentActivation;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Traits\GeneratesReferenceNumber;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Requests\UploadStudentRequest;
use App\Http\Requests\RegisterStudentRequest;

class StudentController extends Controller
{

    use GeneratesReferenceNumber;


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Classes::select('id','name')->get();
        $wings = Wing::select('id','name')->get();
        $guardians = User::select('id','email','name')->where('type', 'guardian')->get();
        $students = Student::select('id','first_name')->get();
        return view('student.index', compact('students','classes','wings','guardians'));
    }

    public function getApiStudents(Request $request){
        $students = Student::with(['class', 'guardian']);

        $students->when($request->filled('class_id'), function ($q) use ($request) {
            return $q->where('class_id', $request->class_id);
        });

        $students->when($request->filled('guardian_id'), function ($q) use ($request) {
            return $q->where('guardian_id', $request->guardian_id);
        });

        $students->when($request->filled('wing'), function ($q) use ($request) {
            return $q->where('wing', $request->wing);
        });

        return DataTables::of($students)
            ->addColumn('class', function ($student) {
                return $student->class ? $student->class->name : 'N/A';
            })
            ->addColumn('guardian', function ($student) {
                return $student->guardian ? $student->guardian->name : 'N/A';
            })
            // ->addColumn('wing', function ($student) {
            //     return $student->wing ? $student->wing->name : 'N/A';
            // })
            ->addColumn('status', function ($student) {
                return $student->status == '1'
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-danger">In-Active</span>';
            })
            ->rawColumns(['status'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $category = json_decode(json_encode([
            ['id' => '1', 'name' => 'Sciences'],
            ['id' => '2', 'name' => 'Socials'],
            ['id' => '3', 'name' => 'Commercials']
        ]));
        $guardians = User::select('id','email','name')->where('type', 'guardian')->get();
        $sessions = Session::select('id','name')->get();
        $terms = Term::select('id','name')->get();
        $states = State::select('id','name')->get();
        $lgas = Lga::select('id','name')->get();
        $classes = Classes::select('id','name')->get();
        $categories = ClassCategory::select('id','name')->get();
        $wings = Wing::select('id','name')->get();
        return view('student.create', compact('category','sessions','states','lgas','guardians','terms','classes','categories','wings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterStudentRequest $request)
    {
        try{
            DB::beginTransaction();
            DB::commit();
            Student::create($request->validated());
            return redirect()->back()->with('success', 'Student registered successfully');
        }catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Error saving information');
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {

        // dd($student->getAllData($student->id));

        try {
            // Get all student records
            foreach ($student->getAllData($student->id) as $a) {
                // Fetch all relevant PaymentActivation records based on session_id, class_id, term_id and status
                $activations = PaymentActivation::where([
                    'session_id' => $a['session_id'],
                    'class_id' => $a['class_id'],
                    'status' => 1,
                ])->whereIn('term_id', [1, 2, 3])->get();

                if ($activations->isNotEmpty()) {
                    foreach ($activations as $activation) {
                        // Check(using loop) if a payment from payment table already exists based on session_id, class_id, term_id, student_id and payment_type_id from the activation table
                        $exists = Payment::where([
                            'student_id' => $student->id,
                            'class_id' => $activation->class_id,
                            'session_id' => $activation->session_id,
                            'term_id' => $activation->term_id,
                            'payment_type_id' => $activation->payment_type_id,
                        ])->exists();

                        // If no payment exists, create one for that student and generate a reference number for the payment
                        if (!$exists) {
                            Payment::create([
                                'student_id' => $student->id,
                                'class_id' => $activation->class_id,
                                'session_id' => $activation->session_id,
                                'term_id' => $activation->term_id,
                                'payment_type_id' => $activation->payment_type_id,
                                'ref_no' => $this->generateReferenceNumber(),
                                'amount' => $activation->amount,
                                'guardian_id' => $student->guardian_id,
                            ]);
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error creating payments: ' . $e->getMessage());
        }

        $student_record = StudentRecord::select('student_id', 'class_id', 'session_id')->where('student_id', $student->id)->get();
        $class_ids = $student_record->pluck('class_id')->toArray();

        $results = Result::with('session','term','class')->whereIn('class_id', $class_ids)->whereIn('term_id', [1,2,3])->get();
        $result2 = Result::with('session','term','class')->where('class_id', $student->class_id)->whereIn('term_id', [1,2,3])->get();

        $classes = StudentRecord::with('class','session')->where('student_id', $student->id)->get();

        if(auth()->check() && auth()->user()->hasAnyRole('admin', 'accountant')){
            $payments = Payment::with('student','class','session','term','paymentType')->where('student_id', $student->id)->orderBy('session_id', 'desc')->get();
        }else{
            $payments = Payment::with('student','class','session','term','paymentType')->where([
                'student_id' => $student->id,
                'guardian_id' => auth()->user()->id,
            ])->orderBy('session_id', 'desc')->get();
        }
        return view('student.show', compact('student','classes','results','result2','payments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $category = json_decode(json_encode([
            ['id' => '1', 'name' => 'Sciences'],
            ['id' => '2', 'name' => 'Socials'],
            ['id' => '3', 'name' => 'Commercials']
        ]));
        $guardians = User::select('id','email','name')->where('type', 'guardian')->get();
        $sessions = Session::select('id','name')->get();
        $terms = Term::select('id','name')->get();
        $states = State::select('id','name')->get();
        $lgas = Lga::select('id','name')->get();
        $classes = Classes::select('id','name')->get();
        $categories = ClassCategory::select('id','name')->get();
        $wings = Wing::select('id','name')->get();
        return view('student.edit', compact('category','student','sessions','states','lgas','guardians','terms','classes','categories','wings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        try{
            DB::beginTransaction();
            DB::commit();
            Student::where('id', $request->id)->update($request->validated());
            return redirect()->back()->with('success', 'Student updated successfully');
        }catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Error saving information');
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }

    public function getLgaById(Request $request){
        $lgas = Lga::where('state_id', $request->state_id)->get();
        return json_encode($lgas);
    }


    public function getClassesByCategory(Request $request){
        $data = Classes::where('class_category_id', $request->class_category_id)->get();
        return json_encode($data);
    }


    public function getApiStudentOption(Request $request){
        $students = Student::with('class')->select('last_name','first_name','id')->get();
        return json_encode($students);
    }


    public function upload_student(Request $request){
        $classes = Classes::get();
        $sessions = Session::get();
        $wings = Wing::get();
        return view('student.upload_student', compact('sessions','classes','wings'));
    }

    public function createStudentUpload(UploadStudentRequest $request){
        $class_id = Classes::where('id', $request->class_id)->first();
        $session_id = Session::where('id', $request->session_id)->first();
        try{
            Excel::import(new ImportStudents($class_id->id, $session_id->id), $request->student_list);
            return redirect()->back()->with('success', 'Students uploaded successfully!');
        }catch(Exception $e){
            Log::error($e->getMessage().' file: '.$e->getFile().' line: '.$e->getLine());
            return redirect()->back()->with('error', 'Error uploading students data');

        }



    }



}
