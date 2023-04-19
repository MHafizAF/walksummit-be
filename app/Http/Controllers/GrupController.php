<?php

namespace App\Http\Controllers;

use App\Models\Grup;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class GrupController extends Controller
{
    public function index()
    {
        if (request('id')) {
            $grup = Grup::where('id', request('id'))->first();
        } else {
            $grup = Grup::orderBy('id', 'desc')->paginate(10);
        }

        return view('pages.grup.index', [
            'grup' => $grup
        ]);
    }

    public function updateStatus($id)
    {
        $grup = Grup::findOrFail($id);
        $status = $grup->status == 1 ? 0 : 1;

        Grup::where('id', $id)->update([
            'status' => $status,
        ]);

        return back();
    }

    public function detail($id)
    {
        $pendaki = Pelanggan::where('grup_id', '=', $id)->get();

        return view('pages.grup.detail', [
            'id' => $id,
            'pendaki' => $pendaki
        ]);
    }

    public function destroy($id)
    {
        Grup::destroy($id);

        return redirect()->route('grup.index');
    }
}
