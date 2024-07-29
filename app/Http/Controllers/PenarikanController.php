<?php

namespace App\Http\Controllers;

use App\Models\Penarikan;
use Illuminate\Http\Request;

class PenarikanController extends Controller
{
    public function index()
    {
        $penarikans = Penarikan::all();
        return view('nasabah-page.permintaan-penarikan', compact('penarikans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'status' => 'required',
        ]);

        Penarikan::create([
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'status' => $request->status,
        ]);

        return redirect()->route('nasabah.permintaan-penarikan')->with('success', 'Penarikan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $penarikan = Penarikan::findOrFail($id);
        return response()->json($penarikan);
    }
}
