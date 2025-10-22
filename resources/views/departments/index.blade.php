@extends('master')

@section('title', 'Daftar Departemen')
@section('page-title', 'Manajemen Departemen')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">
                <i class="bi bi-building me-2"></i>Data Departemen
            </h5>
            <a href="{{ route('departments.create') }}" class="btn btn-light btn-sm">
                <i class="bi bi-plus-circle me-1"></i>Tambah Departemen
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
                        <th class="border-0">ID</th>
                        <th class="border-0">Nama Departemen</th>
                        <th class="border-0 text-center" style="width: 180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($departments as $department)
                        <tr>
                            <td class="text-muted">#{{ $department->id }}</td>
                            <td class="fw-semibold">{{ $department->nama_departemen }}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('departments.show', $department->id) }}" 
                                       class="btn btn-outline-info" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('departments.edit', $department->id) }}" 
                                       class="btn btn-outline-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('departments.destroy', $department->id) }}" 
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
                            <td colspan="3" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox display-6 d-block mb-2"></i>
                                Tidak ada data departemen
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($departments->hasPages())
    <div class="card-footer bg-light">
        {{ $departments->links() }}
    </div>
    @endif
</div>
@endsection