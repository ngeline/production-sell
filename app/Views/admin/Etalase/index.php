<?= $this->extend('admin/layouts/index'); ?>

<?= $this->section('breadcrumbs'); ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/">Dashboard /</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Etalase</h6>
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
                        <form action="etalase" method="post">
                            <div class="input-group mb-3">
                                <input style="height: 45px;" type="text" class="form-control" placeholder="Masukkan keyword pencarian..." aria-label="Masukkan keyword pencarian..." name="keyword" aria-describedby="button-addon2">
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Barang</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stock Barang</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                    </tr>
                                </thead>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 + (5 * ($currentPage - 1)); ?>
                            <?php foreach ($etalase as $opn) : ?>
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
                                                <a href="javascript:;" data-bs-target="#modal-preview" data-bs-toggle="modal" data-id="<?= $opn['id_et']; ?>" data-img="<?= $opn['foto']; ?>">
                                                    <img src="/assets/img/storages/<?= $opn['foto']; ?>" alt="foto" width="100px">
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><?= $opn['nama_et']; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><?= $opn['jmlh_et']; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <a role="button" class="btn btn-warning clear" data-bs-target="#updateStok" data-bs-toggle="modal" data-id="<?= $opn['id_et']; ?>"><i class="fas fa-file-alt"></i> Update Stok</a>
                                        <a role="button" class="btn btn-info" data-bs-target="#detailOpname<?= $opn['id_et']; ?>" data-bs-toggle="modal"><i class="fas fa-edit"></i> Detail Opname</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mx-3">
                <?= $pager->links('etalase', 'customPagination') ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal Create Etalase -->
<div class="modal fade" id="create-data" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Stock Etalase</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form text-left" action="<?= base_url('etalase/store'); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <label>Barang Produksi</label>
                    <div class="input-group mb-3">
                        <select type="text" name="id_pro" class="form-control <?= (validation_show_error('id_pro') != '') ? 'is-invalid' : ''; ?>">
                            <option value="" selected disabled>-Pilih-</option>
                            <?php foreach ($produksi as $pro) : ?>
                                <option value="<?= $pro['id_pro']; ?>" data-stock="<?= $pro['jmlh_brg']; ?>"><?= $pro['nama_brg']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('id_pro') ?>
                        </div>
                    </div>
                    <label>Stok</label>
                    <div class="input-group mb-3">
                        <input type="text" name="jmlh_opn" class="form-control" placeholder="" readonly>
                    </div>
                    <div class="row mb-3">
                        <label for="foto">Foto</label>
                        <div class="col-sm-2">
                            <img src="/assets/img/storages/default-cloth.png" class="img-thumbnail img-preview" alt="gambar">
                        </div>
                        <div class="col-sm-10">
                            <input type="file" contenteditable="Pilih gambar" class="form-control <?= (validation_show_error('foto') != '') ? 'is-invalid' : ''; ?>" id="foto" name="foto" value="<?= old('foto'); ?>" onchange="previewImg()">
                            <div class="invalid-feedback">
                                <?= validation_show_error('foto') ?>
                            </div>
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

<!-- Modal Detail Opname -->
<div class="modal fade" id="updateStok" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Stok</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form text-left" id="formEdit" action="" method="post">
                    <?= csrf_field(); ?>
                    <label>Barang Produksi</label>
                    <div class="input-group mb-3">
                        <select type="text" name="id_pro" class="form-control <?= (validation_show_error('id_pro') != '') ? 'is-invalid' : ''; ?>">
                            <option value="" selected disabled>-Pilih-</option>
                            <?php foreach ($produksi as $pro) : ?>
                                <option value="<?= $pro['id_pro']; ?>" data-stock="<?= $pro['jmlh_brg']; ?>"><?= $pro['nama_brg']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('id_pro') ?>
                        </div>
                    </div>
                    <label>Stock</label>
                    <div class="input-group mb-3">
                        <input type="number" name="jmlh_opn" class="form-control" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-gradient-info"> <i class="fas fa-save"></i> Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal detail Data -->
<?php foreach ($etalase as $et) : ?>
    <div class="modal fade" id="detailOpname<?= $et['id_et']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Detail Data Etalase</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <label>Nama Barang</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="" readonly id="nm_brg" value="<?= $et['nama_et']; ?>">
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Stok</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Ukuran</label>
                                    </div>
                                    <div class="col-md">
                                        <label>Tanggal Input</label>
                                    </div>
                                </div>
                                <?php
                                $db      = \Config\Database::connect();
                                $builder = $db->table('etalase');
                                $data = $builder->select('etalase.jmlh_et as stok,p.ukuran,etalase.tgl_et')->join('produksi p', 'etalase.id_pro=p.id_pro')->where('etalase.nama_et', $et['nama_et'])->get();
                                ?>
                                <?php foreach ($data->getResultArray() as $row) : ?>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="" readonly id="stok_opn" value="<?= $row['stok']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="" readonly id="stok_opn" value="<?= $row['ukuran']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="" readonly id="tgl_input" value="<?= $row['tgl_et']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <label>Keterangan</label>
                        <div class="input-group mb-3">
                            <textarea type="text" class="form-control" readonly id="ket"><?= $et['ket_et']; ?></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

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
                <button type="button" id="btn-ganti-foto" data-bs-target="#ganti-foto" data-bs-toggle="modal" class="btn bg-gradient-primary" data-id="" data-img="">Ganti Foto</button>
                <button type="button" class="btn btn-link  ml-auto" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- ubah foto -->
<div class="modal fade" id="ganti-foto" tabindex="-1" role="dialog" aria-labelledby="ganti-foto" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">Ganti Foto</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form role="form text-left" action="<?= base_url('etalase/gantiFoto'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body text-center">
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" id="imgNameOld" name="imgNameOld">
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="">Sebelum</label>
                            <img src="" id="before" class="img-thumbnail" alt="gambar">
                        </div>
                        <div class="col-sm-6">
                            <label for="">Sesudah</label>
                            <img src="/assets/img/storages/default-cloth.png" class="img-thumbnail img-preview-ganti" alt="gambar">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <input type="file" contenteditable="Pilih gambar" class="form-control" id="fotoGanti" name="foto" onchange="previewImgChange()">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-gradient-primary">Simpan Perubahan</button>
                    <button type="button" class="btn btn-link  ml-auto" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('css-internal'); ?>
<style>
    #foto::before {
        content: "Pilih gambar";
        position: absolute;
        z-index: 2;
        display: block;
        background-color: #ffffff;
        width: 80px;
    }

    #fotoGanti::before {
        content: "Pilih gambar";
        position: absolute;
        z-index: 2;
        display: block;
        background-color: #ffffff;
        width: 80px;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $("[name='id_pro']").on('change', function() {
        let selectedI = this.selectedIndex;
        $("[name='jmlh_opn']").val(this.options[selectedI].dataset.stock)
    });
    $(".clear").on('click', function() {
        $("[name='jmlh_opn']").val("")
    })
    $('#updateStok').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var modal = $(this)
        modal.find('.modal-body #formEdit').attr("action", "<?= base_url(); ?>/etalase/update/" + id)
    });

    $('#modal-preview').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var img = button.data('img')
        var modal = $(this)
        modal.find('.modal-body img').attr("src", "/assets/img/storages/" + img)
        modal.find('.modal-footer #btn-ganti-foto').attr("data-id", id)
        modal.find('.modal-footer #btn-ganti-foto').attr("data-img", img)
    });

    $('#ganti-foto').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var img = button.data('img')
        var modal = $(this)
        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #before').attr("src", "/assets/img/storages/" + img)
        modal.find('.modal-body #imgNameOld').val(img)
    });

    function previewImg() {
        const foto = document.querySelector('#foto');
        const imgPreview = document.querySelector('.img-preview');

        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);

        fileFoto.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }

    function previewImgChange() {
        const foto = document.querySelector('#fotoGanti');
        const imgPreview = document.querySelector('.img-preview-ganti');

        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);

        fileFoto.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>
<?= $this->endSection(); ?>