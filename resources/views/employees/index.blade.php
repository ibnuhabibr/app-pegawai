<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pegawai</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px;}
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Daftar Pegawai</h1>

    <a href="{{ route('employees.create') }}" style="display: inline-block; margin-bottom: 20px; padding: 10px 15px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px;">
    + Tambah Data Pegawai
</a>

    <table>
        <thead>
            <tr>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Nomor Telepon</th>
                <th>Status</th>
                <th>Aksi</th>
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
                    <a href="{{ route('employees.show', $employee->id) }}">Detail</a> |
                    <a href="{{ route('employees.edit', $employee->id) }}">Edit</a> |
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                    </form>
                </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
