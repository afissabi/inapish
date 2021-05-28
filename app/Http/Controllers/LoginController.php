<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use App\Admin;

class LoginController extends Controller
{
    public function daftar(Request $request)
    {
    	$cek = Admin::where('user',$request->user)->first();

    	if (is_null($cek)) {

    		$daftar = [
    			'user'			=> $request->user,
    			'nama_lengkap'	=> $request->nama,
    			'pengguna'		=> $request->pengguna,
    			'sandi'			=> bcrypt($request->sandi),
    		];

    		Admin::create($daftar);
    		return back()->with('alert_success', 'Berhasil, silahkan login...');
    	}else{
    		return back()->with('status', 'GAGAL, nomor telp atau email telah terdaftar');
    	}
    }

    public function mlebu(Request $request){
        $admin = Admin::where(function ($query) use ($request) {
                        $query->where('user', $request->input('user'));
                    })->first();
        if ($admin && Hash::check($request->input('sandi'), $admin->sandi)) 
        {
            session([
                'admin' => $admin,
            ]);

            return redirect('/home');

        } else {            
            return back()->with('alert_fail', 'Username dan password anda salah');
        }
    }

    public function logout() {
        session()->forget('admin');
		session()->flush();

		return redirect('/');
    } 
}
