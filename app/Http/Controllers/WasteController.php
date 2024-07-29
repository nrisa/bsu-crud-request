<?php

namespace App\Http\Controllers;

use App\Models\Waste;
use Illuminate\Http\Request;

class WasteController extends Controller
{
    // List all wastes
    public function index()
    {
        $wastes = Waste::all();
        return view('admin-page.data-sampah', compact('wastes'));
    }

    // Store a new waste entry
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'category' => 'required|string',
            'type' => 'required|string',
            'kg' => 'required|numeric|min:0',
            'debet' => 'required|numeric|min:0',
            'kredit' => 'required|numeric|min:0',
        ]);

        // Calculate the saldo
        $saldo = $request->debet - $request->kredit;

        Waste::create([
            'date' => $request->date,
            'category' => $request->category,
            'type' => $request->type,
            'kg' => $request->kg,
            'debet' => $request->debet,
            'kredit' => $request->kredit,
            'saldo' => $saldo,
        ]);

        return redirect()->route('admin.data-sampah')->with('success', 'Data sampah berhasil ditambahkan.');
    }

    // Add methods for editing and deleting if necessary
}
