<!-- @extends('layouts.app')

@section('title', 'Data Perusahaan')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-1">Data Perusahaan</h1>
            <p class="text-muted mb-0">Kelola data perusahaan mitra PKL</p>
        </div>
        <a href="{{ route('perusahaan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i>
            Tambah Perusahaan
        </a>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- TABLE --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Perusahaan</th>
                            <th>Alamat</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($perusahaans as $index => $perusahaan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="fw-semibold">{{ $perusahaan->nama }}</td>
                            <td>{{ $perusahaan->alamat ?? '-' }}</td>
                            <td>

                                {{-- EDIT --}}
                                <a href="{{ route('perusahaan.edit', $perusahaan->id) }}" 
                                   class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- DELETE --}}
                                <form id="delete-form-{{ $perusahaan->id }}" 
                                      action="{{ route('perusahaan.destroy', $perusahaan->id) }}" 
                                      method="POST" 
                                      style="display:inline;">

                                    @csrf
                                    @method('DELETE')

                                    <button type="button"
                                            class="btn btn-sm btn-danger"
                                            onclick="confirmDelete({{ $perusahaan->id }}, '{{ $perusahaan->nama }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">
                                <p class="mb-0 text-muted">Belum ada data perusahaan</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>

@endsection

{{-- SCRIPT HARUS DI LUAR LOOP --}}
@push('scripts')
<script>
function confirmDelete(id, nama) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Perusahaan: " + nama,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
@endpush -->

@extends('layouts.app')

@section('title', 'Data Perusahaan')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-1">Data Perusahaan</h1>
            <p class="text-muted mb-0">Kelola data perusahaan mitra PKL</p>
        </div>

        {{-- HANYA ADMIN YANG BISA TAMBAH --}}
        @if(auth()->user()->role !== 'guru')
        <a href="{{ route('perusahaan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i>
            Tambah Perusahaan
        </a>
        @endif

    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- TABLE --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Perusahaan</th>
                            <th>Alamat</th>

                            {{-- KOLOM AKSI HANYA UNTUK ADMIN --}}
                            @if(auth()->user()->role !== 'guru')
                                <th width="150">Aksi</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($perusahaans as $index => $perusahaan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="fw-semibold">{{ $perusahaan->nama }}</td>
                            <td>{{ $perusahaan->alamat ?? '-' }}</td>

                            {{-- TOMBOL AKSI HANYA ADMIN --}}
                            @if(auth()->user()->role !== 'guru')
                            <td>

                                {{-- EDIT --}}
                                <a href="{{ route('perusahaan.edit', $perusahaan->id) }}" 
                                   class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- DELETE --}}
                                <form id="delete-form-{{ $perusahaan->id }}" 
                                      action="{{ route('perusahaan.destroy', $perusahaan->id) }}" 
                                      method="POST" 
                                      style="display:inline;">

                                    @csrf
                                    @method('DELETE')

                                    <button type="button"
                                            class="btn btn-sm btn-danger"
                                            onclick="confirmDelete({{ $perusahaan->id }}, '{{ $perusahaan->nama }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </form>

                            </td>
                            @endif

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">
                                <p class="mb-0 text-muted">Belum ada data perusahaan</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>

@endsection