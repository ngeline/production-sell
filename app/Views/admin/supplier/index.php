<?= $this->extend('admin/layouts/index'); ?>\
<?= $this->section('content-main'); ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Data Supplier</h6>
                <a role="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#create-data"><i class="fas fa-edit"></i> Tambah Data</a>
                <?= view('admin\layouts\message-block'); ?>
            </div>
            <div class="card-body px-0 pt-0 pb-2">

                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Supplier</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat Supplier</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.Handphone</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            ?>
                            <?php
                            foreach ($supplier as $sup) :
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
                                                <h6 class="mb-0 text-sm"><?= $sup->nama_sup; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><?= $sup->alamat_sup; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><?= $sup->no_hp; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <a role="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editData<?= $sup->id_sup; ?>"><i class="fas fa-edit"></i> Edit Data</a>
                                        <a role="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteData<?= $sup->id_sup; ?>"><i class="fas fa-trash"></i>
                                            Delete Data
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Create Supplier -->
<div class="modal fade" id="create-data" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Supplier</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form text-left" action="<?= base_url('supplier/store'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <label>Nama Supplier</label>
                    <div class="input-group mb-3">
                        <input type="text" name="nama_sup" id="nama_sup" class="form-control" placeholder="Nama Supplier" required>
                    </div>
                    <label>Alamat Supplier</label>
                    <div class="input-group mb-3">
                        <input type="text" name="alamat_sup" id="alamat_sup" class="form-control" placeholder="Alamat Supplier" required>
                    </div>
                    <label>No. Handphone</label>
                    <div class="input-group mb-3">
                        <input type="text" name="no_hp" id="no_hp" maxlength="12" class="form-control" placeholder="No.Handphone" required pattern="^[0-9]*$">
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
<?php foreach ($supplier as $sup) : ?>
    <div class="modal fade" id="editData<?= $sup->id_sup; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Supplier</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form text-left" action="<?= base_url('supplier/update/' . $sup->id_sup); ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="PUT">
                        <label>Nama Supplier</label>
                        <div class="input-group mb-3">
                            <input type="text" name="nama_sup" id="nama_sup" class="form-control" placeholder="Nama Supplier" required value="<?= $sup->nama_sup; ?>">
                        </div>
                        <label>Alamat Supplier</label>
                        <div class="input-group mb-3">
                            <input type="text" name="alamat_sup" id="alamat_sup" class="form-control" placeholder="Alamat Supplier" required value="<?= $sup->alamat_sup; ?>">
                        </div>
                        <label>No. Handphone</label>
                        <div class="input-group mb-3">
                            <input type="text" name="no_hp" id="no_hp" maxlength="12" class="form-control" placeholder="No.Handphone" required pattern="^[0-9]*$" value="<?= $sup->no_hp; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn bg-gradient-info"> <i class="fas fa-save"></i> Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<!-- Modal Delete Data -->
<?php foreach ($supplier as $sup) : ?>
    <div class="modal fade" id="deleteData<?= $sup->id_sup; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Data Supplier</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form text-left" action="<?= base_url('supplier/destroy/' . $sup->id_sup); ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <p>Apakah yakin menghapus data supplier <strong><?= $sup->nama_sup; ?></strong> ?</p>
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