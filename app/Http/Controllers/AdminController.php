<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        if (request()->user()->hasRole('Admin')) {
            return view('admin.index');
        } else {
            return redirect('/');
        }
    }
}
