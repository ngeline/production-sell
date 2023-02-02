<?= $this->extend('admin/layouts/index'); ?>

<?= $this->section('content-main'); ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row ">
                    <div class="col-md">
                        <h6><?= $title; ?></h6>
                        <a role="button" id="createData" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#create-data"><i class="fas fa-edit"></i> Tambah Data</a>
                        <?= view('admin\layouts\message-block'); ?>
                    </div>
                    <div class="col-md">
                        <form action="produksi" method="post">
                            <div class="input-group mb-3">
                                <input style="height: 45px;" type="text" class="form-control" placeholder="Masukkan keyword pencarian..." aria-label="Masukkan keyword pencarian..." name="keyword" aria-describedby="button-addon2" value="<?= $keyword; ?>">
                                <button type="submit" name="sumbit" class="btn btn-outline-secondary" type="button" id="button-addon2">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                    </tr>
                                </thead>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 + (5 * ($currentPage - 1)); ?>
                            <?php foreach ($produksi as $pro) : ?>
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
            <div class="mx-3">
                <?= $pager->links('produksi', 'customPagination') ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal Create Produksi -->
<div class="modal fade" id="create-data" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data produksi</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form text-left" action="produksi/store" method="post">
                    <?= csrf_field(); ?>
                    <label>Nama barang</label>
                    <div class="input-group mb-3">
                        <input type="text" name="nama_brg" id="nama_brg" class="form-control <?= (validation_show_error('nama_brg') != '') ? 'is-invalid' : ''; ?>" placeholder="Masukkan nama barang">
                        <div class="invalid-feedback">
                            <?= validation_show_error('nama_brg') ?>
                        </div>
                    </div>
                    <label>Bahan</label>
                    <div class="input-group mb-3">
                        <select type="text" name="bahan" id="bahan" class="form-control <?= (validation_show_error('bahan') != '') ? 'is-invalid' : ''; ?>">
                            <option value="" selected disabled>-Pilih-</option>
                            <option value="Cotton Combed">Cotton Combed</option>
                            <option value="Cotton Carded">Cotton Carded</option>
                            <option value="Polyester">Polyester</option>
                            <option value="Teteron Cotton">Teteron Cotton</option>
                            <option value="Cotton Modal">Cotton Modal</option>
                            <option value="Cotton Bamboo">Cotton Bamboo</option>
                            <option value="Cotton Supima">Cotton Supima</option>
                            <option value="Cotton Tri-blend">Cotton Tri-blend</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('bahan') ?>
                        </div>
                    </div>
                    <label>Ukuran</label>
                    <div class="input-group mb-3">
                        <select type="text" name="ukuran" id="ukuran" maxlength="12" class="form-control <?= (validation_show_error('ukuran') != '') ? 'is-invalid' : ''; ?>">
                            <option value="" selected disabled>-Pilih-</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                            <option value="XXXL">XXXL</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('ukuran') ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label>Jumlah Barang</label>
                            <div class="input-group mb-3">
                                <input type="number" name="jmlh_brg" id="jmlh_brg" maxlength="12" class="form-control <?= (validation_show_error('jmlh_brg') != '') ? 'is-invalid' : ''; ?>" placeholder="Masukkan jumlah produksi" pattern="^[0-9]*$">
                                <div class="invalid-feedback">
                                    <?= validation_show_error('jmlh_brg') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">
                            <label>Harga</label>
                            <div class="input-group mb-3">
                                <input type="text" name="harga" id="harga" maxlength="12" class="form-control <?= (validation_show_error('harga') != '') ? 'is-invalid' : ''; ?>" placeholder="Masukkan nominal harga" pattern="^[0-9]*$">
                                <div class="invalid-feedback">
                                    <?= validation_show_error('harga') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <label>Tanggal Produksi</label>
                    <div class="input-group mb-3">
                        <input type="date" name="tgl_pro" id="tgl_pro" class="form-control <?= (validation_show_error('tgl_pro') != '') ? 'is-invalid' : ''; ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('tgl_pro') ?>
                        </div>
                    </div>
                    <label>Keterangan</label>
                    <div class="input-group mb-3">
                        <textarea type="text" name="ket" id="ket" class="form-control <?= (validation_show_error('ket') != '') ? 'is-invalid' : ''; ?>" placeholder="Masukkan keterangan"></textarea>
                        <div class="invalid-feedback">
                            <?= validation_show_error('ket') ?>
                        </div>
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
<?php foreach ($produksi as $pro) : ?>
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

<?= $this->endSection(); ?>