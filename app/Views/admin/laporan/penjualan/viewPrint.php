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
    td:nth-child(5),
    td:nth-child(6) {
        text-align: center;
    }
</style>
<center>
    <h1>Laporan Data Penjualan</h1>
</center>
<table>
    <thead>
        <th>No</th>
        <th>Marketplace</th>
        <th>Tanggal Input</th>
        <th>Nama Barang</th>
        <th>Jumlah Pembelian</th>
        <th>Ukuran</th>
        <th>Total Pembelian</th>
    </thead>
    <tbody>
        <?php $i = 1 ?>
        <?php foreach ($data as $dt) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $dt['marketplace']; ?></td>
                <td><?php echo date('d F Y', strtotime($dt['tgl_inp'])); ?></td>
                <td><?= $dt['nm_pro']; ?></td>
                <td><?= $dt['banyak_brg']; ?></td>
                <td>
                    <?php
                    $db      = \Config\Database::connect();
                    $builder = $db->table('produksi');
                    $data = $builder->select('ukuran')->join('penjualan p', 'produksi.id_pro=p.id_pro')->Where('produksi.id_pro', $dt['id_pro'])->get();
                    ?>
                    <?php foreach ($data->getResultArray() as $pro) : ?>
                        <?= $pro['ukuran']; ?>
                    <?php endforeach; ?>
                </td>
                <td><?= $dt['total_penj']; ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td></td>
            <td colspan="3"><b>Total</b></td>
            <td><?= $total[0]['totPcs']; ?></td>
            <td></td>
            <td style="text-align: left;"><?= $total[0]['totPenjualan']; ?></td>
        </tr>
    </tbody>

</table>