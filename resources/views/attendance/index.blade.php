@extends('master')

@section('title', 'Daftar Absensi')
@section('page-title', 'Manajemen Absensi')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">
                <i class="bi bi-clock me-2"></i>Data Absensi
            </h5>
            <a href="{{ route('attendance.create') }}" class="btn btn-light btn-sm">
                <i class="bi bi-plus-circle me-1"></i>Input Absensi
            </a>
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
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="border-0">Nama Karyawan</th>
                        <th class="border-0">Tanggal</th>
                        <th class="border-0">Waktu Masuk</th>
                        <th class="border-0">Waktu Keluar</th>
                        <th class="border-0">Status</th>
                        <th class="border-0 text-center" style="width: 180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($attendances as $attendance)
                        <tr>
                            <td class="fw-semibold">{{ $attendance->employee->nama_lengkap ?? 'N/A' }}</td>
                            <td class="text-muted">{{ $attendance->tanggal->format('d M Y') }}</td>
                            <td>
                                <span class="badge bg-success bg-opacity-10 text-success">
                                    <i class="bi bi-clock me-1"></i>{{ $attendance->waktu_masuk }}
                                </span>
                            </td>
                            <td>
                                @if($attendance->waktu_keluar)
                                    <span class="badge bg-danger bg-opacity-10 text-danger">
                                        <i class="bi bi-clock me-1"></i>{{ $attendance->waktu_keluar }}
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($attendance->status_absensi == 'hadir')
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle me-1"></i>Hadir
                                    </span>
                                @elseif($attendance->status_absensi == 'izin')
                                    <span class="badge bg-warning">
                                        <i class="bi bi-exclamation-circle me-1"></i>Izin
                                    </span>
                                @elseif($attendance->status_absensi == 'sakit')
                                    <span class="badge bg-info">
                                        <i class="bi bi-heart-pulse me-1"></i>Sakit
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        <i class="bi bi-x-circle me-1"></i>Alpha
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('attendance.show', $attendance->id) }}" 
                                       class="btn btn-outline-info" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('attendance.edit', $attendance->id) }}" 
                                       class="btn btn-outline-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('attendance.destroy', $attendance->id) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox display-6 d-block mb-2"></i>
                                Tidak ada data absensi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($attendances->hasPages())
    <div class="card-footer bg-light">
        {{ $attendances->links() }}
    </div>
    @endif
</div>
@endsection