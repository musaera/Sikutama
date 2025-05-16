<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Kunjungan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #999; padding: 4px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Laporan Kunjungan</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Tamu</th>
                <th>Instansi</th>
                <th>Nomor Telepon</th>
                <th>Email</th>
                <th>Tujuan</th>
                <th>Bertemu</th>
                <th>Masuk</th>
                <th>Keluar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kunjungan as $k)
                <tr>
                    <td>{{ $k->id }}</td>
                    <td>{{ $k->nama_tamu }}</td>
                    <td>{{ $k->instansi }}</td>
                    <td>{{ $k->nomor_telepon }}</td>
                    <td>{{ $k->email }}</td>
                    <td>{{ $k->tujuan_kunjungan }}</td>
                    <td>{{ $k->bertemu_dengan }}</td>
                    <td>{{ $k->waktu_masuk ? $k->waktu_masuk->format('Y-m-d H:i') : '-' }}</td>
                    <td>{{ $k->waktu_keluar ? $k->waktu_keluar->format('Y-m-d H:i') : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
