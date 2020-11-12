<?php

namespace App\Http\Controllers;

use App\Kecamatan;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function dataAkun()
    {
        return view('admin.dataAkun', [
            'users' => User::where('id', '!=', Auth::user()->id)->get(),
            'roles' => Role::all(),
            'kecamatan' => Kecamatan::all()
        ]);
    }
}
