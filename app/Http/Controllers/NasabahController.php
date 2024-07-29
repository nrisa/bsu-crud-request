<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nasabah;

class NasabahController extends Controller
{
    // List all nasabah
    public function index()
    {
        $nasabahs = Nasabah::all(); // Retrieve all nasabahs from the database
        return view('admin-page.nasabah', compact('nasabahs')); // Return the view with the nasabahs
    }

    // Store a new nasabah
    public function store(Request $request)
    {
        $request->validate([
            'no_induk' => 'required|string|max:255|unique:nasabahs',
            'name' => 'required|string|max:255',
            'email' => 'required',
            'password' => 'required',
            'alamat' => 'required|string|max:255',
            'jumlah' => 'required|integer',
        ]);

        Nasabah::create([
            'no_induk' => $request->no_induk,
            'name' => $request->name,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'password' => $request->password,
            'jumlah' => $request->jumlah,
            'password' => bcrypt('default_password'), // Set a default password or use any hash mechanism
        ]);

        return redirect()->route('admin.nasabah')->with('success', 'Nasabah added successfully.');
    }
}
