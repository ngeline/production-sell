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
    td:nth-child(2),
    td:nth-child(4),
    td:nth-child(5),
    td:nth-child(6) {
        text-align: center;
    }
</style>
<center>
    <h1>Laporan Data Etalase</h1>
</center>
<table>
    <thead>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Jumlah Barang</th>
        <th>Tanggal Masuk</th>
        <th>Ukuran</th>
    </thead>
    <tbody>
        <?php $i = 1 ?>
        <?php foreach ($data as $dt) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $dt['nama_et']; ?></td>
                <td><?= $dt['jmlh_et']; ?></td>
                <td><?= $dt['tgl_et']; ?></td>
                <?php
                $db      = \Config\Database::connect();
                $builder = $db->table('etalase');
                $data = $builder->select('etalase.jmlh_et as stok,p.ukuran,etalase.tgl_et')->join('produksi p', 'etalase.id_pro=p.id_pro')->where('etalase.id_et', $dt['id_et'])->get();
                ?>
                <td>
                    <?php foreach ($data->getResultArray() as $row) : ?>
                        <?= $row['ukuran']; ?>
                    <?php endforeach; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>