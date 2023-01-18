<table>
    <thead>
        <tr>
            <th style="background-color: black; color:white"><p style="color: white">Barcode</p></th>
            <th style="background-color: black; color:white"><label style="color: white">Merk</label></th>
            <th style="background-color: black; color:white"><label style="color: white">Kode Barang</label></th>
            <th style="background-color: red; color:white"><label style="color: white">Nama Barang</label></th>
            <th style="background-color: gray; color:white"><label style="color: white">Satuan</label></th>
            <th colspan="5" style="background-color: brown; color:white" align="center"><label style="color: white">Toko</label></th>
            <th style="background-color: brown; color:white"><label style="color: white">Total Toko</label></th>
            <th style="background-color: gray; color:white" colspan="5" align="center"><label style="color: white">Gudang</label></th>
            <th style="background-color: gray; color:white"><label style="color: white">Total Gudang</label></th>
            <th>Tanggal</th>
        </tr>
        <tr>
            <th style="background-color: black"></th>
            <th style="background-color: black"></th>
            <th style="background-color: black"></th>
            <th style="background-color: red"></th>
            <th style="background-color: gray"></th>
            <th style="background-color: brown; color:white">Toko 1</th>
            <th style="background-color: brown; color:white">Toko 2</th>
            <th style="background-color: brown; color:white">Toko 3</th>
            <th style="background-color: brown; color:white">Toko 4</th>
            <th style="background-color: brown; color:white">Toko 5</th>
            <th style="background-color: brown"></th>
            <th style="background-color: gray; color:white">Gudang 1</th>
            <th style="background-color: gray;color:white">Gudang 2</th>
            <th style="background-color: gray;color:white">Gudang 3</th>
            <th style="background-color: gray;color:white">Gudang 4</th>
            <th style="background-color: gray;color:white">Gudang 5</th>
            <th style="background-color: gray"></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $dt)
            <tr>
                <td>{{ $dt->barcode }}</td>
                <td>{{ $dt->merk }}</td>
                <td>{{ $dt->kode_barang }}</td>
                <td>{{ $dt->nama_barang }}</td>
                <td>{{ $dt->satuan }}</td>
                <td>{{ $dt->stok_toko1 }}</td>
                <td>{{ $dt->stok_toko2 }}</td>
                <td>{{ $dt->stok_toko3 }}</td>
                <td>{{ $dt->stok_toko4 }}</td>
                <td>{{ $dt->stok_toko5 }}</td>
                <td>{{ $dt->stok_toko1+$dt->stok_toko2+$dt->stok_toko3+$dt->stok_toko4+$dt->stok_toko5 }}</td>
                <td>{{ $dt->stok_gudang1 }}</td>
                <td>{{ $dt->stok_gudang2 }}</td>
                <td>{{ $dt->stok_gudang3 }}</td>
                <td>{{ $dt->stok_gudang4 }}</td>
                <td>{{ $dt->stok_gudang5 }}</td>
                <td>{{ $dt->stok_gudang1+$dt->stok_gudang2+$dt->stok_gudang3+$dt->stok_gudang4+$dt->stok_gudang5 }}</td>
                <td>{{ $dt->stock_date }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
