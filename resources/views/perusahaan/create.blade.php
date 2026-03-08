<!-- @extends('layouts.app')

@section('title', 'Tambah Perusahaan Baru')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-1">Tambah Perusahaan</h1>
            <p class="text-muted mb-0">Tambah data perusahaan mitra PKL</p>
        </div>
        <a href="{{ route('perusahaan.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>
            Kembali
        </a>
    </div>

    {{-- ERROR MESSAGE --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- FORM --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form action="{{ route('perusahaan.store') }}" method="POST">
                @csrf

                {{-- Nama Perusahaan --}}
                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold">
                        Nama Perusahaan <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           class="form-control @error('nama') is-invalid @enderror" 
                           id="nama" 
                           name="nama" 
                           value="{{ old('nama') }}"
                           placeholder="Masukkan nama perusahaan"
                           required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Contoh: PT. NUSABOT TEKNOLOGI INDONESIA</small>
                </div>

                {{-- Alamat --}}
                <div class="mb-3">
                    <label for="alamat" class="form-label fw-semibold">
                        Alamat Perusahaan <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror" 
                              id="alamat" 
                              name="alamat" 
                              rows="3"
                              placeholder="Masukkan alamat lengkap perusahaan"
                              required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Contoh: Jl. Sudirman No. 123, Kota Cirebon</small>
                </div>

                {{-- Tombol Submit --}}
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('perusahaan.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>
                        Simpan Perusahaan
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection -->

@extends('layouts.app')

@php
use Illuminate\Support\Facades\Auth;
$user = Auth::guard('guru')->user();
$isAdmin = $user->is_admin;
$isGuru = !$user->is_admin;
@endphp

@section('title', 'Tambah Perusahaan Baru')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-1">Tambah Perusahaan</h1>
            <p class="text-muted mb-0">Tambah data perusahaan mitra PKL</p>
        </div>
        <a href="{{ route('perusahaan.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>
            Kembali
        </a>
    </div>

    {{-- INFO ROLE --}}
    <div class="alert {{ $isAdmin ? 'alert-primary' : 'alert-info' }} shadow-sm">
        <strong>Login sebagai:</strong>
        {{ $isAdmin ? 'ADMIN SEKOLAH' : 'GURU PEMBIMBING' }}
        <br>
        <small>
            @if($isAdmin)
                Anda dapat menambah data perusahaan.
            @else
                Data perusahaan hanya dapat diinput oleh Admin (mode readonly).
            @endif
        </small>
    </div>

    {{-- ERROR MESSAGE --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- FORM --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form action="{{ route('perusahaan.store') }}" method="POST">
                @csrf

                {{-- Nama Perusahaan --}}
                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold">
                        Nama Perusahaan <span class="text-danger">*</span>
                    </label>

                    <input type="text" 
                           class="form-control @error('nama') is-invalid @enderror {{ $isGuru ? 'bg-light text-muted' : '' }}" 
                           id="nama" 
                           name="nama" 
                           value="{{ old('nama') }}"
                           placeholder="Masukkan nama perusahaan"
                           {{ $isGuru ? 'readonly disabled' : '' }}
                           required>

                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <small class="text-muted">
                        Contoh: PT. NUSABOT TEKNOLOGI INDONESIA
                    </small>
                </div>

                {{-- Alamat --}}
                <div class="mb-3">
                    <label for="alamat" class="form-label fw-semibold">
                        Alamat Perusahaan <span class="text-danger">*</span>
                    </label>

                    <textarea class="form-control @error('alamat') is-invalid @enderror {{ $isGuru ? 'bg-light text-muted' : '' }}" 
                              id="alamat" 
                              name="alamat" 
                              rows="3"
                              placeholder="Masukkan alamat lengkap perusahaan"
                              {{ $isGuru ? 'readonly disabled' : '' }}
                              required>{{ old('alamat') }}</textarea>

                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <small class="text-muted">
                        Contoh: Jl. Sudirman No. 123, Kota Cirebon
                    </small>
                </div>

                {{-- Tombol Submit --}}
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('perusahaan.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>
                        Batal
                    </a>

                    @if($isAdmin)
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>
                        Simpan Perusahaan
                    </button>
                    @endif
                </div>

            </form>
        </div>
    </div>

</div>

@endsection