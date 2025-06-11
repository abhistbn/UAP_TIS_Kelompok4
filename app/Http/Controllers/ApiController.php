<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAllProdi()
    {
        return response()->json(['prodi' => Prodi::all()], 200);
    }

    public function getAllMahasiswa()
    {
        return response()->json(['mahasiswa' => Mahasiswa::with('prodi')->get()], 200);
    }

    public function getMahasiswaByProdi($id)
    {
        $mahasiswa = Mahasiswa::with('prodi')->where('prodi_id', $id)->get();
        return response()->json(['mahasiswa' => $mahasiswa], 200);
    }

    public function getAllMatakuliah()
    {
        return response()->json(['matakuliah' => Matakuliah::all()], 200);
    }

    public function tambahMatakuliah(Request $request)
    {
        $this->validate($request, [
            'mkId' => 'required|integer|exists:matakuliah,id',
        ]);

        $mahasiswa = Auth::user();
        if ($mahasiswa->matakuliahs()->where('matakuliah.id', $request->mkId)->exists()) {
            return response()->json(['message' => 'Mata kuliah sudah diambil'], 409);
        }

        $mahasiswa->matakuliahs()->attach($request->mkId);

        return response()->json(['message' => 'Mata kuliah berhasil ditambahkan'], 201);
    }

    public function getMatakuliahMahasiswa()
    {
        $mahasiswa = Auth::user();
        $matakuliah = $mahasiswa->matakuliahs()->get();
        return response()->json(['matakuliah_diambil' => $matakuliah], 200);
    }
}