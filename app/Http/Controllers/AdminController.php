<?php

namespace App\Http\Controllers;

use App\Progress;
use App\ProgressDetail;
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

    public function dataAkunKaryawan()
    {
        return view('admin.dataAkunKaryawan', [
            'users' => User::where('id', '!=', Auth::user()->id)->where('id_role', '=', '2')->get(),
            'roles' => Role::all()
        ]);
    }

    public function dataAkunDistributor()
    {
        return view('admin.dataAkunDistributor', [
            'users' => User::where('id', '!=', Auth::user()->id)->where('id_role', '=', '3')->get(),
            'roles' => Role::all()
        ]);
    }

    public function storeKaryawan(Request $request)
    {
        request()->validate(
            [
                'username' => ['required', 'alpha_num', 'max:25'],
                'noHp' => ['required', 'string', 'max:13', 'min:10', 'regex:/^(08)[0-9]*/'],
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

        return redirect()->route('admin.akun.karyawan')->with('success', 'Data Karyawan Ditambahkan.');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('admin.akun.karyawan')->with('success', 'Data Berhasil Dihapus');
    }

    public function indexProgress()
    {
        // $kandang = Kandang::get();
        $progress = Progress::join('kandang', 'kandang.id', '=', 'progress.id_kandang')->select('progress.*', 'kandang.*')->get();
        // dd($progress);
        return view('admin.indexProgress', [
            'dataProgress' => $progress
            // 'dataKandang' => $kandang
        ]);
    }

    public function progressDetail($id)
    {
        $progress = Progress::join('kandang', 'kandang.id', '=', 'progress.id_kandang')->where('progress.id', '=', $id)->select('progress.*')->get();

        $progressDetail = ProgressDetail::join('progress', 'progress.id', '=', 'progress_detail.id_progress')->join('kandang', 'kandang.id', '=', 'progress.id_kandang')->where('progress.id', '=', $id)->select('progress_detail.*', 'progress.*', 'kandang.*')->get();

        return view('admin.progressDetail', [
            'progressDetail' => $progressDetail,
            'dataProgress' => $progress
        ]);
    }
}
