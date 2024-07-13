<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Carbon;
use App\Models\JenisIklan;
use App\Models\Iklan;
use App\Models\Gambar;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use DB;
use App\Classes\DWT;
use Illuminate\Support\Facades\URL;

class AdminController extends Controller
{
    public function index()
    {
        $data['jenisiklan'] = DB::table('jenis_iklan')->count();
        $data['iklan'] = DB::table('iklans')->count();
        $data['user'] = DB::table('tb_user')->where('level', 'user')->count();
        $data['pembayaran'] = DB::table('iklans')->where('bayar', 'sudah')->count() * 50000;
        return view('admin/index')->with('data', $data);
    }

    public function jenisIklan()
    {
        $temps = JenisIklan::all();
        $data = $temps->map(function ($temp){
            return [
                'id'            => $temp->id,
                'jenis'         => $temp->jenis,
            ];
        });
        return view('admin/jenisiklan')->with('data', $data);
    }

    public function jenisIklan_tambah()
    {
        return view('admin/jenisiklan/tambah');
    }

    public function jenisIklan_tambah_action(Request $request)
    {
        $request->validate([
            'jenis' => 'required',
        ]);
        $data = new jenisIklan([
            'jenis' => $request -> jenis,
        ]);
        $data->save();
        return redirect()->route('admin.jenisiklan');
    }
    
    public function jenisIklan_edit($id)
    {
        $data = jenisIklan::find($id);
        return view('admin/jenisiklan/edit')->with('data', $data);
    }

    public function jenisIklan_edit_action(Request $request)
    {
        $request->validate([
            'jenis' => 'required',
        ]);
        $data = jenisIklan::find($request->id);
        $data->update([
                'jenis' => $request -> jenis,
            ]
        );
        return redirect()->route('admin.jenisiklan');
    }
    
    public function jenisIklan_hapus($id)
    {
      $data = jenisIklan::find($id);
      $data->delete();
      return response()->json([
        'data' => 'Berhasil'
        ]);
    }

    public function iklan()
    {
        $temps = Iklan::select('iklans.id as id_iklan','jenis_iklan.jenis', 'iklans.judul', 'iklans.deskripsi', 'gambars.path', 'iklans.jam_buka', 'iklans.jam_tutup', 'iklans.created_at', 'iklans.bayar', 'tb_user.name as user', 'gambars.path_dwt','iklans.tanggal_bayar')
        ->leftJoin('jenis_iklan', function($join) {
            $join->on('iklans.id_jenis', '=', 'jenis_iklan.id');
          })
        ->leftJoin('gambars', function($join) {
            $join->on('iklans.id', '=', 'gambars.iklan_id');
          })
        ->leftJoin('tb_user', function($join) {
            $join->on('iklans.id_user', '=', 'tb_user.user_id');
        })
        ->latest()->get();
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
                'tanggal_bayar'         => $temp->tanggal_bayar,
                'deskripsi'         => (strlen($temp->deskripsi) > 50 ? substr($temp->deskripsi,0,50)."..." : $temp->deskripsi),
                'provinsi'         => $temp->provinsi,
                'gambar'         => $gambar,
                'user'         => $temp->user,
                'link_bayar' => 'QRCode.php?s=qr&d='.URL::to('/').'/bayar/'.$temp->id_iklan
            ];
        });
        $data = $iklan->unique('id');
        return view('admin/iklan')->with('data', $data);
    }
    
    public function iklan_detail($id)
    { 
        $data['title'] = 'Iklan Detail';
        $temp = Iklan::select('iklans.id as id_iklan','jenis_iklan.jenis', 'iklans.judul', 'iklans.deskripsi', 'gambars.path', 'iklans.jam_buka', 'iklans.jam_tutup', 'iklans.hari_kerja', 'iklans.provinsi','districts.name as kecamatan','iklans.desa','iklans.alamat','iklans.bayar', 'regencies.name as kabupaten', 'iklans.bayar', 'tb_user.name as user', 'iklans.tanggal_bayar', 'iklans.kode_pos', 'iklans.nohp', 'iklans.email')
        ->leftJoin('jenis_iklan', function($join) {
            $join->on('iklans.id_jenis', '=', 'jenis_iklan.id');
          })->leftJoin('gambars', function($join) {
            $join->on('iklans.id', '=', 'gambars.iklan_id');
          })->leftJoin('regencies', function($join) {
            $join->on('regencies.id', '=', 'iklans.kabupaten');
          })->leftJoin('districts', function($join) {
            $join->on('districts.id', '=', 'iklans.kecamatan');
          })
          ->leftJoin('tb_user', function($join) {
              $join->on('iklans.id_user', '=', 'tb_user.user_id');
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
            'bayar'         => ucfirst($temp->bayar),
            'tanggal_bayar'         => $temp->tanggal_bayar,
            'kode_pos'         => $temp->kode_pos,
            'nohp'         => $temp->nohp,
            'email'         => $temp->email,
            'user'         => $temp->user,
        );
        $data['link_bayar'] = 'QRCode.php?s=qr&d='.URL::to('/').'/bayar/'.$temp->id_iklan;
        return view('admin/iklan_detail')->with('data', $data);
    }

    public function user()
    {
        $temps = User::all()->where('level', 'user');
        $data = $temps->map(function ($temp){
            return [
                'id'            => $temp->user_id,
                'nama'         => $temp->name,
                'username'         => $temp->username,
                'tempat'         => $temp->tempat,
                'foto'         => $temp->foto,
                'jenis_kelamin'         => $temp->jk,
            ];
        });
        return view('admin/user')->with('data', $data);
    }
    
    public function user_detail($id)
    { 
        $temp = User::where('user_id', $id)->first();
        $data = array(
            'id'            => $temp->user_id,
            'nama'         => $temp->name,
            'username'         => $temp->username,
            'tempat'         => $temp->tempat,
            'foto'         => $temp->foto,
            'jenis_kelamin'         => $temp->jk,
            'tgl_lahir'         => $temp->tgl_lahir,
            'nohp'         => $temp->nohp,
        );
        return view('admin/user_detail')->with('data', $data);
    }

    public function profil()
    {
        $data['title'] = 'Update Profil';
        return view('admin/profil', $data);
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
    
    public function iklan_edit($id)
    {
        $data = Iklan::find($id);
        $jenisiklans = Jenisiklan::all();
        $provinces = Province::all();
        $kabupaten = Regency::where('id',$data['kabupaten'])->first();
        $kecamatan = District::where('id',$data['kecamatan'])->first();
        $desa = Village::where('name',$data['desa'])->first();
        $data['id_iklan'] = $id;
        $data['hari_kerja'] = explode(',',$data['hari_kerja']);
        $data['kabupaten'] = $kabupaten;
        $data['kecamatan'] = $kecamatan;
        $data['desa'] = $desa;
        $data['gambar'] = Gambar::where('iklan_id',$id)->get();
        $data['jenis_iklan'] = JenisIklan::all();
        return view('admin/iklan/edit',compact('data','provinces','jenisiklans'));
    }

    public function iklan_edit_action(Request $request)
    {
        // Validasi data formulir jika diperlukan
        $request->validate([
            'id_jenis' => 'required|string',
            'judul' => 'required|string',
            'deskripsi' => 'required|string',
            'jam_buka' => 'required',
            'jam_tutup' => 'required',
            'hari_kerja' => 'required',
            'provinsi' => 'sometimes|required',
            'kabupaten' => 'sometimes|required',
            'kecamatan' => 'sometimes|required',
            'desa' => 'sometimes|required',
            'alamat' => 'required',
            'kode_pos' => 'required',
            'nohp' => 'required',
            'email' => 'required',
            'gambar' => 'sometimes|required|array',
            'gambar.*' => 'image|mimes:jpeg,png,jpg',
            
        ]);

        $iklan = Iklan::find($request->input('id_iklan'));
        // Simpan data ke database
        $iklan->update([
                'id_jenis' => $request->input('id_jenis'),
                'judul' => $request->input('judul'),
                'deskripsi' => $request->input('deskripsi'),
                'jam_buka' => $request->input('jam_buka'),
                'jam_tutup' => $request->input('jam_tutup'),
                'hari_kerja' => implode(',', $request->input('hari_kerja')),
                'provinsi' => $request->input('provinsi'),
                'kabupaten' => $request->input('kabupaten'),
                'kecamatan' => $request->input('kecamatan'),
                'desa' => $request->input('desa'),
                'alamat' => $request->input('alamat'),
                'kode_pos' => $request->input('kode_pos'),
                'nohp' => $request->input('nohp'),
                'email' => $request->input('email'),
            ]
        );

        // Jika ada gambar yang diunggah, simpan juga gambar
        if ($request->hasFile('gambar')) {
            $gambar_delete = Gambar::where('iklan_id',$request->input('id_iklan'))->get();
            foreach($gambar_delete as $gambar_dele) {
                $gambar_dele->delete();
            }
            foreach ($request->file('gambar') as $image) {
                // Simpan path gambar ke dalam database
                $ex = $image->getClientOriginalExtension();
                $rand = rand().".";
                $image->move('images/',$image->getClientOriginalName().$rand.$ex);
                $path = 'images/'.$image->getClientOriginalName().$rand.$ex;
                
                $DWT = new DWT;
                $decompress = $DWT->compress($path);

                ob_start();
                imagejpeg($decompress);
                $image_dwt = ob_get_clean();

                $path_dwt = 'dwt/'.$image->getClientOriginalName().$rand."_dwt.jpg";
                file_put_contents($path_dwt,$image_dwt);

                $gambar = new Gambar(['path' => $path,'path_dwt' => $path_dwt]);
                $iklan->gambar()->save($gambar);
            }      
        }

        return response()->json(['message' => 'Data Iklan berhasil diedit'], 201);
    }

    public function iklan_hapus($id)
    {
      $data = Iklan::find($id);
      $data->delete();
      return response()->json([
        'data' => 'Berhasil'
        ]);
    }
}
