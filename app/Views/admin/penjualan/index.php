<?= $this->extend('admin/layouts/index'); ?>

<?= $this->section('content-main'); ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6><?= $title; ?></h6>
                <a role="button" class="btn btn-info w-14" data-bs-toggle="modal" data-bs-target="#create-data"><i class="fas fa-file-alt"></i> Tambah Data Penjualan</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <?= view('admin\layouts\message-block'); ?>
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Marketplace</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Input</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Barang</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Banyaknya</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Penjualan</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                    </tr>
                                </thead>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            ?>
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm"><?= $no++; ?></h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">Shopee COD</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">10/12/2040</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">Angkasa XL</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">20 Bijiler</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">Rp.150.000.000</h6>
                                        </div>
                                    </div>
                                </td>

                                <td class="align-middle">
                                    <a role="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editData"><i class="fas fa-file-alt"></i> Edit Data</a>
                                    <a role="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteData"><i class="fas fa-trash"></i> Delete Data</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="create-data" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Penjualan</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form text-left" action="<?= base_url(''); ?>" method="post">
                    <?= csrf_field(); ?>
                    <label>Marketplace</label>
                    <div class="input-group mb-3">
                        <input type="text" name="marketplace" id="marketplace" class="form-control" placeholder="Marketplace Penjualan">
                    </div>
                    <label>Tanggal Input</label>
                    <div class="input-group mb-3">
                        <input type="date" name="tgl_input" id="tgl_input" class="form-control" placeholder="Tanggal Input Barang">
                    </div>
                    <label>Nama Barang</label>
                    <div class="input-group mb-3">
                        <input type="text" name="nama_barang" id="nama_barang" class="form-control" placeholder="Nama Barang">
                    </div>
                    <label>Banyaknya</label>
                    <div class="input-group mb-3">
                        <input type="number" name="banyak" id="banyak" class="form-control" placeholder="Banyaknya">
                    </div>
                    <label>Total Penjualan</label>
                    <div class="input-group mb-3">
                        <input type="number" name="total_penj" id="total_penj" class="form-control" placeholder="Total Penjualan">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-gradient-info"> <i class="fas fa-save"></i> Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Data -->
<div class="modal fade" id="editData" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Penjualan</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form text-left" action="<?= base_url(''); ?>" method="post">
                    <?= csrf_field(); ?>
                    <label>Marketplace</label>
                    <div class="input-group mb-3">
                        <input type="text" name="marketplace" id="marketplace" class="form-control" placeholder="Marketplace Penjualan">
                    </div>
                    <label>Tanggal Input</label>
                    <div class="input-group mb-3">
                        <input type="date" name="tgl_input" id="tgl_input" class="form-control" placeholder="Tanggal Input Barang">
                    </div>
                    <label>Nama Barang</label>
                    <div class="input-group mb-3">
                        <input type="text" name="nama_barang" id="nama_barang" class="form-control" placeholder="Nama Barang">
                    </div>
                    <label>Banyaknya</label>
                    <div class="input-group mb-3">
                        <input type="number" name="banyak" id="banyak" class="form-control" placeholder="Banyaknya">
                    </div>
                    <label>Total Penjualan</label>
                    <div class="input-group mb-3">
                        <input type="number" name="total_penj" id="total_penj" class="form-control" placeholder="Total Penjualan">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-gradient-info"> <i class="fas fa-save"></i> Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete Data -->
<div class="modal fade" id="deleteData" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Delete Data Penjualan</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form text-left" action="<?= base_url(''); ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <p>Apakah yakin untuk hapus data penjualan <strong></strong>Nama Barang?</p>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-danger"> <i class="fas fa-trash"></i> Delete Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>