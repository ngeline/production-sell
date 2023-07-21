<?= $this->extend('admin/layouts/index'); ?>

<?= $this->section('breadcrumbs'); ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/">Dashboard /</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Opname</h6>
</nav>
<?= $this->endSection(); ?>

<?= $this->section('content-main'); ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-md">
                        <h6><?= $title; ?></h6>
                        <a role="button" id="createData" class="btn btn-info clear" data-bs-toggle="modal" data-bs-target="#create-data"><i class="fas fa-edit"></i> Tambah Data</a>
                    </div>
                    <div class="col-md">
                        <form action="opname" method="post">
                            <div class="input-group mb-3">
                                <input style="height: 45px;" type="text" class="form-control" placeholder="Masukkan keyword pencarian..." aria-label="Masukkan keyword pencarian..." name="keyword" aria-describedby="button-addon2" value="<?= $keyword; ?>">
                                <button type="submit" name="sumbit" class="btn btn-outline-secondary" type="button" id="button-addon2">Cari</button>
                            </div>
                        </form>
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Foto</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keterangan</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                    </tr>
                                </thead>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 + (5 * ($currentPage - 1)); ?>
                            <?php foreach ($opname as $opn) : ?>
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
                                                <?php
                                                $db      = \Config\Database::connect();
                                                $builder = $db->table('etalase');
                                                $data = $builder->select('foto')->join('opname o', 'etalase.id_et=o.id_et')->Where('etalase.id_et', $opn['id_et'])->get();
                                                ?>
                                                <?php foreach ($data->getResultArray() as $et) : ?>
                                                    <a href="javascript:;" data-bs-target="#modal-preview" data-bs-toggle="modal" data-img="<?= $et['foto']; ?>">
                                                        <img src="/assets/img/storages/<?= $et['foto']; ?>" alt="foto" width="100px">
                                                    </a>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><?= $opn['nama_opn']; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><?= $opn['jmlh_opn']; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><?= $opn['ket_opn']; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <a role="button" class="btn btn-warning clear" data-bs-target="#updateStok" data-bs-toggle="modal" data-id="<?= $opn['id_opn']; ?>" data-nama="<?= $opn['nama_opn']; ?>" data-jmlh="<?= $opn['jmlh_opn']; ?>" data-ket="<?= $opn['ket_opn']; ?>"><i class="fas fa-file-alt"></i> Edit Data</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mx-3">
                <?= $pager->links('opname', 'customPagination') ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal Create Etalase -->
<div class="modal fade" id="create-data" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Opname</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form text-left" action="<?= base_url('opname/store'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <label>Barang Produksi</label>
                    <div class="input-group mb-3">
                        <select type="text" name="id_et" class="form-control <?= (validation_show_error('id_et') != '') ? 'is-invalid' : ''; ?>">
                            <option value="" selected disabled>-Pilih-</option>
                            <?php foreach ($etalase as $et) : ?>
                                <option value="<?= $et['id_et']; ?>"><?= $et['nama_et']; ?> - Ukuran [<?= $et['ukuran']; ?>]</option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('id_et') ?>
                        </div>
                    </div>
                    <label>Jumlah</label>
                    <div class="input-group mb-3">
                        <input type="text" name="jmlh_opn" class="form-control <?= (validation_show_error('jmlh_opn') != '') ? 'is-invalid' : ''; ?>" placeholder="">
                        <div class="invalid-feedback">
                            <?= validation_show_error('jmlh_opn') ?>
                        </div>
                    </div>
                    <label>Keterangan</label>
                    <div class="input-group mb-3">
                        <textarea type="text" name="ket" class="form-control" placeholder="Keterangan"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-gradient-info"> <i class="fas fa-save"></i> Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateStok" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form text-left" id="formEdit" action="" method="post">
                    <?= csrf_field(); ?>
                    <label>Barang Produksi</label>
                    <div class="input-group mb-3">
                        <input type="text" name="nama" class="form-control" readonly>
                    </div>
                    <label>Jumlah</label>
                    <div class="input-group mb-3">
                        <input type="text" name="jmlh_opn" class="form-control <?= (validation_show_error('jmlh_opn') != '') ? 'is-invalid' : ''; ?>" placeholder="">
                        <div class="invalid-feedback">
                            <?= validation_show_error('jmlh_opn') ?>
                        </div>
                    </div>
                    <label>Keterangan</label>
                    <div class="input-group mb-3">
                        <textarea type="text" name="ket" class="form-control" placeholder="Keterangan"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-gradient-info"> <i class="fas fa-save"></i> Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal preview foto -->
<div class="modal fade" id="modal-preview" tabindex="-1" role="dialog" aria-labelledby="modal-preview" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">Preview Foto</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="" alt="foto" width="450px">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link  ml-auto" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $('#updateStok').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var nama = button.data('nama')
        var jmlh = button.data('jmlh')
        var ket = button.data('ket')
        var modal = $(this)
        modal.find('.modal-body #formEdit').attr("action", "<?= base_url(); ?>/opname/update/" + id)
        modal.find(".modal-body [name='nama']").val(nama)
        modal.find(".modal-body [name='jmlh_opn']").val(jmlh)
        modal.find(".modal-body [name='ket']").html(ket)
    });

    $('#modal-preview').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var img = button.data('img')
        var modal = $(this)
        modal.find('.modal-body img').attr("src", "/assets/img/storages/" + img)
    });
</script>
<?= $this->endSection(); ?>