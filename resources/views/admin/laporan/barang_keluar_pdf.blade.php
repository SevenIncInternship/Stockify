<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Barang Keluar</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; font-size: 12px; text-align: left; }
    </style>
</head>
<body>
    <h2>Laporan Barang Keluar</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Supplier</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $keluar)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $keluar->product->nama }}</td>
                    <td>{{ $keluar->supplier->nama }}</td>
                    <td>{{ $keluar->jumlah }}</td>
                    <td>{{ $keluar->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
