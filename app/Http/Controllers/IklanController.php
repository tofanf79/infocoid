<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iklan;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use App\Models\JenisIklan;
use App\Models\Gambar;
use App\Http\Requests\StoreIklanRequest;
use Illuminate\Support\Facades\Auth;

use App\Classes\DWT;

class IklanController extends Controller
{
    public function store(StoreIklanRequest $request)
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

        // Simpan data ke database
        $iklan = new Iklan([
            'id_user' => Auth::id(),
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
        ]);
        $iklan->save();

        // Jika ada gambar yang diunggah, simpan juga gambar
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $image) {
                // $path = $image->store('public/images');
        
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

        return response()->json(['message' => 'Data Iklan berhasil disimpan'], 201);
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
        return view('user/pesanan/iklansaya_edit',compact('data','provinces','jenisiklans'));
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
    
    public function iklan(Request $request)
    {
        $data['title'] = 'Iklan';
        $search = $request->get('search');
        if(isset($search)){
            $temps = Iklan::select('iklans.id as id_iklan','jenis_iklan.jenis', 'iklans.judul', 'iklans.deskripsi', 'gambars.path', 'iklans.jam_buka', 'iklans.jam_tutup', 'iklans.created_at', 'iklans.bayar', 'regencies.name as kabupaten', 'gambars.path_dwt')
            ->leftJoin('jenis_iklan', function($join) {
                $join->on('iklans.id_jenis', '=', 'jenis_iklan.id');
              })->leftJoin('gambars', function($join) {
                $join->on('iklans.id', '=', 'gambars.iklan_id');
              })->leftJoin('regencies', function($join) {
                $join->on('regencies.id', '=', 'iklans.kabupaten');
              })->where('iklans.bayar', 'sudah')
              ->where('judul', 'LIKE', "%{$search}%") ->latest()->get();
        }else{
            $temps = Iklan::select('iklans.id as id_iklan','jenis_iklan.jenis', 'iklans.judul', 'iklans.deskripsi', 'gambars.path', 'iklans.jam_buka', 'iklans.jam_tutup', 'iklans.created_at', 'iklans.bayar', 'regencies.name as kabupaten', 'gambars.path_dwt')
            ->leftJoin('jenis_iklan', function($join) {
                $join->on('iklans.id_jenis', '=', 'jenis_iklan.id');
              })->leftJoin('gambars', function($join) {
                $join->on('iklans.id', '=', 'gambars.iklan_id');
              })->leftJoin('regencies', function($join) {
                $join->on('regencies.id', '=', 'iklans.kabupaten');
              })->where('iklans.bayar', 'sudah')->latest()->get();
        }
        $data['search'] = $search;
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
        return view('iklan/iklan')->with('data', $data);
    }
    
    public function jenis_iklan($id)
    {
        $data['title'] = 'Iklan';
        $temps = Iklan::select('iklans.id as id_iklan','jenis_iklan.jenis', 'iklans.judul', 'iklans.deskripsi', 'gambars.path', 'iklans.jam_buka', 'iklans.jam_tutup', 'iklans.created_at', 'iklans.bayar', 'regencies.name as kabupaten', 'gambars.path_dwt')
        ->leftJoin('jenis_iklan', function($join) {
            $join->on('iklans.id_jenis', '=', 'jenis_iklan.id');
          })->leftJoin('gambars', function($join) {
            $join->on('iklans.id', '=', 'gambars.iklan_id');
          })->leftJoin('regencies', function($join) {
            $join->on('regencies.id', '=', 'iklans.kabupaten');
          })->where('iklans.id_jenis', $id)->where('iklans.bayar', 'sudah')->latest()->get();
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
        $data['jenis'] = JenisIklan::where('id', $id)->first();
        return view('iklan/jenisiklan')->with('data', $data);
    }
    
    public function iklan_detail($id)
    {
        $data['title'] = 'Iklan Saya';
        $temp = Iklan::select('iklans.id as id_iklan','jenis_iklan.jenis', 'iklans.judul', 'iklans.deskripsi', 'gambars.path', 'iklans.jam_buka', 'iklans.jam_tutup', 'iklans.hari_kerja', 'iklans.provinsi','districts.name as kecamatan','iklans.desa','iklans.alamat','iklans.bayar', 'regencies.name as kabupaten', 'iklans.bayar', 'gambars.path_dwt', 'iklans.kode_pos', 'iklans.nohp', 'iklans.email')
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
        );
        $data['jenis_iklan'] = JenisIklan::all();
        return view('iklan/iklan_detail')->with('data', $data);
    }

    public function bayar_iklan($id)
    {
      $data = Iklan::find($id);
      $data->update([
              'bayar' => "sudah",
              'tanggal_bayar' =>  date('Y-m-d'),
          ]
      );
      $data = Iklan::find($id);
      return response()->json([
        'data' => 'Berhasil'
        ]);
    }
}
