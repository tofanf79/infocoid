<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Iklan;
use App\Models\Gambar;
use App\Models\JenisIklan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Carbon;

class GuestController extends Controller
{
    public function welcome()
    {
        $data['title'] = 'Welcome';
        
        $temps = Iklan::select('iklans.id as id_iklan','jenis_iklan.jenis', 'iklans.judul', 'iklans.deskripsi', 'gambars.path', 'gambars.path_dwt', 'iklans.jam_buka', 'iklans.jam_tutup', 'iklans.created_at', 'iklans.bayar', 'regencies.name as kabupaten')
        ->leftJoin('jenis_iklan', function($join) {
            $join->on('iklans.id_jenis', '=', 'jenis_iklan.id');
          })->leftJoin('gambars', function($join) {
            $join->on('iklans.id', '=', 'gambars.iklan_id');
          })->leftJoin('regencies', function($join) {
            $join->on('regencies.id', '=', 'iklans.kabupaten');
          })->where('iklans.bayar', 'sudah')->latest()->get();
        $iklan = $temps->map(function ($temp){
            $gambar = '';
            if(null !==$temp->path){
                $gambar = $temp->path;
            }
            if(null !==$temp->path_dwt){
                $gambar = $temp->path_dwt;
            }
            return [
                'id'            => $temp->id_iklan,
                'judul'         => $temp->judul,
                'jenis'         => $temp->jenis,
                'jam_buka'         => $temp->jam_buka,
                'jam_tutup'         => $temp->jam_tutup,
                'bayar'         => ucfirst($temp->bayar),
                'deskripsi'         => (strlen($temp->deskripsi) > 50 ? substr($temp->deskripsi,0,50)."..." : $temp->deskripsi),
                'kabupaten'         => $temp->kabupaten,
                'gambar'         => $gambar,
            ];
        });
        $data['iklan'] = $iklan->unique('id');
        $data['jenis_iklan'] = JenisIklan::all();
        return view('welcome', $data);
    }

    public function tentang()
    {
        $data['title'] = 'Tentang';
        $data['jenis_iklan'] = JenisIklan::all();
        return view('tentang', $data);
    }

    public function mengapa()
    {
        $data['title'] = 'Mengapa';
        $data['jenis_iklan'] = JenisIklan::all();
        return view('mengapa', $data);
    }

    public function syarat()
    {
        $data['title'] = 'Syarat';
        $data['jenis_iklan'] = JenisIklan::all();
        return view('syarat', $data);
    }

    public function iklan()
    {
        $data['title'] = 'Iklan';
        $data['jenis_iklan'] = JenisIklan::all();
        return view('iklan', $data);
    }

    public function kerjasama()
    {
        $data['title'] = 'Kerjasama';
        $data['jenis_iklan'] = JenisIklan::all();
        return view('kerjasama', $data);
    }
}
