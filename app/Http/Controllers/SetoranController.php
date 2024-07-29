<?php
// app/Http/Controllers/SetoranController.php

namespace App\Http\Controllers;

use App\Models\Setoran;
use Illuminate\Http\Request;

class SetoranController extends Controller
{
    public function index()
    {
        $setorans = Setoran::all();
        return view('nasabah-page.setoran-sampah', compact('setorans'));
    }
    public function admin()
    {
        $setorans = Setoran::all();
        return view('admin-page.setoran-sampah', compact('setorans'));
    }
    public function riwayat()
    {
        $setorans = Setoran::all();
        return view('nasabah-page.riwayat-setoran', compact('setorans'));
    }
    public function riwayatAdmin()
    {
        $setorans = Setoran::all();
        return view('admin-page.riwayat-setoran', compact('setorans'));
    }

    public function create()
    {
        return view('setoran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nasabah' => 'required|string',
            'tanggal' => 'required|date',
            'setor' => 'required|string',
            'jumlah_setoran' => 'required|numeric',
            'total_poin' => 'required|integer',
            'total_setoran' => 'required|numeric',
        ]);

        Setoran::create($request->all());

        return redirect()->route('nasabah.setoran-sampah')->with('success', 'Setoran created successfully.');
    }
    public function storeAdmin(Request $request)
    {
        $request->validate([
            'nasabah' => 'required|string',
            'tanggal' => 'required|date',
            'setor' => 'required|string',
            'jumlah_setoran' => 'required|numeric',
            'total_poin' => 'required|integer',
            'total_setoran' => 'required|numeric',
        ]);

        Setoran::create($request->all());

        return redirect()->route('admin.setoran-sampah')->with('success', 'Setoran created successfully.');
    }

    public function show(Setoran $setoran)
    {
        return view('setoran.show', compact('setoran'));
    }

    public function edit(Setoran $setoran)
    {
        return view('setoran.edit', compact('setoran'));
    }

    public function update(Request $request, Setoran $setoran)
    {
        $request->validate([
            'nasabah' => 'required|string',
            'tanggal' => 'required|date',
            'setor' => 'required|string',
            'jumlah_setoran' => 'required|numeric',
            'total_poin' => 'required|integer',
            'total_setoran' => 'required|numeric',
        ]);

        $setoran->update($request->all());

        return redirect()->route('nasabah.setoran-sampah')->with('success', 'Setoran updated successfully.');
    }

    public function destroy($id)
    {
        $setoran = Setoran::findOrFail($id);
        $setoran->delete();
        return redirect()->route('nasabah.setoran-sampah')->with('success', 'Setoran berhasil dihapus');
    }

    public function destroyAdmin($id)
    {
        $setoran = Setoran::findOrFail($id);
        $setoran->delete();
        return redirect()->route('admin.setoran-sampah')->with('success', 'Setoran berhasil dihapus');
    }
    
}

