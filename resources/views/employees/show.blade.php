<!DOCTYPE html>
<html>
<head>
    <title>Detail Pegawai</title>
    <style>
        body { font-family: sans-serif; }
        table { border-collapse: collapse; width: 50%; margin-top: 20px;}
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; width: 30%; }
    </style>
</head>
<body>
    <h1>Detail Pegawai</h1>

    <table>
        <tr>
            <th>Nama Lengkap</th>
            <td>{{ $employee->nama_lengkap }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $employee->email }}</td>
        </tr>
        <tr>
            <th>Nomor Telepon</th>
            <td>{{ $employee->nomor_telepon }}</td>
        </tr>
        <tr>
            <th>Tanggal Lahir</th>
            <td>{{ $employee->tanggal_lahir }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $employee->alamat }}</td>
        </tr>
        <tr>
            <th>Tanggal Masuk</th>
            <td>{{ $employee->tanggal_masuk }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $employee->status }}</td>
        </tr>
    </table>
    <br>
    <a href="{{ route('employees.index') }}">Kembali ke Daftar</a>
</body>
</html>
