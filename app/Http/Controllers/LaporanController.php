<?php

namespace App\Http\Controllers;

use App\Models\Grup;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $year = Carbon::parse($request->month)->format('Y');
        $month = Carbon::parse($request->month)->format('m');
        $laporan = '';

        if ($request->month) {
            $laporan = Grup::join('pelanggans', 'grups.id', '=', 'pelanggans.grup_id')
                ->join('jalurs', 'jalurs.id', '=', 'grups.jalur_id')
                ->select('grups.id', 'pelanggans.nama', 'grups.tgl_brangkat', 'grups.tgl_pulang', 'jalurs.nama as jalur')
                ->whereYear('grups.tgl_brangkat', '=', $year)
                ->whereMonth('grups.tgl_brangkat', '=', $month)
                ->orderBy('grups.id', 'desc')
                ->get();
        } else {
            $laporan = Grup::join('pelanggans', 'grups.id', '=', 'pelanggans.grup_id')
                ->join('jalurs', 'jalurs.id', '=', 'grups.jalur_id')
                ->select('grups.id', 'pelanggans.nama', 'grups.tgl_brangkat', 'grups.tgl_pulang', 'jalurs.nama as jalur')
                ->orderBy('grups.id', 'desc')
                ->get();
        }

        return view('pages.laporan.index')->with([
            'laporan' => $laporan,
        ]);
    }
}
