<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Petugas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PetugasController extends Controller
{
    public function createPetugas(Request $request)
    {
        $petugas = Petugas::insert([
            'nama' => $request->input('nama'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password'))
        ]);

        if ($petugas) {
            return response()->json([
                'success' => true,
                'message' => 'Petugas berhasil dibuat'
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Petugas gagal dibuat'
            ], 400);
        }
    }

    public function loginPetugas(Request $request)
    {
        $petugas = Petugas::where('username', $request->input('username'))->first();
        if (Hash::check($request->input('password'), $petugas->password)) {
            $apiToken = base64_encode(\str_random(40));

            $petugas->update([
                'api_key' => $apiToken
            ]);

            if ($petugas) {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil login',
                    'data' => [
                        'petugas' => $petugas,
                        'api_key' => $apiToken
                    ]
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal login'
                ], 400);
            }
        }
    }

    public function updatePetugasById(Request $request)
    {
        $petugas = Petugas::where('id', $request->input('id'))->update([
            'nama' => $request->input('nama'),
            'username' => $request->input('username'),
        ]);

        if ($petugas) {
            return response()->json([
                'success' => true,
                'message' => 'petugas berhasil dirubah'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'petugas gagal dirubah'
            ], 400);
        }
    }

    public function updatePetugas(Request $request)
    {
        $petugas = Auth::user();

        $petugas->update([
            'nama' => $request->input('nama'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password'))
        ]);

        if ($petugas) {
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dirubah'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'password gagal dirubah'
            ], 400);
        }
    }

    public function deletePetugas($id)
    {
        $petugas = Petugas::where('id', $id)->delete();
        if ($petugas) {
            return response()->json([
                'success' => true,
                'message' => 'petugas berhasil dihapus'
            ], 200);
        }
    }

    public function getAllPetugas()
    {
        $listPetugas = Petugas::all();

        if ($listPetugas) {
            return response()->json([
                'success' => true,
                'message' =>  'List petugas berhasil di dapatkan',
                'data' => $listPetugas
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'List petugas gagal didapatkan'
            ], 400);
        }
    }


    public function getPetugas($id)
    {
        $petugas = Petugas::find($id)->get();

        if ($petugas) {
            return response()->json([
                'success' => true,
                'message' => 'Petugas berhasil didapatkan',
                'data' => $petugas
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Petugas gagal didapatkan'
            ], 400);
        }
    }
}
