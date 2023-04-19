<?php

namespace App\Http\Controllers;

use App\Models\Jalur;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class GunungController extends Controller
{
    public function getInformasiGunung()
    {
        $jumlahPendaki = Pelanggan::where('checkout', 0)->count();
        $jumlahKuota = Jalur::where('status', 1)->sum('kuota');
        $sisaKuota = $jumlahKuota - $jumlahPendaki;
        $kuotaTiapJalur = Jalur::where('status', 1)->select('id', 'nama', 'kuota')->get();
        $jumlahPendakiTiapJalur = Pelanggan::join('grups', 'pelanggans.grup_id', '=', 'grups.id')
            ->where('checkout', 0)
            ->select('grups.jalur_id', DB::raw('count(pelanggans.id) as jumlah'))
            ->groupBy('grups.jalur_id')
            ->get();

        for ($i = 0; $i < count($kuotaTiapJalur); $i++) {
            foreach ($jumlahPendakiTiapJalur as $jumlah) {
                if ($jumlah->jalur_id == $kuotaTiapJalur[$i]->id) {
                    $kuotaTiapJalur[$i]['kuota'] = $kuotaTiapJalur[$i]['kuota'] - $jumlah->jumlah;
                }
            }
        }

        $response = [
            'message' => 'informasi gunung',
            'data' => [
                'jumlah_pendaki' => $jumlahPendaki,
                'kuota_maksimal' => $jumlahKuota,
                'sisa_kuota' => $sisaKuota,
                'kuota_tiap_jalur' => $kuotaTiapJalur
            ]
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function getAllJalur()
    {
        $jalur = Jalur::all();
        $response = [
            'message' => 'jalur',
            'data' => [$jalur]
        ];

        return response()->json($response, Response::HTTP_OK);
    }
}
