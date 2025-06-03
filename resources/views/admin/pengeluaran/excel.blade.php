<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Deskripsi</th>
            <th>Jumlah</th>
            <th>Kategori</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pengeluarans as $index => $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
            <td>{{ $item->deskripsi }}</td>
            <td>{{ $item->jumlah }}</td>
            <td>{{ $item->kategori }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
