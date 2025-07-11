<form method="POST" action="{{ route('manajer.barang_keluar.store') }}">
    @csrf
    <label>Produk</label>
    <select name="product_id" required>
    @foreach ($produk as $p)
        <option value="{{ $p->id }}">{{ $p->nama }}</option>
    @endforeach
    </select>

    <label>Supplier</label>
    <select name="supplier_id" required>
        @foreach ($supplier as $s)
            <option value="{{ $s->id }}">{{ $s->nama }}</option>
        @endforeach
    </select>

    <label>Jumlah</label>
    <input type="number" name="jumlah" min="1" required>

    <label>Satuan</label>
    <input type="text" name="satuan" required>

    <label>Tanggal</label>
    <input type="date" name="tanggal" required>

    <button type="submit">Simpan</button>
</form>
