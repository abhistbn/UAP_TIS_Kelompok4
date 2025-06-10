<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Mahasiswa;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'nim' => 'required|string|unique:mahasiswa',
            'nama' => 'required|string',
            'angkatan' => 'required|integer',
            'password' => 'required|string|min:6',
            'prodi_id' => 'required|integer|exists:prodi,id'
        ]);

        try {
            $mahasiswa = Mahasiswa::create([
                'nim' => $request->nim,
                'nama' => $request->nama,
                'angkatan' => $request->angkatan,
                'password' => Hash::make($request->password),
                'prodi_id' => $request->prodi_id
            ]);

            return response()->json(['message' => 'Registrasi berhasil!', 'data' => $mahasiswa], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Registrasi gagal!', 'error' => $e->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'nim' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['nim', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['message' => 'NIM atau password salah'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ], 200);
    }
}