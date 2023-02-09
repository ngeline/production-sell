<?= $this->extend('admin/layouts/index'); ?>

<?= $this->section('breadcrumbs'); ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/">Dashboard /</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Laporan Produksi</h6>
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

                        <form action="" method="post">
                            <label for="datefilter">Tanggal Produksi</label>
                            <input type="text" name="datefilter" value="" class="form-control w-50" placeholder="Masukkan tanggal produksi" />
                            <br>
                            <a role="button" type="submit" class="btn btn-info"><i class="fas fa-edit"></i> Print Data</a>
                        </form>
                    </div>
                    <div class="col-md">
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Username</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                    </tr>
                                </thead>
                            </tr>
                        </thead>
                        <?php $i = 1  ?>
                        <tbody>

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
                                            <h6 class="mb-0 text-sm">Halo</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">Halo</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a role="button" class="btn btn-danger" data-bs-target="#deleteData" data-bs-toggle="modal"><i class="fas fa-edit"></i> Delete Data</a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mx-3">

            </div>
        </div>
    </div>
</div>

<?= $this->section('script'); ?>

<script type="text/javascript">
    $(function() {

        $('input[name="datefilter"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    });
</script>

<?= $this->endSection(); ?>


<?= $this->endSection(); ?>