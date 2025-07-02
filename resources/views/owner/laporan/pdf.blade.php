<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: sans-serif; }
        h2 { text-align: center; margin-bottom: 20px; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px 10px;
            text-align: center;
        }
        th {
            background-color: #eee;
        }
    </style>
</head>
<body>
    <h2>Laporan Penjualan Buku</h2>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Judul Buku</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Pembeli</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                    <td>{{ $item->BUKU_JUDUL }}</td>
                    <td>{{ $item->JUMLAH_ITEM }}</td>
                    <td>Rp {{ number_format($item->TOTAL_HARGA, 0, ',', '.') }}</td>
                    <td>{{ $item->user->name ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
