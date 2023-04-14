<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Grup;
use App\Models\Jalur;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $grup = Grup::count();
        $admin = Admin::count();
        $jalur = Jalur::where('status', 1)->count();
        $pendaki = Pelanggan::where('checkout', 0)->count();

        return view('pages.dashboard')->with([
            'grup' => $grup,
            'admin' => $admin,
            'jalur' => $jalur,
            'pendaki' => $pendaki,
        ]);
    }
}
