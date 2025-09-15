<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Karyawan</title>
    <style>
        body { font-family: sans-serif; } .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        /* UBAH INI: Tambahkan 'select' biar stylenya sama */
        input, textarea, select { width: 100%; padding: 8px; box-sizing: border-box; }
        button { padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Tambah Data Karyawan</h1>

    <form action="{{ route('employee.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label>Nomor Telepon</label>
            <input type="text" name="nomor_telepon" required>
        </div>
        <div class="form-group">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" required>
        </div>
        <div class="form-group">
            <label>Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" required>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label>Departemen</label>
            <select name="departemen_id" required>
                <option value="" disabled selected>Pilih Departemen</option>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->nama_departemen }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Jabatan</label>
            <select name="jabatan_id" required>
                <option value="" disabled selected>Pilih Jabatan</option>
                @foreach ($positions as $position)
                    <option value="{{ $position->id }}">{{ $position->nama_jabatan }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
