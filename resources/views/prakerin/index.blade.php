<!-- resources/views/prakerin/index.blade.php -->
@extends('layouts.app')

@section('title', 'Data PKL - SMKN 1 Cirebon')
@section('page-title', 'Data Siswa Prakerin')
@section('page-description', 'Dashboard > Data Siswa')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="h3 fw-bold text-gray-800 mb-1">Data Siswa Prakerin</h2>
                    <p class="text-muted mb-0">Kelola data Praktik Kerja Lapangan siswa</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('prakerin.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-2"></i>Tambah PKL
                    </a>
                    <a href="{{ route('prakerin.cetak.semua') }}" class="btn btn-outline-primary">
                        <i class="fas fa-print me-2"></i>Cetak Semua
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('prakerin.search') }}" method="GET" class="row g-3">
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-search text-primary"></i>
                                </span>
                                <input type="text" name="search" class="form-control border-start-0 ps-0" 
                                       placeholder="Cari berdasarkan NIS, Nama, atau No Sertifikat..." 
                                       value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary px-4">Cari</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="status" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Status</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3">No</th>
                                    <th class="px-4 py-3">No Sertifikat</th>
                                    <th class="px-4 py-3">NIS</th>
                                    <th class="px-4 py-3">Nama Siswa</th>
                                    <th class="px-4 py-3">Tempat PKL</th>
                                    <th class="px-4 py-3">Tanggal</th>
                                    <th class="px-4 py-3">Rata-rata</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($prakerins as $index => $prakerin)
                                <tr>
                                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3">
                                        <span class="fw-semibold">{{ $prakerin->no_sertifikat }}</span>
                                    </td>
                                    <td class="px-4 py-3">{{ $prakerin->nis }}</td>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-2">
                                                <i class="fas fa-user text-primary"></i>
                                            </div>
                                            <div>
                                                <span class="fw-medium">{{ $prakerin->nama }}</span>
                                                <small class="d-block text-muted">{{ $prakerin->keahlian }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <!-- <td class="px-4 py-3">{{ $prakerin->perusahaan->perusahaan_id }}</td> -->
                                     <td class="px-4 py-3">
    @if($prakerin->perusahaan)
        <span class="fw-medium">{{ $prakerin->perusahaan->nama }}</span>
        <small class="d-block text-muted">{{ $prakerin->perusahaan->alamat ?? '' }}</small>
    @else
        <span class="badge bg-warning text-dark">Belum dipilih</span>
    @endif
</td>
                                    <td class="px-4 py-3">
                                        <small>{{ \Carbon\Carbon::parse($prakerin->tgl_mulai)->format('d/m/Y') }}</small>
                                        <br>
                                        <small class="text-muted">- {{ \Carbon\Carbon::parse($prakerin->tgl_selesai)->format('d/m/Y') }}</small>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="fw-bold {{ $prakerin->rata_rata >= 80 ? 'text-success' : ($prakerin->rata_rata >= 70 ? 'text-warning' : 'text-danger') }}">
                                            {{ number_format($prakerin->rata_rata, 2) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        {!! $prakerin->status_label ?? '<span class="badge bg-secondary">-</span>' !!}
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="{{ route('prakerin.show', $prakerin->id) }}" 
                                               class="btn btn-sm btn-info text-white" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('prakerin.edit', $prakerin->id) }}" 
                                               class="btn btn-sm btn-warning text-white" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('prakerin.cetak', $prakerin->id) }}" 
                                               class="btn btn-sm btn-success text-white" title="Cetak Sertifikat" target="_blank">
                                                <i class="fas fa-print"></i>
                                            </a>
                                            <form action="{{ route('prakerin.destroy', $prakerin->id) }}" method="POST" class="d-inline" 
                                                  onsubmit="event.preventDefault(); confirmDelete(this, '{{ $prakerin->nama }}');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="px-4 py-5 text-center">
                                        <div class="py-5">
                                            <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                                            <h5 class="text-muted mb-3">Belum Ada Data PKL</h5>
                                            <p class="text-muted mb-4">Mulai dengan menambahkan data PKL pertama</p>
                                            <a href="{{ route('prakerin.create') }}" class="btn btn-primary">
                                                <i class="fas fa-plus-circle me-2"></i>Tambah Data PKL
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Confirm Delete Function
function confirmDelete(form, nama) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        html: `<p class="fs-6">Apakah Anda yakin ingin menghapus data PKL <strong>${nama}</strong>?</p>
               <p class="small text-danger">Data yang dihapus tidak dapat dikembalikan!</p>`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="fas fa-trash me-2"></i>Ya, Hapus',
        cancelButtonText: '<i class="fas fa-times me-2"></i>Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>
@endpush