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


<div class="card">
    <div class="card-header">
        <h4 class="card-title">Progress Produksi</h4>
        <span class="text-info font-weight-bold">#WQ1231232</span>
    </div>
    <div class="card-body">
        <!-- Add class "active" to progress -->
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <ul id="progressbar" class="text-center">
                    <li class="active step0"></li>
                    <li class="active step0"></li>
                    <li class="step0"></li>
                    <li class="step0"></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('css-internal'); ?>
<style>
    /* Icon progressbar */

    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        color: #455a64;
        padding-left: 0;
        margin-top: 30px;
    }
</style>

<?= $this->endSection(); ?>