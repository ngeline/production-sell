<?php
$db      = \Config\Database::connect();
$builder = $db->table('produksi');
$data = $builder->where('status !=', 'Masuk Etalase')->orWhere('status', null)->where('deleted_at', null)->orderBy('created_at', 'desc')->get();
?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row ">
                    <div class="col-md">
                        <h6><?= $title; ?> | On Process</h6>
                        <a role="button" id="createData" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#create-data"><i class="fas fa-edit"></i> Tambah Data</a>
                    </div>
                    <div class="col-md">
                    </div>
                </div>
                <?= view('admin\layouts\message-block'); ?>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Barang</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bahan</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ukuran</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Produksi</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                    </tr>
                                </thead>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($data->getResultArray() as $pro) : ?>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><?= $i++; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><?= $pro['nama_brg']; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><?= $pro['bahan']; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><?= $pro['ukuran']; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><?= $pro['jmlh_brg']; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><?php echo date('d F Y', strtotime($pro['tgl_pro'])); ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><?= $pro['status']; ?></h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="align-middle">
                                        <a role="button" class="btn btn-info" href="produksi/detail-produksi/<?= $pro['id_pro']; ?>"><i class="fas fa-truck"></i> Detail Proses</a>
                                        <a role="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteData<?= $pro['id_pro']; ?>"><i class="fas fa-trash"></i>
                                            Delete Data
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete Data -->
<?php foreach ($data->getResultArray() as $pro) : ?>
    <div class="modal fade" id="deleteData<?= $pro['id_pro'] ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Data Supplier</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form text-left" action="<?= base_url('produksi/destroy/' . $pro['id_pro']); ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <p>Apakah yakin menghapus data produksi <strong><?= $pro['nama_brg']; ?></strong> ?</p>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn bg-gradient-danger"> <i class="fas fa-trash"></i> Delete Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>