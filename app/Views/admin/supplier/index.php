<?= $this->extend('admin/layouts/index'); ?>

<?= $this->section('breadcrumbs'); ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/">Dashboard /</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Supplier</h6>
</nav>
<?= $this->endSection(); ?>

<?= $this->section('content-main'); ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row ">
                    <div class="col-md">
                        <h6><?= $title; ?></h6>
                        <?php if (in_groups('admin')) : ?>
                            <a role="button" id="createData" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#create-data"><i class="fas fa-edit"></i> Tambah Data</a>
                            <?= view('admin\layouts\message-block'); ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-md">
                        <form action="supplier" method="post">
                            <div class="input-group mb-3">
                                <input style="height: 45px;" type="text" class="form-control" placeholder="Masukkan keyword pencarian..." aria-label="Masukkan keyword pencarian..." name="keyword" aria-describedby="button-addon2" value="<?= $keyword; ?>">
                                <button type="submit" name="sumbit" class="btn btn-outline-secondary" type="button" id="button-addon2">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php $validation = \Config\Services::validation(); ?>
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
                                <?php if (in_groups('admin')) : ?>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 + (5 * ($currentPage - 1)); ?>
                            <?php
                            foreach ($supplier as $sup) :
                            ?>
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
                                    <?php if (in_groups('admin')) : ?>
                                        <td class="align-middle">
                                            <a role="button" class="btn btn-info" data-bs-target="#editData" data-bs-toggle="modal" data-id="<?= $sup->id_sup; ?>" data-nama="<?= $sup->nama_sup; ?>" data-alamat="<?= $sup->alamat_sup; ?>" data-hp="<?= $sup->no_hp; ?>"><i class="fas fa-edit"></i> Edit Data</a>
                                            <a role="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteData<?= $sup->id_sup; ?>"><i class="fas fa-trash"></i>
                                                Delete Data
                                            </a>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mx-3">
                <?= $pager->links('supplier', 'customPagination') ?>
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
                        <input type="text" name="nama_sup" id="nama_sup" class="form-control <?= (validation_show_error('nama_sup') != '') ? 'is-invalid' : ''; ?>" placeholder="Nama Supplier">
                        <div class="invalid-feedback">
                            <?= validation_show_error('nama_sup') ?>
                        </div>
                    </div>
                    <label>Alamat Supplier</label>
                    <div class="input-group mb-3">
                        <input type="text" name="alamat_sup" id="alamat_sup" class="form-control <?= (validation_show_error('alamat_sup') != '') ? 'is-invalid' : ''; ?>" placeholder="Alamat Supplier">
                        <div class="invalid-feedback">
                            <?= validation_show_error('alamat_sup') ?>
                        </div>
                    </div>
                    <label>No. Handphone</label>
                    <div class="input-group mb-3">
                        <input type="text" name="no_hp" id="no_hp" maxlength="12" class="form-control <?= (validation_show_error('no_hp') != '') ? 'is-invalid' : ''; ?>" placeholder="No.Handphone" pattern="^[0-9]*$">
                        <div class="invalid-feedback">
                            <?= validation_show_error('no_hp') ?>
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

<!-- Modal Edit Data -->
<?php foreach ($supplier as $sup) : ?>
    <div class="modal fade" id="editData" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Supplier</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formInput" role="form text-left" action="<?= base_url('supplier/update/' . $sup->id_sup); ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="PUT">
                        <label>Nama Supplier</label>
                        <div class="input-group mb-3">
                            <input type="text" name="nama_sup_edit" id="nama_sup" class="form-control <?= (validation_show_error('nama_sup_edit') != '') ? 'is-invalid' : ''; ?>" placeholder="Nama Supplier" required value="<?= old('nama_sup_edit', $sup->nama_sup); ?>">
                            <div class="invalid-feedback">
                                <?= validation_show_error('nama_sup_edit') ?>
                            </div>
                        </div>
                        <label>Alamat Supplier</label>
                        <div class="input-group mb-3">
                            <input type="text" name="alamat_sup_edit" id="alamat_sup" class="form-control <?= (validation_show_error('alamat_sup_edit') != '') ? 'is-invalid' : ''; ?>" placeholder="Alamat Supplier" required value="<?= old('alamat_sup_edit', $sup->alamat_sup); ?>">
                            <div class="invalid-feedback">
                                <?= validation_show_error('alamat_sup') ?>
                            </div>
                        </div>
                        <label>No. Handphone</label>
                        <div class="input-group mb-3">
                            <input type="text" name="no_hp_edit" id="no_hp" maxlength="12" class="form-control <?= (validation_show_error('no_hp_edit') != '') ? 'is-invalid' : ''; ?>" placeholder="No.Handphone" required pattern="^[0-9]*$" value="<?= old('no_hp_edit', $sup->no_hp); ?>">
                            <div class="invalid-feedback">
                                <?= validation_show_error('no_hp_edit') ?>
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

<?= $this->section('script'); ?>
<script>
    $('#editData').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var nama = button.data('nama')
        var alamat = button.data('alamat')
        var noHp = button.data('hp')
        var modal = $(this)
        modal.find('.modal-body #formInput').attr("action", "<?= base_url(); ?>/supplier/update/" + id)
        modal.find('.modal-body #nama_sup').val(nama)
        modal.find('.modal-body #alamat_sup').val(alamat)
        modal.find('.modal-body #no_hp').val(noHp)
    });
</script>
<?= $this->endSection(); ?>