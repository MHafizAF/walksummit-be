<?php

namespace App\Http\Controllers;

use App\Models\Grup;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PemesananController extends Controller
{
    public function listGroup()
    {
        $grup = Grup::all();

        return response()->json($grup, Response::HTTP_OK);
    }

    public function cariGrup($id)
    {
        $grup = Grup::join('jalurs', 'grups.jalur_id', '=', 'jalurs.id')
            ->join('pelanggans', 'grups.id', '=', 'pelanggans.grup_id')
            ->select('grups.id', 'pelanggans.nama as koordinator', 'grups.status', 'jalurs.nama as jalur')
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
}
