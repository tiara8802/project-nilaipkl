<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::all();
        return view('guru.index', compact('gurus'));
    }

    public function create()
    {
        return view('guru.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'nip' => 'required|unique:gurus,nip',
    ]);

    Guru::create([
        'nama' => $request->nama,
        'nip' => $request->nip,

        // isi otomatis supaya tidak error
        'email' => uniqid().'@guru.local',
        'password' => bcrypt('123456'),
        'kode_guru' => uniqid(),
        'jabatan' => 'Guru',
        'is_admin' => false,
    ]);

    return redirect()->route('guru.index')
                     ->with('success', 'Guru berhasil ditambahkan');
}
    public function edit(Guru $guru)
    {
        return view('guru.edit', compact('guru'));
    }
    

    public function update(Request $request, Guru $guru)
{
    $request->validate([
        'nama' => 'required',
        'nip' => 'required|unique:gurus,nip,' . $guru->id,
    ]);

    $guru->update([
        'nama' => $request->nama,
        'nip' => $request->nip,
    ]);

    return redirect()->route('guru.index')
        ->with('success', 'Guru berhasil diupdate');
}
    public function destroy(Guru $guru)
{
    $guru->delete();

    return redirect()->route('guru.index')
        ->with('success', 'Guru berhasil dihapus');
}
}