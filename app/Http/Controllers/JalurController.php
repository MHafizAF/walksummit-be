<?php

namespace App\Http\Controllers;

use App\Models\Jalur;
use Illuminate\Http\Request;

class JalurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jalur = Jalur::orderBy('id', 'desc')->paginate(10);

        return view('pages.jalur.index')->with([
            'jalur' => $jalur,
        ]);
    }

    public function updateStatus($id)
    {
        $jalur = Jalur::findOrFail($id);
        $status = $jalur->status == 1 ? 0 : 1;

        Jalur::where('id', $id)->update([
            'status' => $status,
        ]);

        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.jalur.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:jalurs,nama',
            'kuota' => 'required',
        ]);

        Jalur::create([
            'nama' => $request->nama,
            'kuota' => $request->kuota,
        ]);

        return redirect()->route('jalur.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jalur = Jalur::findOrFail($id);

        return view('pages.jalur.edit')->with([
            'jalur' => $jalur,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $oldName = Jalur::findOrFail($id)->nama;

        $request->validate([
            'kuota' => 'required',
        ]);

        if ($oldName != $request->nama) {
            $request->validate([
                'nama' => 'required|unique:jalurs,nama',
            ]);
        }

        Jalur::where('id', $id)->update([
            'nama' => $request->nama,
            'kuota' => $request->kuota,
        ]);

        return redirect()->route('jalur.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jalur::destroy($id);

        return redirect()->route('jalur.index');
    }
}
