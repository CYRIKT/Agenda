<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Agenda Kegiatan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #333;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
    </style>
</head>
<body>
    <h2>Data Agenda Kegiatan</h2>
    <table>
        <thead>
            <tr>
                <th>Agenda</th>
                <th>Nama Kegiatan</th>
                <th>Tanggal Kegiatan</th>
                <th>Lokasi</th>
                <th>Penyelenggara</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($agenda as $item)
            <tr>
                <td>{{ $item->agenda }}</td>
                <td>{{ $item->nama_kegiatan }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('d M Y') }}</td>
                <td>{{ $item->lokasi }}</td>
                <td>{{ $item->penyelenggara }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
