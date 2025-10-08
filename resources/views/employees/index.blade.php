@extends('master')

@section('title', 'Daftar Pegawai')
@section('page-title', 'Daftar Pegawai')

@section('content')
<a href="{{ route('employees.create') }}" class="btn btn-success mb-3">+ Tambah Data Pegawai</a>

<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Nomor Telepon</th>
                <th>Status</th>
                <th style="width: 150px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($employees as $employee)
                <tr>
                    <td>{{ $employee->nama_lengkap }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->nomor_telepon }}</td>
                    <td>{{ $employee->status }}</td>
                    <td>
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                            <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $employees->links() }}

@endsection
