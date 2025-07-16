<!DOCTYPE html>
<html>
<head>
    <title>Laporan Dashboard Manajer</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Laporan Dashboard Manajer</h2>
    <p style="text-align: center;">Tanggal: {{ date('d-m-Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Item</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Total Produk</td>
                <td>{{ $totalProduk }}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Barang Masuk Hari Ini</td>
                <td>{{ $barangMasuk }}</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Barang Keluar Hari Ini</td>
                <td>{{ $barangKeluar }}</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Total Stock Opname</td>
                <td>{{ $totalOpname }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
