<?php

namespace App\Http\Controllers;

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
            'roles' => Role::all()
        ]);
    }

    public function storeKaryawan(Request $request)
    {
        request()->validate(
            [
                'username' => ['required', 'alpha_num', 'max:25'],
                'noHp' => ['required', 'string', 'max:13', 'min:10'],
                'alamat' => ['required'],
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],
            [
                'name.string' => 'Nama Lengkap Harus berupa huruf',
                'name.required' => 'Data tidak boleh kosong, harap diisi',
                'username.required' => 'Data tidak boleh kosong, harap diisi',
                'noHp.required' => 'Data tidak boleh kosong, harap diisi',
                'alamat.required' => 'Data tidak boleh kosong, harap diisi',
                'email.required' => 'Data tidak boleh kosong, harap diisi',
                'password.required' => 'Data tidak boleh kosong, harap diisi',
                'password.min' => 'Minimal 8 karakter',
                'password.confirmed' => 'Masukkan konfirmasi password yang valid',
                'email.email' => 'Masukkan Email yang valid.',
                'email.unique' => 'Email sudah digunakan, silakan ganti.',
                'username.max' => 'Maksimal 25 karakter',
                'username.alpha_num' => 'Hanya bisa diisi dengan karakter alpha numeric',
            ]
        );
        $user = User::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'noHp' => $request->input('noHp'),
            'alamat' => $request->input('alamat'),
            'email' => $request->input('email'),
            'id_role' => 2,
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect()->route('admin.akun')->with('success', 'Data Karyawan Ditambahkan.');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('admin.akun')->with('success', 'Data Berhasil Dihapus');
    }
}
