<?php

namespace App\Http\Controllers;

use App\Kecamatan;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function myProfile()
    {
        return view('profile.profile', [
            'user' => Auth::user(),
            'kecamatan' => Kecamatan::get(),
            'role' => Role::get()
        ]);
    }

    public function editProfile()
    {
        return view('profile.profile-edit', [
            'user' => Auth::user(),
            'kecamatan' => Kecamatan::get(),
            'role' => Role::get()
        ]);
    }

    public function updateProfile(Request $request)
    {
        $this->validator($request);
        $user = Auth::user();
        $attr = $request->all();
        $attr['kecamatan_id'] = request('kecamatan');
        $user->update($attr);
        return back();
    }

    protected function validator(Request $request)
    {
        $validation = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'alpha_num', 'max:25'],
                'noHp' => ['required', 'string', 'max:13', 'min:10'],
                'alamat' => ['required'],
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'kecamatan' => ['required']
            ],
            [
                'name.string' => 'Nama Lengkap Harus berupa huruf',
                'name.required' => 'Data tidak boleh kosong, harap diisi',
                'username.required' => 'Data tidak boleh kosong, harap diisi',
                'noHp.required' => 'Data tidak boleh kosong, harap diisi',
                'alamat.required' => 'Data tidak boleh kosong, harap diisi',
                'email.required' => 'Data tidak boleh kosong, harap diisi',
                'kecamatan.required' => 'Data tidak boleh kosong, harap diisi',
                'email.email' => 'Masukkan Email yang valid.',
                'username.max' => 'Maksimal 25 karakter',
                'username.alpha_num' => 'Hanya bisa diisi dengan karakter alpha numeric',
            ]
        );
    }
}
