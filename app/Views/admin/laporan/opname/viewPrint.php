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

    td:nth-child(1),
    td:nth-child(3),
    td:nth-child(4) {
        text-align: center;
    }
</style>
<center>
    <h1>Laporan Data Opname</h1>
</center>
<table>
    <thead>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Jumlah Barang</th>
        <th>Tanggal Masuk</th>
        <th>Keterangan</th>
    </thead>
    <tbody>
        <?php $i = 1 ?>
        <?php foreach ($data as $dt) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $dt['nama_opn']; ?></td>
                <td><?= $dt['jmlh_opn']; ?></td>
                <td><?= $dt['tgl_opn']; ?></td>
                <td>
                    <p>
                        <?= $dt['ket_opn']; ?>
                    </p>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>