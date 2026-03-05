<?php

namespace App\Http\Controllers;

use App\Models\perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perusahaans = Perusahaan::all();
        return view('perusahaan.index', compact('perusahaans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('perusahaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'nama' => 'required',
        'alamat' => 'required',
    ]);

    Perusahaan::create([
        'nama' => $request->nama,
        'alamat' => $request->alamat,
    ]);

        return redirect()->route('perusahaan.index')
                        ->with('success', 'Perusahaan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(perusahaan $perusahaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(perusahaan $perusahaan)
    {
        return view('perusahaan.edit', compact('perusahaan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, perusahaan $perusahaan)
    {
        $request->validate([
        'nama' => 'required',
        'alamat' => 'required'
    ]);

    $perusahaan->update([
        'nama' => $request->nama,
        'alamat' => $request->alamat,
    ]);

    return redirect()->route('perusahaan.index')
        ->with('success', 'Perusahaan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(perusahaan $perusahaan)
    {
        $perusahaan->delete();

    return redirect()->route('perusahaan.index')
        ->with('success', 'Perusahaan berhasil dihapus');
    }
}
