<?php

namespace App\Http\Controllers;

use App\Models\Term;
use App\Models\User;
use App\Models\Classes;
use App\Models\Payment;
use App\Models\Session;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guardians = User::select('id','email','name')->where('type', 'guardian')->get();
        $sessions = Session::select('id','name')->get();
        $terms = Term::select('id','name')->get();
        $classes = Classes::select('id','name')->get();
        $payment_types = PaymentType::select('id','name')->get();
        $paid = Payment::where('response', 'success')->count();
        $pending = Payment::where('response', 'pending')->count();
        $data = [
            'series' => [$paid, $pending], // Data for the series
            'labels' => ['Paid', 'Pending'] // Labels for the chart
        ];
        $jan = Payment::whereMonth('created_at', '=', 1)->count();
        $feb = Payment::whereMonth('created_at', '=', 2)->count();
        $mar = Payment::whereMonth('created_at', '=', 3)->count();
        $apr = Payment::whereMonth('created_at', '=', 4)->count();
        $may = Payment::whereMonth('created_at', '=', 5)->count();
        $june = Payment::whereMonth('created_at', '=', 6)->count();
        $july = Payment::whereMonth('created_at', '=', 7)->count();
        $aug = Payment::whereMonth('created_at', '=', 8)->count();
        $sep = Payment::whereMonth('created_at', '=', 9)->count();
        $oct = Payment::whereMonth('created_at', '=', 10)->count();
        $nov = Payment::whereMonth('created_at', '=', 11)->count();
        $dec = Payment::whereMonth('created_at', '=', 12)->count();
        $payment_by_months = [$jan, $feb, $mar, $apr, $may, $june, $july, $aug, $sep, $oct, $nov, $dec];

        return view('payment.index', compact('guardians','sessions','terms','classes','payment_types','data','payment_by_months'));
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
    public function show(string $id)
    {
        $payment = Payment::where('id', $id)->first();
        return view('payment.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getApiPayments(Request $request){
        $payments = Payment::with(['class', 'guardian', 'session', 'term', 'paymentType', 'student']);

        $payments->when($request->filled('class_id'), function ($q) use ($request) {
            return $q->where('class_id', $request->class_id);
        });

        $payments->when($request->filled('guardian_id'), function ($q) use ($request) {
            return $q->where('guardian_id', $request->guardian_id);
        });

        $payments->when($request->filled('session_id'), function ($q) use ($request) {
            return $q->where('session_id', $request->session_id);
        });

        $payments->when($request->filled('term_id'), function ($q) use ($request) {
            return $q->where('term_id', $request->term_id);
        });

        $payments->when($request->filled('payment_type'), function ($q) use ($request) {
            return $q->where('payment_type_id', $request->payment_type);
        });

        $payments->when($request->filled('student_id'), function ($q) use ($request) {
            return $q->where('student_id', $request->student_id);
        });

        $payments->when($request->filled('response'), function ($q) use ($request) {
            return $q->where('response', $request->response);
        });

        return DataTables::of($payments)
            ->addColumn('class', function ($payment) {
                return $payment->class ? $payment->class->name : 'N/A';
            })
            ->addColumn('guardian', function ($payment) {
                return $payment->guardian ? $payment->guardian->name : 'N/A';
            })
            ->addColumn('session', function ($payment) {
                return $payment->session ? $payment->session->name : 'N/A';
            })

            ->addColumn('term', function ($payment) {
                return $payment->term ? $payment->term->name : 'N/A';
            })

            ->addColumn('payment_type', function ($payment) {
                return $payment->paymentType ? $payment->paymentType->name : 'N/A';
            })

            ->addColumn('student', function ($payment) {
                return $payment->student ? $payment->student->last_name.' '.$payment->student->first_name : 'N/A';
            })

            ->addColumn('admission_no', function ($payment) {
                return $payment->student ? $payment->student->admission_no : 'N/A';
            })

            ->addColumn('response', function ($payment) {
                if ($payment->response == 'success') {
                    return '<span class="badge bg-success">' . $payment->response . '</span>';
                } else {
                    return '<span class="badge bg-danger">' . $payment->response . '</span>';
                }
            })
            ->addColumn('action', function ($payment) {
                return '<div class="dropdown">
                            <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink15" data-bs-toggle="dropdown" aria-expanded="true">
                                <i class="ri-equalizer-fill"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink15">
                                <li><a class="dropdown-item" href="payments/' . $payment->id . '"><i class="ri-eye-fill me-2 align-middle text-muted"></i>View</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a></li>
                            </ul>
                        </div>';
            })
            ->rawColumns(['response', 'action']) // Combine both columns here
            ->make(true);

    }



    public function makePayment(Request $request): JsonResponse
    {
        $payment = Payment::with('guardian', 'student', 'class', 'paymentType')
            ->where('id', $request->id)
            ->where('response', '!=', 'success')
            ->first();

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found or already successful.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'payment' => $payment,
        ]);
    }



}
