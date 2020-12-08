<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        if (request()->user()->hasRole('Karyawan')) {
            return view('karyawan.index');
        } else {
            return redirect('/');
        }
    }
}
