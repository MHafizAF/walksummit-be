<?php

namespace App\Http\Controllers;

use App\Models\Grup;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PemesananController extends Controller
{
    public function listGroup()
    {
        $grup = Grup::all();
        $response = [
            'message' => 'list grup',
            'data' => $grup
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function cariGrup($id)
    {
        $grup = Grup::join('jalurs', 'grups.jalur_id', '=', 'jalurs.id')
            ->join('pelanggans', 'grups.id', '=', 'pelanggans.grup_id')
            ->select('grups.id', 'pelanggans.nama as koordinator', 'grups.status', 'grups.tgl_brangkat', 'jalurs.nama as jalur')
            ->where('grups.id', $id)
            ->first();

        if (!$grup) {
            $response = [
                'message' => 'grup tidak ditemukan',
            ];

            return response()->json($response, Response::HTTP_NOT_FOUND);
        }

        $response = [
            'message' => 'grup ditemukan',
            'data' => $grup
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function cariPelanggan($id)
    {
        $pelanggan = Pelanggan::where('id', $id)->first();

        if (!$pelanggan) {
            $response = [
                'message' => 'pelanggan tidak ditemukan',
            ];

            return response()->json($response, Response::HTTP_NOT_FOUND);
        }

        $response = [
            'message' => 'pelanggan ditemukan',
            'data' => $pelanggan
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function detailGrup($id)
    {
        $pelanggan = Pelanggan::where('grup_id', $id)->get();
        if (count($pelanggan) < 1) {
            $response = [
                'message' => 'grup tidak ditemukan',
            ];

            return response()->json($response, Response::HTTP_NOT_FOUND);
        }

        $response = [
            'message' => 'grup ditemukan',
            'data' => [
                'id' => $id,
                'pelanggan' => $pelanggan
            ]
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function storeGrup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jalur_id' => 'required',
            'tgl_brangkat' => 'required',
            'tgl_pulang' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'message' => 'validation error',
                'error' => $validator->errors()
            ];

            return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $validated = Grup::create([
            'jalur_id' => $request->jalur_id,
            'status' => 0,
            'tgl_brangkat' => $request->tgl_brangkat,
            'tgl_pulang' => $request->tgl_pulang
        ]);

        $response = [
            'message' => 'grup berhasil dibuat',
            'data' => $validated
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    public function storePelanggan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'grup_id' => 'required',
            'nik' => 'required|max:16',
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required|max:16',
            'no_telp_orgtua' => 'required|max:16',
            'jenis_kelamin' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'message' => 'validation error',
                'error' => $validator->errors()
            ];

            return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        Pelanggan::create([
            'grup_id' => $request->grup_id,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'no_telp_orgtua' => $request->no_telp_orgtua,
            'checkout' => 1,
            'jenis_kelamin' => $request->jenis_kelamin
        ]);

        $response = [
            'message' => 'pelanggan berhasil ditambahkan',
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    public function updatePelanggan(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'grup_id' => 'required',
            'nik' => 'required|max:16',
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required|max:16',
            'no_telp_orgtua' => 'required|max:16',
            'checkout' => 'required',
            'jenis_kelamin' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'message' => 'validation error',
                'error' => $validator->errors()
            ];

            return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $pelanggan->update([
            'grup_id' => $request->grup_id,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'no_telp_orgtua' => $request->no_telp_orgtua,
            'checkout' => $request->checkout,
            'jenis_kelamin' => $request->jenis_kelamin
        ]);

        $response = [
            'message' => 'pelanggan berhasil diupdate',
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function deletePelanggan($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        $response = [
            'message' => 'pelanggan berhasil dihapus',
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function deleteGrup($id)
    {
        $grup = Grup::findOrFail($id);
        $grup->delete();

        $response = [
            'message' => 'grup berhasil dihapus',
        ];

        return response()->json($response, Response::HTTP_OK);
    }
}
