<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MutiStepFormController extends Controller
{
    public function index()
    {
        return view('multi-step-form.index');
    }

    public function submitForm(Request $request){
        return $request->all();
    }
}
