<?= $this->extend('admin/layouts/index'); ?>

<?= $this->section('breadcrumbs'); ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/">Dashboard /</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Laporan Penjualan</h6>
</nav>
<?= $this->endSection(); ?>

<?= $this->section('content-main'); ?>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-md-8">
                        <h6><?= $title; ?></h6>
                        <form action="laporanpenjualan/print" method="post">
                            <?= csrf_field(); ?>
                            <input type="hidden" id="rangeDate" name="rangeDate" value="<?= $datefilter; ?>">
                            <button role="button" type="submit" class="btn btn-info"><i class="fas fa-edit"></i> Cetak PDF</button>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <form action="laporanpenjualan" method="post">
                            <label for="datefilter">Tanggal Penjualan</label>
                            <div class="input-group">
                                <input type="text" id="datefilter" name="toOld" value="<?= $toOld; ?>" class="form-control w-50" placeholder="Masukkan tanggal penjualan" />
                                <input type="hidden" name="datefilter" value="<?= $datefilter; ?>" class="form-control" placeholder="Masukkan tanggal produksi" />
                                <button type="submit" class="btn btn-outline-secondary mb-0"><i class="fas fa-filter"></i></button>
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Marketplace</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Input</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Barang</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Banyaknya</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Penjualan</th>
                                    </tr>
                                </thead>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 + (5 * ($currentPage - 1)); ?>
                            <?php foreach ($penjualan as $pen) : ?>
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
                                                <h6 class="mb-0 text-sm"><?= $pen['marketplace']; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><?php echo date('d F Y', strtotime($pen['tgl_inp'])); ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><?= $pen['nm_pro']; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><?= $pen['banyak_brg']; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><?= $pen['total_penj']; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mx-3">
                <?php if ($pager) : ?>
                    <?= $pager->links('produksi', 'customPagination') ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>



<?= $this->section('script'); ?>

<script type="text/javascript">
    $(function() {

        $('#datefilter').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('#datefilter').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            $('input[name="datefilter"]').val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
            $('#rangeDate').val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'))
        });

        $('#datefilter').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            $('input[name="datefilter"]').val('');
            $('#rangeDate').val('');
        });
    });
</script>
<?= $this->endSection(); ?>


<?= $this->endSection(); ?>