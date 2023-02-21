<?= $this->extend('admin/layouts/index'); ?>

<?= $this->section('breadcrumbs'); ?>
<nav aria-label="breadcrumb">
    <h6 class="font-weight-bolder mb-0"><?= $title; ?></h6>
</nav>
<?= $this->endSection(); ?>

<?= $this->Section('content-main'); ?>
<div class="row">
    <div class="col-xl col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Produksi</p>
                            <h5 class="font-weight-bolder mb-0">
                                <?= $nProduksi; ?>
                                <span class="text-info text-sm font-weight-bolder">Kaos</span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                            <i class="ni ni-collection text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Barang Rusak</p>
                            <h5 class="font-weight-bolder mb-0">
                                <?= $nOpname; ?>
                                <span class="text-info text-sm font-weight-bolder">Kaos</span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                            <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Etalase</p>
                            <h5 class="font-weight-bolder mb-0">
                                <?= $nEtalase; ?>
                                <span class="text-info text-sm font-weight-bolder">Kaos</span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                            <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (in_groups('owner')) : ?>
        <div class="col-xl col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Penjualan</p>
                                <h5 class="font-weight-bolder mb-0">
                                    Rp <?= $totalPenjualan; ?>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php if (in_groups('owner')) : ?>
    <div class="row mt-4">
        <div class="col-lg-5">
            <div class="card z-index-2">
                <div class="card-header pb-0">
                    <h6>Pendapatan</h6>
                    <p class="text-sm">
                        <span class="font-weight-bold">Penjualan</span> di <?php echo date('Y'); ?>
                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="bg-gradient-dark border-radius-lg ">
                        <div class="chart">
                            <canvas id="chart-bars" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" col-lg-7">
            <div class="card z-index-2">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-md">
                            <h6>Penjualan Kaos</h6>
                        </div>
                        <div class="col-md">
                            <?php
                            $penjualan = new \App\Models\PenjualanModel();
                            $tahun = $penjualan->select('YEAR(tgl_inp) as tahun')->groupBy('tahun')->get();
                            ?>
                            <form action="/" method="post">
                                <div class="input-group">
                                    <select class="form-control" name="tahun">
                                        <option value="" selected disabled>-Pilih-</option>
                                        <?php foreach ($tahun->getResultArray() as $th) : ?>
                                            <option value="<?= $th['tahun']; ?>" <?= $filter == $th['tahun'] ? 'selected' : ''; ?>><?= $th['tahun']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="submit" class="btn btn-outline-secondary mb-0"><i class="fas fa-filter"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
            datasets: [{
                label: "Pendapatan",
                tension: 0.4,
                borderWidth: 0,
                borderRadius: 4,
                borderSkipped: false,
                backgroundColor: "#fff",
                data: <?php echo json_encode($pendapatanPerBulan) ?>,
                maxBarThickness: 6
            }, ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                    },
                    ticks: {
                        suggestedMin: 0,
                        beginAtZero: true,
                        padding: 15,
                        font: {
                            size: 14,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 3
                        },
                        color: "#fff"
                    },
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false
                    },
                    ticks: {
                        display: false
                    },
                },
            },
        },
    });


    var ctx2 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

    new Chart(ctx2, {
        type: "line",
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
            datasets: [{
                    label: "Cotton Combed 20s",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#cb0c9f",
                    borderWidth: 3,
                    backgroundColor: gradientStroke1,
                    fill: true,
                    data: <?php echo json_encode($bul['Cotton Combed 20s']) ?>,
                    maxBarThickness: 6

                },
                {
                    label: "Cotton Combed 24s",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#3A416F",
                    borderWidth: 3,
                    backgroundColor: gradientStroke2,
                    fill: true,
                    data: <?php echo json_encode($bul['Cotton Combed 24s']) ?>,
                    maxBarThickness: 6
                },
                {
                    label: "Cotton Combed 30s",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "3A4AAF",
                    borderWidth: 3,
                    backgroundColor: gradientStroke2,
                    fill: true,
                    data: <?php echo json_encode($bul['Cotton Combed 30s']) ?>,
                    maxBarThickness: 6
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#b2b9bf',
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        color: '#b2b9bf',
                        padding: 20,
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        },
    });
</script>
<?= $this->endSection(); ?>