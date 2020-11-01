<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeternakController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (request()->user()->hasRole('Peternak')) {
            return view('peternak.index');
        } else {
            return redirect('/');
        }
    }
}
