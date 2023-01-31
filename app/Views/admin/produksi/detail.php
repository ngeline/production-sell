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
                    <input type="text" class="form-control" readonly value="Ciki tahu">
                </div>

                <div class="form-group">
                    <label for="disabledInput">Bahan</label>
                    <input type="text" class="form-control" readonly value="Smoke Beef">
                </div>

                <div class="form-group">
                    <label for="disabledInput">Ukuran</label>
                    <input type="text" class="form-control" readonly value="XL XL PIW">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="disabledInput">Harga</label>
                    <input type="text" class="form-control" readonly value="Rp.500.000.0000.0000">
                </div>
                <div class="form-group">
                    <label for="disabledInput">Jumlah</label>
                    <input type="text" class="form-control" readonly value="10 Saja">
                </div>

                <div class="form-group">
                    <label for="disabledInput">Keterangan</label>
                    <input type="text" class="form-control" readonly value="Enak">
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
                <div class="card card-stepper text-black" style="border-radius: 16px;">
                    <div class="card-body p-5">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <div>
                                <h5 class="mb-0"><?= $title; ?> <span class="text-info font-weight-bold">#Barang</span></h5>
                            </div>
                        </div>
                        <ul id="progressbar-2" class="d-flex justify-content-between mx-0 mt-0 mb-5 px-0 pt-0 pb-2">
                            <li class="step0 active text-center" id="step1"></li>
                            <li class="step0 active text-center" id="step2"></li>
                            <li class="step0 active text-center" id="step3"></li>
                            <li class="step0 text-muted text-end" id="step4"></li>
                        </ul>
                        <div class="d-flex justify-content-between">
                            <div class="d-lg-flex align-items-center">
                                <i class="fas fa-clipboard-list fa-3x me-lg-4 mb-3 mb-lg-0"></i>
                                <div>
                                    <p class="fw-bold mb-1">Order</p>
                                    <p class="fw-bold mb-0">Processed</p>
                                </div>
                            </div>
                            <div class="d-lg-flex align-items-center">
                                <i class="fas fa-box-open fa-3x me-lg-4 mb-3 mb-lg-0"></i>
                                <div>
                                    <p class="fw-bold mb-1">Order</p>
                                    <p class="fw-bold mb-0">Shipped</p>
                                </div>
                            </div>
                            <div class="d-lg-flex align-items-center">
                                <i class="fas fa-shipping-fast fa-3x me-lg-4 mb-3 mb-lg-0"></i>
                                <div>
                                    <p class="fw-bold mb-1">Order</p>
                                    <p class="fw-bold mb-0">En Route</p>
                                </div>
                            </div>
                            <div class="d-lg-flex align-items-center">
                                <i class="fas fa-home fa-3x me-lg-4 mb-3 mb-lg-0"></i>
                                <div>
                                    <p class="fw-bold mb-1">Order</p>
                                    <p class="fw-bold mb-0">Arrived</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <a role="button" id="createData" class="btn btn-info w-15" data-bs-toggle="modal" data-bs-target="#updateProses"><i class="fas fa-edit"></i> Update Proses</a>
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
    .card-stepper {
        z-index: 0
    }

    #progressbar-2 {
        color: #455A64;
    }

    #progressbar-2 li {
        list-style-type: none;
        font-size: 13px;
        width: 33.33%;
        float: left;
        position: relative;
    }

    #progressbar-2 #step1:before {
        content: '\f058';
        font-family: "Font Awesome 5 Free";
        color: #fff;
        width: 37px;
        margin-left: 0px;
        padding-left: 0px;
    }

    #progressbar-2 #step2:before {
        content: '\f058';
        font-family: "Font Awesome 5 Free";
        color: #fff;
        width: 37px;
    }

    #progressbar-2 #step3:before {
        content: '\f058';
        font-family: "Font Awesome 5 Free";
        color: #fff;
        width: 37px;
        margin-right: 0;
        text-align: center;
    }

    #progressbar-2 #step4:before {
        content: '\f111';
        font-family: "Font Awesome 5 Free";
        color: #fff;
        width: 37px;
        margin-right: 0;
        text-align: center;
    }

    #progressbar-2 li:before {
        line-height: 37px;
        display: block;
        font-size: 12px;
        background: #c5cae9;
        border-radius: 50%;
    }

    #progressbar-2 li:after {
        content: '';
        width: 100%;
        height: 10px;
        background: #c5cae9;
        position: absolute;
        left: 0%;
        right: 0%;
        top: 15px;
        z-index: -1;
    }

    #progressbar-2 li:nth-child(1):after {
        left: 1%;
        width: 100%
    }

    #progressbar-2 li:nth-child(2):after {
        left: 1%;
        width: 100%;
    }

    #progressbar-2 li:nth-child(3):after {
        left: 1%;
        width: 100%;
        background: #c5cae9 !important;
    }

    #progressbar-2 li:nth-child(4) {
        left: 0;
        width: 37px;
    }

    #progressbar-2 li:nth-child(4):after {
        left: 0;
        width: 0;
    }

    #progressbar-2 li.active:before,
    #progressbar-2 li.active:after {
        background: #6520ff;
    }
</style>

<?= $this->endSection(); ?>