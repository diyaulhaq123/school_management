<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuardianController extends Controller
{
    public function children(Request $request){
        if(Auth::user()->hasRole('guardian') || Auth::user()->type == 'guardian'){
            $guardian_id = Auth::user()->id;
            $user = Auth::user();
        }else{
            $guardian_id = $request->id;
            $user = User::with('children')->where('id', $guardian_id)->first();
        }
        return view('guardian.children.index', compact('user', 'guardian_id'));
    }

}
