@extends('layouts.app')

@section('title', 'Tambah Guru')

@section('content')

<div class="container py-4">
    <h3 class="mb-4">Tambah Guru</h3>

    <form action="{{ route('guru.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">NIP</label>
            <input type="text" name="nip" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('guru.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

@endsection