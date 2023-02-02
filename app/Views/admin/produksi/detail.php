<?= $this->extend('admin/layouts/index'); ?>

<?= $this->section('content-main'); ?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title"><?= $title; ?></h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="disabledInput">Nama Barang</label>
                    <input type="text" class="form-control" readonly value="<?= $pro['nama_brg']; ?>">
                </div>

                <div class="form-group">
                    <label for="disabledInput">Bahan</label>
                    <input type="text" class="form-control" readonly value="<?= $pro['bahan']; ?>">
                </div>

                <div class="form-group">
                    <label for="disabledInput">Ukuran</label>
                    <input type="text" class="form-control" readonly value="<?= $pro['ukuran']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="disabledInput">Harga</label>
                    <input type="text" class="form-control" readonly value="<?= $pro['harga']; ?>">
                </div>
                <div class="form-group">
                    <label for="disabledInput">Jumlah</label>
                    <input type="text" class="form-control" readonly value="<?= $pro['jmlh_brg']; ?>">
                </div>

                <div class="form-group">
                    <label for="disabledInput">Keterangan</label>
                    <textarea type="text" class="form-control" readonly><?= $pro['ket']; ?></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

<!-- Progress bar -->

<div class="card">
    <div class="card-body">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card card-stepper" style="border-radius: 10px;">
                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column">
                                <span class="lead fw-normal"><?= $title; ?></span>
                                <span class="text-muted small">#namaBarang</span>
                            </div>
                            <div>
                                <a role="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#updateProses"><i class="fas fa-edit"></i> Update Proses</a>
                            </div>
                        </div>
                        <hr class="my-4">

                        <div class="d-flex flex-row justify-content-between align-items-center align-content-center">
                            <span class="dot"></span>
                            <hr class="flex-fill track-line"><span class="dot"></span>
                            <hr class="flex-fill track-line"><span class="d-flex justify-content-center align-items-center big-dot dot">
                                <i class="fa fa-check text-white"></i></span>

                        </div>

                        <div class="d-flex flex-row justify-content-between align-items-center">
                            <div class="d-flex flex-column align-items-start"><span>Design</span>
                            </div>
                            <div class="d-flex flex-column justify-content-center"><span>Sablon</span></div>
                            <div class="d-flex flex-column justify-content-center align-items-center"><span>Selesai</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete Data -->
<div class="modal fade" id="updateProses" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Proses Produksi</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form text-left" action="<?= base_url(''); ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <p>Apakah yakin untuk update proses <strong></strong>Nama Barang?</p>
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

<?= $this->section('css-internal'); ?>
<style>
    .track-line {
        height: 2px !important;
        background-color: #488978;
        opacity: 1;
    }

    .dot {
        height: 10px;
        width: 10px;
        margin-left: 3px;
        margin-right: 3px;
        margin-top: 0px;
        background-color: #488978;
        border-radius: 50%;
        display: inline-block
    }

    .big-dot {
        height: 25px;
        width: 25px;
        margin-left: 0px;
        margin-right: 0px;
        margin-top: 0px;
        background-color: #488978;
        border-radius: 50%;
        display: inline-block;
    }

    .big-dot i {
        font-size: 12px;
    }

    .card-stepper {
        z-index: 0
    }
</style>

<?= $this->endSection(); ?>