@extends('layouts.app')

@section('title', 'Edit Guru')

@section('content')

<div class="container py-4">
    <h3 class="mb-4">Edit Guru</h3>

    <form action="{{ route('guru.update', $guru->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control"
                   value="{{ $guru->nama }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">NIP</label>
            <input type="text" name="nip" class="form-control"
                   value="{{ $guru->nip }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('guru.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

@endsection