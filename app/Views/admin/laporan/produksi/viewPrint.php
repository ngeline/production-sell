<style>
    table,
    td,
    th {
        border: 1px solid #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td,
    th {
        padding: 2px;
    }

    th {
        background-color: #ccc;
    }

    td:nth-child(3),
    td:nth-child(4),
    td:nth-child(5),
    td:nth-child(6),
    td:nth-child(7) {
        text-align: center;
    }
</style>
<center>
    <h1>Laporan Data Produksi</h1>
</center>
<table>
    <thead>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Bahan</th>
        <th>Ukuran</th>
        <th>Jumlah</th>
        <th>Tanggal Produksi</th>
        <th>Harga Satuan</th>
        <th>Status</th>
    </thead>
    <tbody>
        <?php $i = 1 ?>
        <?php foreach ($data as $dt) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $dt['nama_brg']; ?></td>
                <td><?= $dt['bahan']; ?></td>
                <td><?= $dt['ukuran']; ?></td>
                <td><?= $dt['jmlh_brg']; ?></td>
                <td><?= $dt['tgl_pro']; ?></td>
                <td><?= number_format($dt['harga']); ?></td>
                <td><?= $dt['status']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>