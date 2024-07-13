<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use App\Models\JenisIklan;

class IndoregionController extends Controller
{
    public function alamat()
    {
        $jenisiklans = Jenisiklan::all();
        $provinces = Province::all();
        $data['jenis_iklan'] = JenisIklan::all();
        return view('user/pesanan.tambah', compact('provinces','jenisiklans'), $data);
    }
    

    public function getRegency(Request $request)
    {
        $provinceName = $request->provinceName;
        $province = Province::where('name', $provinceName)->first();

        if ($province) {
            $regencies = Regency::where('province_id', $province->id)->get();

            // Membuat array asosiatif ID Kabupaten => Nama Kabupaten
            $regencyMap = $regencies->pluck('name', 'id')->toArray();

            $data = [
                'default' => '-- Pilih Kabupaten --',
                'options' => $regencies->pluck('name', 'id')->map(function ($name, $id) use ($regencyMap) {
                    return ['value' => $id, 'text' => $regencyMap[$id]];
                })->values()->toArray(),
            ];

            return response()->json($data);
        } else {
            return response()->json(['error' => 'Data Provinsi Tidak Ditemukan']);
        }
    }
    
    public function getDistrict(Request $request)
    {
        $regencyId = $request->regencyId;
        $districts = District::where('regency_id', $regencyId)->get();

        $data = [
            'default' => '-- Pilih Kecamatan --',
            'options' => $districts->pluck('name', 'id')->map(function ($name, $id) {
                return ['value' => $id, 'text' => $name];
            })->values()->toArray(),
        ];

        return response()->json($data);
    }

    public function getVillage(Request $request)
    {
        $districtId = $request->districtId;
        $villages = Village::where('district_id', $districtId)->get();

        $data = [
            'default' => '-- Pilih Desa --',
            'options' => $villages->pluck('name', 'name')->map(function ($name) {
                return ['value' => $name, 'text' => $name];
            })->values()->toArray(),
        ];

        return response()->json($data);
    }

}