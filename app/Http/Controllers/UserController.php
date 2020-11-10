<?php

namespace App\Http\Controllers;

use App\Kecamatan;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function editPassword()
    {
        return view('password.password-edit');
    }

    public function updatePassword()
    {
        request()->validate(
            [
                'old_password' => 'required',
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],
            [
                'old_password.required' => 'Data tidak boleh kosong, harap diisi',
                'password.required' => 'Data tidak boleh kosong, harap diisi',
                'password.min' => 'Minimal 8 Karakter',
                'password.confirmed' => 'Masukkan konfirmasi password yang valid',
            ]
        );

        $currentPassword = auth()->user()->password;
        $oldPassword = request('old_password');

        if (Hash::check($oldPassword, $currentPassword)) {
            auth()->user()->update([
                'password' => bcrypt(request('password'))
            ]);
            return back()->with('success', 'Ganti password berhasil.');
        } else {
            return back()->withErrors(['old_password' => 'Masukkan password anda yang sekarang.']);
        }
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
