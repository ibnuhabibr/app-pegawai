@extends('master')

@section('title', 'Daftar Pegawai')
@section('page-title', 'Daftar Pegawai')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Pegawai</li>
@endsection

@section('quick-actions')
<div class="btn-group" role="group">
    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="dropdown">
        <i class="bi bi-funnel me-1"></i>Filter
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="?status=aktif">Aktif</a></li>
        <li><a class="dropdown-item" href="?status=nonaktif">Nonaktif</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="{{ route('employees.index') }}">Semua</a></li>
    </ul>
    <a href="{{ route('employees.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-circle me-1"></i>Tambah Pegawai
    </a>
</div>
@endsection

@section('content')
<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-people-fill text-primary fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="text-muted small">Total Pegawai</div>
                        <div class="fs-4 fw-bold text-primary">{{ $employees->total() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-success bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-check-circle-fill text-success fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="text-muted small">Pegawai Aktif</div>
                        <div class="fs-4 fw-bold text-success">{{ $employees->where('status', 'aktif')->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-building text-warning fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="text-muted small">Departemen</div>
                        <div class="fs-4 fw-bold text-warning">{{ $employees->pluck('department.nama_departemen')->unique()->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-info bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-briefcase-fill text-info fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="text-muted small">Jabatan</div>
                        <div class="fs-4 fw-bold text-info">{{ $employees->pluck('position.nama_jabatan')->unique()->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter Bar -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('employees.index') }}" class="row g-3">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" name="search" 
                           placeholder="Cari nama atau email..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select" name="department">
                    <option value="">Semua Departemen</option>
                    @foreach($employees->pluck('department')->unique() as $dept)
                        @if($dept)
                        <option value="{{ $dept->id }}" {{ request('department') == $dept->id ? 'selected' : '' }}>
                            {{ $dept->nama_departemen }}
                        </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" name="status">
                    <option value="">Semua Status</option>
                    <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-funnel me-1"></i>Filter
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Main Data Table -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="card-title mb-0 fw-bold">
                    <i class="bi bi-people-fill me-2 text-primary"></i>Data Pegawai
                </h5>
                <small class="text-muted">Menampilkan {{ $employees->count() }} dari {{ $employees->total() }} pegawai</small>
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
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="border-0 ps-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="selectAll">
                            </div>
                        </th>
                        <th class="border-0">Pegawai</th>
                        <th class="border-0">Kontak</th>
                        <th class="border-0">Departemen</th>
                        <th class="border-0">Jabatan</th>
                        <th class="border-0">Status</th>
                        <th class="border-0 text-center" style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($employees as $employee)
                        <tr class="employee-row" data-employee-id="{{ $employee->id }}">
                            <td class="ps-4">
                                <div class="form-check">
                                    <input class="form-check-input employee-checkbox" type="checkbox" value="{{ $employee->id }}">
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">{{ $employee->nama_lengkap }}</div>
                                        <small class="text-muted">ID: {{ $employee->id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <div class="text-muted small">
                                        <i class="bi bi-envelope me-1"></i>{{ $employee->email }}
                                    </div>
                                    <div class="text-muted small">
                                        <i class="bi bi-telephone me-1"></i>{{ $employee->nomor_telepon }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 px-3 py-2">
                                    <i class="bi bi-building me-1"></i>{{ $employee->department->nama_departemen ?? 'N/A' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 px-3 py-2">
                                    <i class="bi bi-briefcase me-1"></i>{{ $employee->position->nama_jabatan ?? 'N/A' }}
                                </span>
                            </td>
                            <td>
                                @if($employee->status == 'aktif')
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2">
                                        <i class="bi bi-check-circle-fill me-1"></i>Aktif
                                    </span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-3 py-2">
                                        <i class="bi bi-x-circle-fill me-1"></i>Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('employees.show', $employee->id) }}">
                                                <i class="bi bi-eye me-2"></i>Detail
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('employees.edit', $employee->id) }}">
                                                <i class="bi bi-pencil me-2"></i>Edit
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger" 
                                                        onclick="return confirm('Yakin ingin menghapus pegawai ini?')">
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
                                    <i class="bi bi-inbox display-1 text-muted mb-3"></i>
                                    <h5 class="text-muted">Tidak ada data pegawai</h5>
                                    <p class="text-muted mb-3">Belum ada pegawai yang terdaftar dalam sistem</p>
                                    <a href="{{ route('employees.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-circle me-1"></i>Tambah Pegawai Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    @if($employees->hasPages())
    <div class="card-footer bg-light border-top">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-muted small">
                Menampilkan {{ $employees->firstItem() }} - {{ $employees->lastItem() }} dari {{ $employees->total() }} hasil
            </div>
            {{ $employees->links() }}
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select All functionality
    const selectAllCheckbox = document.getElementById('selectAll');
    const employeeCheckboxes = document.querySelectorAll('.employee-checkbox');
    
    selectAllCheckbox?.addEventListener('change', function() {
        employeeCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
    
    // Individual checkbox change
    employeeCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const checkedBoxes = document.querySelectorAll('.employee-checkbox:checked');
            selectAllCheckbox.checked = checkedBoxes.length === employeeCheckboxes.length;
            selectAllCheckbox.indeterminate = checkedBoxes.length > 0 && checkedBoxes.length < employeeCheckboxes.length;
        });
    });
    
    // Row hover effects
    const rows = document.querySelectorAll('.employee-row');
    rows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.backgroundColor = 'rgba(102, 126, 234, 0.05)';
            this.style.transform = 'scale(1.01)';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '';
            this.style.transform = 'scale(1)';
        });
    });
});
</script>
@endsection