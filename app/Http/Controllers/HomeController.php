<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->user()->hasRole('Admin')) {
            return redirect('admin');
        }

        if ($request->user()->hasRole('Karyawan')) {
            return redirect('karyawan');
        }

        if ($request->user()->hasRole('Distributor')) {
            return redirect('distributor');
        }
    }
}
