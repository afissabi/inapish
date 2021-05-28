<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use App\Admin;
use App\Tentang;
use App\Posting;
use App\Komentar;
use File;

class InapishController extends Controller
{
    public function public()
    {
        $see   = Tentang::where('id_admin',session('admin')->id_admin)->first();
        $post  = Posting::where('ijin',0)->orderbyDesc('id_posting')->get();

        foreach ($post as $key => $value) {
            $value->komen  = Komentar::where('id_posting',$value->id_posting)->where('Komentar','!=', null)->get();
            $value->like   = Komentar::where('id_posting',$value->id_posting)->where('suka',1)->count();
            $value->jumkom = Komentar::where('id_posting',$value->id_posting)->where('Komentar','!=', null)->count();
            $value->tentang= Tentang::where('id_admin',$value->id_admin)->first();
        }

        $data = [
            'post' => $post,
            'see'  => $see,
        ];

        return view('public',$data);
    }

    public function home()
    {
    	$see   = Tentang::where('id_admin',session('admin')->id_admin)->first();
        $post  = Posting::where('id_admin',session('admin')->id_admin)->get();

        foreach ($post as $key => $value) {
            $value->komen  = Komentar::where('id_posting',$value->id_posting)->get();
            $value->like   = Komentar::where('id_posting',$value->id_posting)->where('suka',1)->count();
            $value->jumkom = Komentar::where('id_posting',$value->id_posting)->where('Komentar','!=', null)->count();
        }

    	$data = [
    		'see'  => $see,
            'post' => $post,
    	];

    	return view('home',$data);
    }

    public function profupdate(Request $request)
    {
    	$profil = [
    		'id_admin' => session('admin')->id_admin,
    		'tentang'  => $request->tentang,
    	];

    	$nama = [
    		'nama_lengkap' => $request->nama,
    	];

    	$check = Tentang::where('id_admin',session('admin')->id_admin)->first();

    	Admin::where('id_admin',session('admin')->id_admin)->update($nama);

    	if (is_null($check)) {
    		Tentang::create($profil);
    	}else{
    		Tentang::where('id_admin',session('admin')->id_admin)->update($profil);
    	}
    	
    	return back()->with('alert_success', 'Berhasil, profil telah diupdate...');
    }

    public function fotoupdate(Request $request)
    {
    	$filename   = session('admin')->id_admin . 'foto.jpg';
        $file       = $request->file('foto');

    	$profil = [
    		'foto_profil'  => $filename,
    	];

    	$check = Tentang::where('id_admin',session('admin')->id_admin)->first();

    	if ($request->hasFile('foto')) {
            $file->move("images/profil/", $filename);
        }

    	if (is_null($check)) {
    		Tentang::create($profil);
    	}else{
    		Tentang::where('id_admin',session('admin')->id_admin)->update($profil);
    	}
    	
    	return back()->with('alert_success', 'Berhasil, foto profil berhasil disimpan...');
    }

    public function hapusfoto($id_tentang)
    {
        $see = Tentang::findOrFail($id_tentang);
        
        $foto = [
        	'foto_profil' => null,
        ];

        File::delete('images/profil/' . $see->foto_profil);

        Tentang::where('id_tentang',$id_tentang)->update($foto);
        return back()->with('alert_success', 'foto profil berhasil dihapus...');
    }

    public function profile($id_admin)
    {
        $see   = Tentang::where('id_admin',$id_admin)->first();
        $post  = Posting::where('id_admin',$id_admin)->get();

        foreach ($post as $key => $value) {
            $value->komen  = Komentar::where('id_posting',$value->id_posting)->get();
            $value->like   = Komentar::where('id_posting',$value->id_posting)->where('suka',1)->count();
            $value->jumkom = Komentar::where('id_posting',$value->id_posting)->where('Komentar','!=', null)->count();
        }

        $data = [
            'see'  => $see,
            'post' => $post,
        ];

        return view('profile',$data);
    }

    public function fullpage($id_admin)
    {
        $see   = Tentang::where('id_admin',$id_admin)->first();
        $post  = Posting::where('id_admin',$id_admin)->get();

        foreach ($post as $key => $value) {
            $value->komen  = Komentar::where('id_posting',$value->id_posting)->where('Komentar','!=', null)->get();
            $value->like   = Komentar::where('id_posting',$value->id_posting)->where('suka',1)->count();
            $value->jumkom = Komentar::where('id_posting',$value->id_posting)->where('Komentar','!=', null)->count();
            $value->tentang= Tentang::where('id_admin',$value->id_admin)->first();
        }

        $data = [
            'see'  => $see,
            'post' => $post,
        ];

        return view('full',$data);
    }

    public function cari(Request $request)
    {
        $tolek = Admin::where('nama_lengkap', 'like', '%' . $request->cari . '%')->get();
        foreach ($tolek as $key => $value) {
            $value->tentang = Tentang::where('id_admin',$value->id_admin)->first();
        }
        $see   = Tentang::where('id_admin',session('admin')->id_admin)->first();

        $data = [
            'tolek' => $tolek,
            'see'   => $see,
        ];

        return view('cari',$data);
    }
}
