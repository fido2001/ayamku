<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DistributorController extends Controller
{
    public function index()
    {
        if (request()->user()->hasRole('Distributor')) {
            return view('distributor.index');
        } else {
            return redirect('/');
        }
    }
}
