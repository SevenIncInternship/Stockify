<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Stok Barang</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; font-size: 12px; text-align: left; }
    </style>
</head>
<body>
    <h2>Laporan Stok Barang</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $product)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $product->nama }}</td>
                    <td>{{ $product->category->nama ?? 'N/A' }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->satuan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
