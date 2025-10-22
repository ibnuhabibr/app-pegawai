@extends('master')

@section('title', 'Detail Pegawai')
@section('page-title', 'Detail Pegawai')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white">
                <div class="d-flex align-items-center">
                    <div class="bg-white bg-opacity-20 rounded-circle p-2 me-3">
                        <i class="bi bi-person-circle text-white fs-4"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-0">{{ $employee->nama_lengkap }}</h5>
                        <small class="opacity-75">{{ $employee->email }}</small>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Personal Information -->
                    <div class="col-md-6">
                        <h6 class="text-primary border-bottom pb-2 mb-3">
                            <i class="bi bi-person me-1"></i>Informasi Personal
                        </h6>
                        <div class="mb-3">
                            <label class="form-label text-muted small">Nama Lengkap</label>
                            <p class="fw-semibold mb-1">{{ $employee->nama_lengkap }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small">Email</label>
                            <p class="mb-1">{{ $employee->email }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small">Nomor Telepon</label>
                            <p class="mb-1">{{ $employee->nomor_telepon }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small">Tanggal Lahir</label>
                            <p class="mb-1">{{ \Carbon\Carbon::parse($employee->tanggal_lahir)->format('d F Y') }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small">Alamat</label>
                            <p class="mb-1">{{ $employee->alamat }}</p>
                        </div>
                    </div>
                    
                    <!-- Work Information -->
                    <div class="col-md-6">
                        <h6 class="text-primary border-bottom pb-2 mb-3">
                            <i class="bi bi-briefcase me-1"></i>Informasi Pekerjaan
                        </h6>
                        <div class="mb-3">
                            <label class="form-label text-muted small">Departemen</label>
                            <p class="mb-1">
                                <span class="badge bg-info bg-opacity-10 text-info fs-6">
                                    {{ $employee->department->nama_departemen ?? 'N/A' }}
                                </span>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small">Jabatan</label>
                            <p class="mb-1">
                                <span class="badge bg-secondary bg-opacity-10 text-secondary fs-6">
                                    {{ $employee->position->nama_jabatan ?? 'N/A' }}
                                </span>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small">Tanggal Masuk</label>
                            <p class="mb-1">{{ \Carbon\Carbon::parse($employee->tanggal_masuk)->format('d F Y') }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small">Status</label>
                            <p class="mb-1">
                                @if($employee->status == 'aktif')
                                    <span class="badge bg-success fs-6">
                                        <i class="bi bi-check-circle me-1"></i>Aktif
                                    </span>
                                @else
                                    <span class="badge bg-danger fs-6">
                                        <i class="bi bi-x-circle me-1"></i>Nonaktif
                                    </span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Kembali
                    </a>
                    <div>
                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil me-1"></i>Edit Data
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
