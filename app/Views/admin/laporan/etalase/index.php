<?= $this->extend('admin/layouts/index'); ?>

<?= $this->section('breadcrumbs'); ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/">Dashboard /</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Laporan Etalase</h6>
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
                        <form action="laporanetalase/print" method="post">
                            <?= csrf_field(); ?>
                            <input type="hidden" id="rangeDate" name="rangeDate" value="<?= $datefilter; ?>">
                            <button role="button" type="submit" class="btn btn-info"><i class="fas fa-edit"></i> Cetak PDF</button>
                        </form>
                    </div>
                    <div class="col-md">
                        <form action="laporanetalase" method="post">
                            <label for="datefilter">Filter bedasarkan tanggal</label>
                            <div class="input-group">
                                <input type="text" id="datefilter" name="toOld" value="<?= $toOld; ?>" class="form-control" placeholder="Masukkan tanggal produksi" />
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Foto</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Barang</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah Barang</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Masuk</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ukuran</th>
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
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><?= $opn['tgl_et']; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <?php
                                    $db      = \Config\Database::connect();
                                    $builder = $db->table('etalase');
                                    $data = $builder->select('etalase.jmlh_et as stok,p.ukuran,etalase.tgl_et')->join('produksi p', 'etalase.id_pro=p.id_pro')->where('etalase.id_et', $opn['id_et'])->get();
                                    ?>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <?php foreach ($data->getResultArray() as $row) : ?>
                                                    <h6 class="mb-0 text-sm"><?= $row['ukuran']; ?></h6>
                                                <?php endforeach; ?>
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
                    <?= $pager->links('etalase', 'customPagination') ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

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
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
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