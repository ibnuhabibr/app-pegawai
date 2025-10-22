@extends('master')

@section('title', 'Daftar Jabatan')
@section('page-title', 'Manajemen Jabatan')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Jabatan</li>
@endsection

@section('quick-actions')
<a href="{{ route('positions.create') }}" class="btn btn-primary btn-sm">
    <i class="bi bi-plus-circle me-1"></i>Tambah Jabatan
</a>
@endsection

@section('content')
<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-briefcase-fill text-primary fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="text-muted small">Total Jabatan</div>
                        <div class="fs-4 fw-bold text-primary">{{ $positions->total() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-success bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-currency-dollar text-success fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="text-muted small">Rata-rata Gaji</div>
                        <div class="fs-5 fw-bold text-success">
                            Rp {{ number_format($positions->avg('gaji_pokok'), 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-info bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-graph-up text-info fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="text-muted small">Gaji Tertinggi</div>
                        <div class="fs-5 fw-bold text-info">
                            Rp {{ number_format($positions->max('gaji_pokok'), 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Data Table -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="card-title mb-0 fw-bold">
                    <i class="bi bi-briefcase me-2 text-primary"></i>Data Jabatan
                </h5>
                <small class="text-muted">Menampilkan {{ $positions->count() }} dari {{ $positions->total() }} jabatan</small>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-secondary btn-sm" onclick="window.print()">
                    <i class="bi bi-printer me-1"></i>Print
                </button>
                <button class="btn btn-outline-success btn-sm">
                    <i class="bi bi-file-earmark-excel me-1"></i>Export
                </button>
            </div>
        </div>
    </div>
    
    <div class="card-body p-0">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show m-3 mb-0" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="border-0 ps-4">ID</th>
                        <th class="border-0">Jabatan</th>
                        <th class="border-0">Gaji Pokok</th>
                        <th class="border-0 text-center" style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($positions as $position)
                        <tr>
                            <td class="ps-4">
                                <span class="badge bg-light text-muted border">#{{ $position->id }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 36px; height: 36px;">
                                        <i class="bi bi-briefcase"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">{{ $position->nama_jabatan }}</div>
                                        <small class="text-muted">Posisi Jabatan</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold text-success">
                                    Rp {{ number_format($position->gaji_pokok, 0, ',', '.') }}
                                </div>
                                <small class="text-muted">Per bulan</small>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('positions.show', $position->id) }}">
                                                <i class="bi bi-eye me-2"></i>Detail
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('positions.edit', $position->id) }}">
                                                <i class="bi bi-pencil me-2"></i>Edit
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ route('positions.destroy', $position->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger" 
                                                        onclick="return confirm('Yakin ingin menghapus jabatan ini?')">
                                                    <i class="bi bi-trash me-2"></i>Hapus
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="empty-state">
                                    <i class="bi bi-briefcase display-1 text-muted mb-3"></i>
                                    <h5 class="text-muted">Tidak ada data jabatan</h5>
                                    <p class="text-muted mb-3">Belum ada jabatan yang terdaftar dalam sistem</p>
                                    <a href="{{ route('positions.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-circle me-1"></i>Tambah Jabatan Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    @if($positions->hasPages())
    <div class="card-footer bg-light border-top">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-muted small">
                Menampilkan {{ $positions->firstItem() }} - {{ $positions->lastItem() }} dari {{ $positions->total() }} hasil
            </div>
            {{ $positions->links() }}
        </div>
    </div>
    @endif
</div>
@endsection