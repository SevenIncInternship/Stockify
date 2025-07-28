<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Barang Masuk</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #000;
            margin: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        .meta {
            font-size: 11px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        th, td {
            border: 1px solid #333;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            text-transform: uppercase;
            font-weight: bold;
        }

        tfoot td {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h2>Laporan Barang Masuk</h2>

    <div class="meta">
        Dicetak tanggal: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Masuk</th>
                <th>SKU</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Supplier</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->tanggal?->format('d-m-Y') ?? '-' }}</td>
                    <td>{{ $item->product->SKU ?? '-' }}</td>          {{-- CASE FIX --}}
                    <td>{{ $item->product->nama ?? '-' }}</td>         {{-- CASE FIX --}}
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->satuan ?? '-' }}</td>
                    <td>{{ $item->supplier->nama ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center;">Tidak ada data tersedia.</td>
                </tr>
            @endforelse
        </tbody>

    </table>

</body>
</html>
