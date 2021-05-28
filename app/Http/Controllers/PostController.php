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

class PostController extends Controller
{
    public function createpost(Request $request)
    {
    	$filename   = Posting::max('id_posting') + 1 . 'posting.jpg';
        $file       = $request->file('foto');

    	$posting = [
    		'id_admin'  	=> session('admin')->id_admin,
    		'foto'			=> $filename,
    		'caption'		=> $request->caption,
    		'ijin_komen'	=> $request->ijin_komen,
    		'ijin'			=> $request->ijin,
    	];

    	if ($request->hasFile('foto')) {
            $file->move("images/posting/", $filename);
        }

		Posting::create($posting);
    	return back()->with('alert_success', 'Berhasil, posting anda berhasil disimpan...');
    }

    public function updatepost(Request $request, $id_posting)
    {
    	$filename   = $id_posting . 'posting.jpg';
        $file       = $request->file('foto');

    	$posting = [
    		'id_admin'  	=> session('admin')->id_admin,
    		'foto'			=> $filename,
    		'caption'		=> $request->caption,
    		'ijin_komen'	=> $request->ijin_komen,
    		'ijin'			=> $request->ijin,
    	];

    	if ($request->hasFile('foto')) {
            $file->move("images/posting/", $filename);
        }

		Posting::where('id_posting',$id_posting)->update($posting);
    	return back()->with('alert_success', 'Berhasil, posting anda berhasil disimpan...');
    }

    public function hapuspost($id_posting)
    {
        $see = Posting::findOrFail($id_posting);

        File::delete('images/posting/' . $see->foto);
        Komentar::where('id_posting',$id_posting)->delete();
        Posting::where('id_posting',$id_posting)->delete();
        return back()->with('alert_success', 'posting anda berhasil dihapus...');
    }

    public function likepost(Request $request, $id_posting)
    {
    	$check = Komentar::where('id_posting',$id_posting)->where('id_admin',session('admin')->id_admin)->first();

    	if (is_null($check)) {
    		$suka = [
    			'id_posting'	=> $id_posting,
	    		'suka' 			=> 1,
	    		'id_admin'		=> session('admin')->id_admin,
	    	];

			Komentar::create($suka);
    	}else{
    		if ($check->suka == 0) {
    			$like = 1 ;
    		}else{
    			$like = 0 ;
    		}

    		$suka = [
	    		'suka' => $like,
	    	];

			Komentar::where('id_komentar', $check->id_komentar)->update($suka);
    	}

    	return back();
    }

    public function createkomen(Request $request, $id_posting)
    {
    	$komen = [
    		'id_posting'  	=> $id_posting,
    		'id_admin'  	=> session('admin')->id_admin,
    		'komentar'		=> $request->komentar,
    	];

		Komentar::create($komen);
    	return back()->with('alert_success', 'Berhasil, posting anda berhasil disimpan...');
    }
}
