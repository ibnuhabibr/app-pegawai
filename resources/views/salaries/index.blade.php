@extends('master')

@section('title', 'Daftar Gaji')
@section('page-title', 'Manajemen Gaji')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Gaji</li>
@endsection

@section('quick-actions')
<a href="{{ route('salaries.create') }}" class="btn btn-primary btn-sm">
    <i class="bi bi-plus-circle me-1"></i>Input Gaji
</a>
@endsection

@section('content')
<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-receipt text-primary fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="text-muted small">Total Record</div>
                        <div class="fs-4 fw-bold text-primary">{{ $salaries->total() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-success bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-currency-dollar text-success fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="text-muted small">Total Gaji</div>
                        <div class="fs-5 fw-bold text-success">
                            Rp {{ number_format($salaries->sum('total_gaji'), 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-graph-up text-warning fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="text-muted small">Rata-rata Gaji</div>
                        <div class="fs-6 fw-bold text-warning">
                            Rp {{ number_format($salaries->avg('total_gaji'), 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-info bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-trophy text-info fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="text-muted small">Gaji Tertinggi</div>
                        <div class="fs-6 fw-bold text-info">
                            Rp {{ number_format($salaries->max('total_gaji'), 0, ',', '.') }}
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
                    <i class="bi bi-currency-dollar me-2 text-primary"></i>Data Gaji
                </h5>
                <small class="text-muted">Menampilkan {{ $salaries->count() }} dari {{ $salaries->total() }} record gaji</small>
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
                        <th class="border-0 ps-4">Karyawan</th>
                        <th class="border-0">Periode</th>
                        <th class="border-0">Gaji Pokok</th>
                        <th class="border-0">Tunjangan</th>
                        <th class="border-0">Potongan</th>
                        <th class="border-0">Total Gaji</th>
                        <th class="border-0 text-center" style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($salaries as $salary)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 36px; height: 36px;">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">{{ $salary->employee->nama_lengkap ?? 'N/A' }}</div>
                                        <small class="text-muted">{{ $salary->employee->department->nama_departemen ?? 'N/A' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ \Carbon\Carbon::parse($salary->bulan.'-01')->format('M Y') }}</div>
                                <small class="text-muted">Periode gaji</small>
                            </td>
                            <td>
                                <div class="text-success">Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</div>
                            </td>
                            <td>
                                <div class="text-info">Rp {{ number_format($salary->tunjangan, 0, ',', '.') }}</div>
                            </td>
                            <td>
                                <div class="text-danger">Rp {{ number_format($salary->potongan, 0, ',', '.') }}</div>
                            </td>
                            <td>
                                <div class="fw-bold text-primary fs-6">
                                    Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('salaries.show', $salary->id) }}">
                                                <i class="bi bi-eye me-2"></i>Detail
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('salaries.edit', $salary->id) }}">
                                                <i class="bi bi-pencil me-2"></i>Edit
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger" 
                                                        onclick="return confirm('Yakin ingin menghapus data gaji ini?')">
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
                            <td colspan="7" class="text-center py-5">
                                <div class="empty-state">
                                    <i class="bi bi-receipt display-1 text-muted mb-3"></i>
                                    <h5 class="text-muted">Tidak ada data gaji</h5>
                                    <p class="text-muted mb-3">Belum ada data gaji yang diinput dalam sistem</p>
                                    <a href="{{ route('salaries.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-circle me-1"></i>Input Gaji Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    @if($salaries->hasPages())
    <div class="card-footer bg-light border-top">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-muted small">
                Menampilkan {{ $salaries->firstItem() }} - {{ $salaries->lastItem() }} dari {{ $salaries->total() }} hasil
            </div>
            {{ $salaries->links() }}
        </div>
    </div>
    @endif
</div>
@endsection