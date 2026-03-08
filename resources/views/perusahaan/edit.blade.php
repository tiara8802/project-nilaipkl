@extends('layouts.app')

@section('title', 'Edit Perusahaan - ' . $perusahaan->nama)

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-1">Edit Perusahaan</h1>
            <p class="text-muted mb-0">Edit data perusahaan mitra PKL</p>
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
            <form action="{{ route('perusahaan.update', $perusahaan->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama Perusahaan --}}
                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold">
                        Nama Perusahaan <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           class="form-control @error('nama') is-invalid @enderror" 
                           id="nama" 
                           name="nama" 
                           value="{{ old('nama', $perusahaan->nama) }}"
                           placeholder="Masukkan nama perusahaan"
                           required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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
                              required>{{ old('alamat', $perusahaan->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Informasi Tambahan --}}
                <div class="alert alert-info bg-light border-0 rounded-3 p-3 mb-3">
                    <div class="d-flex">
                        <i class="fas fa-info-circle text-info me-3 mt-1 fa-lg"></i>
                        <div>
                            <small class="text-muted d-block">
                                <strong>Catatan:</strong> Data perusahaan ini akan digunakan untuk:
                            </small>
                            <small class="text-muted d-block">• Tempat PKL siswa</small>
                            <small class="text-muted d-block">• Nama pimpinan/direktur perusahaan</small>
                            <small class="text-muted d-block">• Tanda tangan sertifikat PKL</small>
                        </div>
                    </div>
                </div>

                {{-- Tombol Submit --}}
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('perusahaan.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>
                        Update Perusahaan
                    </button>
                </div>

            </form>
        </div>
    </div>

    {{-- Daftar Siswa PKL di Perusahaan Ini (Optional) --}}
    @if(isset($perusahaan->prakerin) && $perusahaan->prakerin->count() > 0)
    <div class="card shadow-sm border-0 mt-4">
        <div class="card-header bg-light py-3">
            <h5 class="mb-0 fw-semibold">
                <i class="fas fa-users me-2"></i>
                Siswa PKL di {{ $perusahaan->nama }}
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>NIS</th>
                            <th>Periode PKL</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($perusahaan->prakerin as $index => $p)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->nis }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($p->tgl_mulai)->format('d/m/Y') }} - 
                                {{ \Carbon\Carbon::parse($p->tgl_selesai)->format('d/m/Y') }}
                            </td>
                            <td>
                                @if($p->status == 'selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @elseif($p->status == 'perbaikan')
                                    <span class="badge bg-warning text-dark">Perbaikan</span>
                                @else
                                    <span class="badge bg-secondary">{{ $p->status }}</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

</div>

@endsection

@push('scripts')
<script>
// Optional: Auto-capitalize nama perusahaan
document.getElementById('nama')?.addEventListener('blur', function() {
    if (this.value) {
        this.value = this.value.toUpperCase();
    }
});
</script>
@endpush