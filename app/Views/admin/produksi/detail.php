<?= $this->extend('admin/layouts/index'); ?>

<?= $this->section('breadcrumbs'); ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="<?= base_url('/'); ?>">Dashboard</a></li>
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="<?= base_url('produksi'); ?>">Produksi</a></li>
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="<?= base_url('produksi/detail-produksi/' . $pro['id_pro']); ?>">Detail /</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0"><?= $pro['nama_brg']; ?></h6>
</nav>
<?= $this->endSection(); ?>

<?= $this->section('content-main'); ?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title"><?= $title; ?></h4>
        <?= view('admin\layouts\message-block'); ?>
    </div>
    <div class="card-body">
        <form action="<?= base_url('produksi/update/' . $pro['id_pro']); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="disabledInput">Nama Barang</label>
                        <input type="text" id="nama_brg" class="form-control <?= (validation_show_error('nama_brg') != '') ? 'is-invalid' : ''; ?>" disabled value="<?= $pro['nama_brg']; ?>" name="nama_brg">
                        <div class="invalid-feedback">
                            <?= validation_show_error('nama_brg') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="disabledInput">Bahan</label>
                        <select type="text" id="bahan" class="form-control <?= (validation_show_error('bahan') != '') ? 'is-invalid' : ''; ?>" disabled name="bahan">
                            <option value="" selected disabled>-Pilih-</option>
                            <option value="Cotton Combed" <?= $pro['bahan'] == 'Cotton Combed' ? 'selected' : ''; ?>>Cotton Combed</option>
                            <option value="Cotton Carded" <?= $pro['bahan'] == 'Cotton Carded' ? 'selected' : ''; ?>>Cotton Carded</option>
                            <option value="Polyester" <?= $pro['bahan'] == 'Polyester' ? 'selected' : ''; ?>>Polyester</option>
                            <option value="Teteron Cotton" <?= $pro['bahan'] == 'Teteron Cotton' ? 'selected' : ''; ?>>Teteron Cotton</option>
                            <option value="Cotton Modal" <?= $pro['bahan'] == 'Cotton Modal' ? 'selected' : ''; ?>>Cotton Modal</option>
                            <option value="Cotton Bamboo" <?= $pro['bahan'] == 'Cotton Bamboo' ? 'selected' : ''; ?>>Cotton Bamboo</option>
                            <option value="Cotton Supima" <?= $pro['bahan'] == 'Cotton Supima' ? 'selected' : ''; ?>>Cotton Supima</option>
                            <option value="Cotton Tri-blend" <?= $pro['bahan'] == 'Cotton Tri-blend' ? 'selected' : ''; ?>>Cotton Tri-blend</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('bahan') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="disabledInput">Ukuran</label>
                        <select type="text" id="ukuran" class="form-control <?= (validation_show_error('ukuran') != '') ? 'is-invalid' : ''; ?>" disabled name="ukuran">
                            <option value="" selected disabled>-Pilih-</option>
                            <option value="S" <?= $pro['ukuran'] == 'S' ? 'selected' : ''; ?>>S</option>
                            <option value="M" <?= $pro['ukuran'] == 'M' ? 'selected' : ''; ?>>M</option>
                            <option value="L" <?= $pro['ukuran'] == 'L' ? 'selected' : ''; ?>>L</option>
                            <option value="XL" <?= $pro['ukuran'] == 'XL' ? 'selected' : ''; ?>>XL</option>
                            <option value="XXL" <?= $pro['ukuran'] == 'XXL' ? 'selected' : ''; ?>>XXL</option>
                            <option value="XXXL" <?= $pro['ukuran'] == 'XXXL' ? 'selected' : ''; ?>>XXXL</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('ukuran') ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="disabledInput">Harga</label>
                        <input type="text" id="harga" class="form-control <?= (validation_show_error('harga') != '') ? 'is-invalid' : ''; ?>" disabled value="<?= number_format($pro['harga']); ?>" name="harga">
                        <div class="invalid-feedback">
                            <?= validation_show_error('harga') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="disabledInput">Jumlah</label>
                        <input type="text" id="jmlh_brg" class="form-control <?= (validation_show_error('jmlh_brg') != '') ? 'is-invalid' : ''; ?>" disabled value="<?= $pro['jmlh_brg']; ?>" name="jmlh_brg">
                        <div class="invalid-feedback">
                            <?= validation_show_error('jmlh_brg') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="disabledInput">Keterangan</label>
                        <textarea type="text" id="ket" class="form-control <?= (validation_show_error('ket') != '') ? 'is-invalid' : ''; ?>" disabled name="ket"><?= $pro['ket']; ?></textarea>
                        <div class="invalid-feedback">
                            <?= validation_show_error('ket') ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="float-end">
                <a type="btn" id="submitEdit" class="btn btn-info <?= !empty($pro['proses2']) ? "disabled" : ""; ?>">Ubah</a>
                <button type="submit" id="submitUpdate" class="btn btn-primary" hidden>Save</button>
            </div>
        </form>
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
                            <span class="dot <?= $pro['proses1'] != "" ? 'd-flex justify-content-center align-items-center big-dot' : ''; ?>"><?= $pro['proses1'] != "" ? '<i class="fa fa-check text-white"></i>' : ''; ?></span>
                            <hr class="flex-fill <?= $pro['proses2'] != "" ? 'track-line-active' : 'track-line'; ?>"><span class="dot <?= $pro['proses2'] != "" ? 'd-flex justify-content-center align-items-center big-dot' : ''; ?>"><?= $pro['proses2'] != "" ? '<i class="fa fa-check text-white"></i>' : ''; ?></span>
                            <hr class="flex-fill <?= $pro['proses3'] != "" ? 'track-line-active' : 'track-line'; ?>"><span class="dot <?= $pro['proses3'] != "" ? 'd-flex justify-content-center align-items-center big-dot' : ''; ?>"><?= $pro['proses3'] != "" ? '<i class="fa fa-check text-white"></i>' : ''; ?></span>

                        </div>

                        <div class="d-flex flex-row justify-content-between align-items-center">
                            <div class="d-flex flex-column align-items-start">
                                <span><?= $pro['proses1'] != "" ? '<b>Design</b>' : 'Design'; ?></span>
                                <span style="font-size: 12px;"><?= $pro['proses1'] != "" ? date('d/m/Y', strtotime($pro['proses1'])) : ''; ?></span>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <span><?= $pro['proses2'] != "" ? '<b>Sablon</b>' : 'Sablon'; ?></span>
                                <span style="font-size: 12px;"><?= $pro['proses2'] != "" ? date('d/m/Y', strtotime($pro['proses2'])) : ''; ?></span>
                            </div>
                            <div class="d-flex flex-column justify-content-center align-items-center">
                                <span><?= $pro['proses3'] != "" ? '<b>Selesai</b>' : 'Selesai'; ?></span>
                                <span style="font-size: 12px;"><?= $pro['proses3'] != "" ? date('d/m/Y', strtotime($pro['proses3'])) : ''; ?></span>
                            </div>
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
                <form role="form text-left" action="<?= base_url('produksi/updateProses/' . $pro['id_pro']); ?>" method="post">
                    <?= csrf_field(); ?>
                    <p>Klik tombol untuk mengupdate proses produksi.</p>
                    <div class="d-flex justify-content-center align-items-center align-content-center">
                        <button type="submit" class="btn m-2 <?= $pro['proses1'] != "" ? 'disabled btn-secondary' : 'btn-info'; ?>" style="height: 100px;" name="proses1" value="<?= date('Y-m-d H:i:s'); ?>">Design</button>
                        <button type="submit" class="btn m-2 <?= $pro['proses1'] == "" ? 'disabled' : ''; ?> <?= $pro['proses2'] != "" ? 'disabled btn-secondary' : 'btn-warning'; ?>" style="height: 100px;" name="proses2" value="<?= date('Y-m-d H:i:s'); ?>">Sablon</button>
                        <button type="submit" class="btn m-2 <?= $pro['proses2'] == "" ? 'disabled' : ''; ?> <?= $pro['proses3'] != "" ? 'disabled btn-secondary' : 'btn-success'; ?>" style="height: 100px;" name="proses3" value="<?= date('Y-m-d H:i:s'); ?>">Selesai</button>
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
        background-color: #c0c0c0;
        opacity: 1;
    }

    .track-line-active {
        height: 2px !important;
        background-color: #0080ff;
        opacity: 1;
    }

    .dot {
        height: 10px;
        width: 10px;
        margin-left: 3px;
        margin-right: 3px;
        margin-top: 0px;
        background-color: #c0c0c0;
        border-radius: 50%;
        display: inline-block
    }

    .big-dot {
        height: 25px;
        width: 25px;
        margin-left: 0px;
        margin-right: 0px;
        margin-top: 0px;
        background-color: #0080ff;
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

<?= $this->section('script'); ?>
<script>
    $('#submitEdit').on('click', function() {
        $(this).parent().toggleClass("editAvailable");
        if ($(this).parent().hasClass("editAvailable")) {
            document.getElementById("nama_brg").removeAttribute("disabled")
            document.getElementById("bahan").removeAttribute("disabled")
            document.getElementById("ukuran").removeAttribute("disabled")
            document.getElementById("harga").removeAttribute("disabled")
            document.getElementById("jmlh_brg").removeAttribute("disabled")
            document.getElementById("ket").removeAttribute("disabled")
            document.getElementById("submitUpdate").removeAttribute("hidden")
        } else {
            document.getElementById("nama_brg").setAttribute("disabled", "")
            document.getElementById("bahan").setAttribute("disabled", "")
            document.getElementById("ukuran").setAttribute("disabled", "")
            document.getElementById("harga").setAttribute("disabled", "")
            document.getElementById("jmlh_brg").setAttribute("disabled", "")
            document.getElementById("ket").setAttribute("disabled", "")
            document.getElementById("submitUpdate").setAttribute("hidden", "")
        }
        var replaceText = $(this).parent().hasClass("editAvailable") ? "Batal" : "Edit";
        $(this).text(replaceText);
    })
</script>
<?= $this->endSection(); ?>