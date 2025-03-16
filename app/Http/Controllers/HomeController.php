<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard(Request $request){
        $male = Student::where('gender', 'male')->count();
        $female = Student::where('gender', 'female')->count();
        $data = [
            'series' => [$male, $female], // Data for the series
            'labels' => ['Male', 'Female'] // Labels for the chart
        ];
        $total_students = Student::count();
        $total_guardians = User::where('type','guardian')->count();
        $total_staffs = User::whereIn('type',['principal','teacher','eo','accountant'])->count();
        $payments = Payment::sum('amount');
        $successful_payments = Payment::where('response', 'success')->sum('amount');
        $pending_payments = Payment::where('response', 'pending')->sum('amount');
        $latest_payments = Payment::where('response', 'success')
                          ->orderBy('created_at', 'desc')
                          ->take(10)
                          ->get();
        return view('dashboard', compact('data','male','female','total_students','total_guardians','total_staffs','payments','successful_payments','pending_payments','latest_payments'));
    }
}
