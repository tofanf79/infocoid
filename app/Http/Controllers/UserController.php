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
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{
    
    public function tentang()
    {
        $data['title'] = 'Tentang';
        $data['jenis_iklan'] = JenisIklan::all();
        return view('user/usertentang', $data);
    }

    public function mengapa()
    {
        $data['title'] = 'Mengapa';
        $data['jenis_iklan'] = JenisIklan::all();
        return view('user/usermengapa', $data);
    }

    public function syarat()
    {
        $data['title'] = 'Syarat';
        $data['jenis_iklan'] = JenisIklan::all();
        return view('user/usersyarat', $data);
    }

    public function kerjasama()
    {
        $data['title'] = 'Kerjasama';
        $data['jenis_iklan'] = JenisIklan::all();
        return view('user/userkerjasama', $data);
    }

    public function register()
    {
        $data['title'] = 'Register';
        $data['jenis_iklan'] = JenisIklan::all();
        return view('user/akun/register', $data);
    }

    public function register_action(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'tempat' => 'required',
            'tgl_lahir' => 'required',
            'jk' => 'required|in:Laki-Laki,Perempuan',
            'nohp' => 'required',
            'email' => 'required|unique:tb_user',
            'username' => 'required|unique:tb_user',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'foto' => 'required'
        ], [
            'name.required' => 'Nama Tidak Boleh Kosong',
            'tempat.required' => 'Tidak Boleh Kosong',
            'tgl_lahir.required' => 'Tanggal Lahir Tidak Boleh Kosong',
            'jk.required' => 'Pilih Jenis Kelamin',
            'nohp.required' => 'No Telepon Tidak Boleh Kosong',
            'email.required' => 'Email Tidak Boleh Kosong',
            'username.required' => 'Nama Pengguna Tidak Boleh Kosong',
            'username.unique' => 'Nama Pengguna Sudah Digunakan',
            'password.required' => 'Password Tidak Boleh Kosong',
            'password_confirmation.same' => 'Kata Sandi Tidak Sama',
        ]);

        $user = new User([
            'name' => $request -> name,
            'tempat'=> $request -> tempat,
            'tgl_lahir'=> $request -> tgl_lahir,
            'jk'=> $request -> jk,
            'nohp'=> $request -> nohp,
            'email'=> $request -> email,
            'username' => $request->username,
            'foto' => $request->foto,
            'password' => Hash::make($request->password),
        ]);
        $user->save();
        return redirect()->route('login')->with('success','Registrasi Berhasil. Tolong Masuk!');
    }

    public function login()
    {
        $data['title'] = 'Login';
        $data['jenis_iklan'] = JenisIklan::all();
        return view('user/akun/login', $data);
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required', 
        ]);

        if($request->has('rememberme')){
            cookie::queue('username',$request->username, 1440);
            cookie::queue('password',$request->password, 1440);
        }

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            switch (Auth::user()->level) {
                case 'admin':
                    return redirect()->intended('/admin/');
                    break;
                case 'user':
                    return redirect()->intended('/');
                    break;
                
                default:
                    return redirect()->intended('/');
                    break;
            }
        }

        return back()->withErrors([
            'password' => 'Nama Pengguna atau Kata Sandi salah',
        ]);
    }

    public function password()
    {
        $data['title'] = 'Change Password';
        $data['jenis_iklan'] = JenisIklan::all();
        return view('user/profil/profil', $data);
    }

    public function password_action(Request $request)
    {
        $request->validate([
            'old_password' => 'required|current_password',
            'new_password' => 'required|confirmed',
        ]);
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->new_password);
        $user->save();
        $request->session()->regenerate();
        return back()->with('success', 'Password Berhasil Diubah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function forget(){
        $data['title'] = 'Lupa Sandi';
        $data['jenis_iklan'] = JenisIklan::all();
        return view('user/akun/forget', $data);
    }

    public function forget_action(Request $request){
        $request->validate([
            'email'=>'required|email|exists:tb_user,email'
        ]);
    }

    public function profil()
    {
        $data['title'] = 'Update Profil';
        $data['jenis_iklan'] = JenisIklan::all();
        return view('user/profil/profil', $data);
    }
    
    public function profil_action(Request $request){
        $request->validate([
            'name' => 'required',
            'tempat' => 'required',
            'tgl_lahir' => 'required',
            'nohp' => 'required',
            'email' => 'required',
            'foto' => 'mimes:jpg,jpeg,png',
        ]);
        $user = User::find(Auth::id());
        $request->session()->regenerate();
        $user->update($request->all());
        if($request->hasFile('foto')){
            $ex = $request->file('foto')->getClientOriginalExtension();
            $rand = rand().".";
            $request->file('foto')->move('imgprofil/',$request->file('foto')->getClientOriginalName().$rand.$ex);
            $user->foto = $request->file('foto')->getClientOriginalName().$rand.$ex;
            $user->save();
        }
        return back()->with('berhasil', 'Profil Berhasil Diubah!');
    }

    public function iklansaya()
    {
        $data['title'] = 'Iklan Saya';
        $id = Auth::id();
        $temps = Iklan::select('iklans.id as id_iklan','jenis_iklan.jenis', 'iklans.judul', 'iklans.deskripsi', 'gambars.path', 'iklans.jam_buka', 'iklans.jam_tutup', 'iklans.created_at', 'iklans.bayar', 'regencies.name as kabupaten', 'gambars.path_dwt')
        ->leftJoin('jenis_iklan', function($join) {
            $join->on('iklans.id_jenis', '=', 'jenis_iklan.id');
          })->leftJoin('gambars', function($join) {
            $join->on('iklans.id', '=', 'gambars.iklan_id');
          })->leftJoin('regencies', function($join) {
            $join->on('regencies.id', '=', 'iklans.kabupaten');
          })->where('id_user', $id)->latest()->get();
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
        return view('user/useriklansaya')->with('data', $data);
    }

    public function iklansaya_detail($id)
    {
        $data['title'] = 'Iklan Saya';
        $temp = Iklan::select('iklans.id as id_iklan','jenis_iklan.jenis', 'iklans.judul', 'iklans.deskripsi', 'gambars.path', 'iklans.jam_buka', 'iklans.jam_tutup', 'iklans.hari_kerja', 'iklans.provinsi','districts.name as kecamatan','iklans.desa','iklans.alamat','iklans.bayar', 'regencies.name as kabupaten', 'iklans.bayar', 'iklans.tanggal_bayar', 'iklans.kode_pos', 'iklans.nohp', 'iklans.email')
        ->leftJoin('jenis_iklan', function($join) {
            $join->on('iklans.id_jenis', '=', 'jenis_iklan.id');
          })->leftJoin('gambars', function($join) {
            $join->on('iklans.id', '=', 'gambars.iklan_id');
          })->leftJoin('regencies', function($join) {
            $join->on('regencies.id', '=', 'iklans.kabupaten');
          })->leftJoin('districts', function($join) {
            $join->on('districts.id', '=', 'iklans.kecamatan');
          })->where('iklans.id', $id)
          ->first();
        $gambar = Gambar::all()->where('iklan_id', $id);
        $hari_kerja = "";
        foreach (explode(",",$temp->hari_kerja) as $value) {
            $hari_kerja = $hari_kerja.",".ucfirst($value);
        }
        $hari_kerja = substr($hari_kerja, 1);
        $kabupaten = 
        $data = array(
            'id'            => $temp->id_iklan,
            'judul'         => $temp->judul,
            'jenis'         => $temp->jenis,
            'hari_kerja'         => $hari_kerja,
            'jam_buka'         => $temp->jam_buka,
            'jam_tutup'         => $temp->jam_tutup,
            'bayar'         => ucfirst($temp->bayar),
            'deskripsi'         => $temp->deskripsi,
            'gambar'         => $gambar,
            'provinsi'         => $temp->provinsi,
            'kabupaten'         => $temp->kabupaten,
            'kecamatan'         => $temp->kecamatan,
            'desa'         => $temp->desa,
            'alamat'         => $temp->alamat,
            'kode_pos'         => $temp->kode_pos,
            'nohp'         => $temp->nohp,
            'email'         => $temp->email,
            'bayar'         => ucfirst($temp->bayar),
            'tanggal_bayar'         => $temp->tanggal_bayar,
        );
        $data['jenis_iklan'] = JenisIklan::all();
        return view('user/useriklansaya_detail')->with('data', $data);
    }
    
    public function pembayaran()
    {
        $data['title'] = 'Pembayaran';
        $id = Auth::id();
        $temps = Iklan::select('iklans.id as id_iklan','jenis_iklan.jenis', 'iklans.judul', 'iklans.deskripsi', 'gambars.path', 'iklans.jam_buka', 'iklans.jam_tutup', 'iklans.created_at', 'iklans.bayar', 'regencies.name as kabupaten', 'gambars.path_dwt')
        ->leftJoin('jenis_iklan', function($join) {
            $join->on('iklans.id_jenis', '=', 'jenis_iklan.id');
          })->leftJoin('gambars', function($join) {
            $join->on('iklans.id', '=', 'gambars.iklan_id');
          })->leftJoin('regencies', function($join) {
            $join->on('regencies.id', '=', 'iklans.kabupaten');
          })->where('id_user', $id)->where('bayar', 'belum')->latest()->get();
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
        return view('user/userpembayaran')->with('data', $data);
    }

    public function pembayaran_detail($id)
    {
        $data['title'] = 'Pembayaran Detail';
        $temp = Iklan::select('iklans.id as id_iklan','jenis_iklan.jenis', 'iklans.judul', 'iklans.deskripsi', 'gambars.path', 'iklans.jam_buka', 'iklans.jam_tutup', 'iklans.hari_kerja', 'iklans.provinsi','districts.name as kecamatan','iklans.desa','iklans.alamat','iklans.bayar', 'regencies.name as kabupaten', 'iklans.bayar', 'iklans.tanggal_bayar', 'iklans.kode_pos', 'iklans.nohp', 'iklans.email')
        ->leftJoin('jenis_iklan', function($join) {
            $join->on('iklans.id_jenis', '=', 'jenis_iklan.id');
          })->leftJoin('gambars', function($join) {
            $join->on('iklans.id', '=', 'gambars.iklan_id');
          })->leftJoin('regencies', function($join) {
            $join->on('regencies.id', '=', 'iklans.kabupaten');
          })->leftJoin('districts', function($join) {
            $join->on('districts.id', '=', 'iklans.kecamatan');
          })->where('iklans.id', $id)
          ->first();
        $gambar = Gambar::all()->where('iklan_id', $id);
        $hari_kerja = "";
        foreach (explode(",",$temp->hari_kerja) as $value) {
            $hari_kerja = $hari_kerja.",".ucfirst($value);
        }
        $hari_kerja = substr($hari_kerja, 1);
        $kabupaten = 
        $data = array(
            'id'            => $temp->id_iklan,
            'judul'         => $temp->judul,
            'jenis'         => $temp->jenis,
            'hari_kerja'         => $hari_kerja,
            'jam_buka'         => $temp->jam_buka,
            'jam_tutup'         => $temp->jam_tutup,
            'bayar'         => ucfirst($temp->bayar),
            'deskripsi'         => $temp->deskripsi,
            'gambar'         => $gambar,
            'provinsi'         => $temp->provinsi,
            'kabupaten'         => $temp->kabupaten,
            'kecamatan'         => $temp->kecamatan,
            'desa'         => $temp->desa,
            'alamat'         => $temp->alamat,
            'kode_pos'         => $temp->kode_pos,
            'nohp'         => $temp->nohp,
            'email'         => $temp->email,
            'bayar'         => ucfirst($temp->bayar),
            'tanggal_bayar'         => $temp->tanggal_bayar,
        );
        $data['jenis_iklan'] = JenisIklan::all();
        $data['link_bayar'] = 'QRCode.php?s=qr&d='.URL::to('/').'/bayar/'.$temp->id_iklan;
        return view('user/userpembayaran_detail')->with('data', $data);
    }

    public function bayar($id)
    {
        $data['title'] = 'Bayar Saya';
        $temp = Iklan::select('iklans.id as id_iklan','jenis_iklan.jenis', 'iklans.judul', 'iklans.deskripsi', 'gambars.path', 'iklans.jam_buka', 'iklans.jam_tutup', 'iklans.hari_kerja', 'iklans.provinsi','districts.name as kecamatan','iklans.desa','iklans.alamat','iklans.bayar', 'regencies.name as kabupaten', 'iklans.bayar', 'iklans.tanggal_bayar')
        ->leftJoin('jenis_iklan', function($join) {
            $join->on('iklans.id_jenis', '=', 'jenis_iklan.id');
          })->leftJoin('gambars', function($join) {
            $join->on('iklans.id', '=', 'gambars.iklan_id');
          })->leftJoin('regencies', function($join) {
            $join->on('regencies.id', '=', 'iklans.kabupaten');
          })->leftJoin('districts', function($join) {
            $join->on('districts.id', '=', 'iklans.kecamatan');
          })->where('iklans.id', $id)
          ->first();
        $gambar = Gambar::all()->where('iklan_id', $id);
        $hari_kerja = "";
        foreach (explode(",",$temp->hari_kerja) as $value) {
            $hari_kerja = $hari_kerja.",".ucfirst($value);
        }
        $hari_kerja = substr($hari_kerja, 1);
        $kabupaten = 
        $data = array(
            'id'            => $temp->id_iklan,
            'judul'         => $temp->judul,
            'jenis'         => $temp->jenis,
            'hari_kerja'         => $hari_kerja,
            'jam_buka'         => $temp->jam_buka,
            'jam_tutup'         => $temp->jam_tutup,
            'bayar'         => ucfirst($temp->bayar),
            'deskripsi'         => $temp->deskripsi,
            'gambar'         => $gambar,
            'provinsi'         => $temp->provinsi,
            'kabupaten'         => $temp->kabupaten,
            'kecamatan'         => $temp->kecamatan,
            'desa'         => $temp->desa,
            'alamat'         => $temp->alamat,
            'bayar'         => $temp->bayar,
            'tanggal_bayar'         => $temp->tanggal_bayar,
        );
        $data['jenis_iklan'] = JenisIklan::all();
        return view('bayar')->with('data', $data);
    }
}
