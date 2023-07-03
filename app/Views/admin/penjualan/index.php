<?= $this->extend('admin/layouts/index'); ?>

<?= $this->section('breadcrumbs'); ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/">Dashboard /</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Penjualan</h6>
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
                        <?php if (in_groups('admin')) : ?>
                            <a role="button" id="createData" class="btn btn-info clear" data-bs-toggle="modal" data-bs-target="#create-data"><i class="fas fa-edit"></i> Tambah Data Penjualan</a>
                        <?php endif; ?>
                    </div>
                    <div class="col-md">
                        <form action="penjualan" method="post">
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Marketplace</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Input</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Barang</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ukuran</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Penjualan</th>
                                        <?php if (in_groups('admin')) : ?>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                        <?php endif; ?>
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
                                                <h6 class="mb-0 text-sm"><?= $pen['tgl_inp']; ?></h6>
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
                                        <?php
                                        $db      = \Config\Database::connect();
                                        $builder = $db->table('produksi');
                                        $data = $builder->select('ukuran')->join('penjualan p', 'produksi.id_pro=p.id_pro')->Where('produksi.id_pro', $pen['id_pro'])->get();
                                        ?>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <?php foreach ($data->getResultArray() as $pro) : ?>
                                                    <h6 class="mb-0 text-sm"><?= $pro['ukuran']; ?></h6>
                                                <?php endforeach; ?>
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
                                    <?php if (in_groups('admin')) : ?>
                                        <td class="align-middle">
                                            <a role="button" class="btn btn-warning" data-bs-target="#editData<?= $pen['id_penj']; ?>" data-bs-toggle="modal" data-id="<?= $pen['id_penj']; ?>" data-market="<?= $pen['marketplace']; ?>" data-tgl="<?= $pen['tgl_inp']; ?>" data-nama="<?= $pen['id_pro']; ?>" data-banyak="<?= $pen['banyak_brg']; ?>" data-total="<?= $pen['total_penj']; ?>"><i class="fas fa-file-alt"></i> Edit Data</a>
                                            <a role="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteData<?= $pen['id_penj']; ?>"><i class="fas fa-trash"></i> Delete Data</a>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="create-data" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Penjualan</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form text-left" action="<?= base_url('penjualan/store'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <label>Marketplace</label>
                    <div class="input-group mb-3">
                        <select type="text" name="marketplace" id="marketplace" class="form-control <?= (validation_show_error('marketplace') != '') ? 'is-invalid' : ''; ?>">
                            <option value="" selected disabled>-Pilih-</option>
                            <option value="Tokopedia">Tokopedia</option>
                            <option value="Shopee">Shopee</option>
                            <option value="Tiktok">Tiktok</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('marketplace') ?>
                        </div>
                    </div>
                    <label>Tanggal Input</label>
                    <div class="input-group mb-3">
                        <input type="date" name="tgl_input" id="tgl_input" class="form-control <?= (validation_show_error('tgl_input') != '') ? 'is-invalid' : ''; ?>" placeholder="Tanggal Input Barang" value="<?= old('tgl_input'); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('tgl_input') ?>
                        </div>
                    </div>
                    <label>Nama Barang</label>
                    <div class="dropdown">
                        <div class="input-group mb-3">
                            <a href="javascript:;" class="btn btn-success mb-0 dropbtn" id="button-addon1">Pilih Opsi</a>
                            <input id="selectNamaBarang" type="text" style="min-width: 383px; padding-left: 12px;" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                        </div>
                        <div class="dropdown-content">
                            <ul>
                                <?php foreach ($etalase as $pro) : ?>
                                    <li>
                                        <img src="/assets/img/storages/<?= $pro['foto']; ?>" alt="Gambar 1">
                                        <span data-stok="<?= $pro['jmlh_et']; ?>" data-harga="<?= $pro['harga']; ?>" data-id="<?= $pro['id_pro']; ?>"><?= $pro['nama_et']; ?> - <?= $pro['ukuran']; ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <input type="hidden" name="nama_barang" id="idBarang" value="">
                    <input type="hidden" name="hargaBarang" id="hargaBarang" value="">
                    <input type="hidden" name="stokBarang" id="stokBarang" value="">
                    <div class="row">
                        <div class="col-md">
                            <label>Banyaknya</label>
                            <div class="input-group mb-3">
                                <input type="number" name="banyak" id="banyak" class="form-control <?= (validation_show_error('banyak') != '') ? 'is-invalid' : ''; ?>" placeholder="Banyaknya" value="<?= old('banyak'); ?>">
                                <div class="invalid-feedback">
                                    <?= validation_show_error('banyak') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Sisa Stok</label>
                            <div class="input-group mb-3">
                                <input type="number" id="sisa" class="form-control" placeholder="0">
                            </div>
                        </div>
                    </div>
                    <label>Total Penjualan</label>
                    <div class="input-group mb-3">
                        <input type="number" name="total_penj" id="total_penj" class="form-control" placeholder="0" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-gradient-info"> <i class="fas fa-save"></i> Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Data -->
<?php foreach ($penjualan as $pen) : ?>
    <div class="modal fade editData" id="editData<?= $pen['id_penj']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Penjualan</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form text-left" id="editDataForm" action="<?= base_url(); ?>/penjualan/update/<?= $pen['id_penj']; ?>" method="post">
                        <?= csrf_field(); ?>
                        <label>Marketplace</label>
                        <div class="input-group mb-3">
                            <select type="text" name="marketplace" id="marketplace" class="form-control <?= (validation_show_error('marketplace') != '') ? 'is-invalid' : ''; ?>">
                                <option value="" selected disabled>-Pilih-</option>
                                <option value="Tokopedia" <?= $pen['marketplace'] == 'Tokopedia' ? 'selected' : ''; ?>>Tokopedia</option>
                                <option value="Shopee" <?= $pen['marketplace'] == 'Shopee' ? 'selected' : ''; ?>>Shopee</option>
                                <option value="Tiktok" <?= $pen['marketplace'] == 'Tiktok' ? 'selected' : ''; ?>>Tiktok</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= validation_show_error('marketplace') ?>
                            </div>
                        </div>
                        <label>Tanggal Input</label>
                        <div class="input-group mb-3">
                            <input type="date" name="tgl_input" id="tgl_input" class="form-control <?= (validation_show_error('tgl_input') != '') ? 'is-invalid' : ''; ?>" placeholder="Tanggal Input Barang" value="<?= old('tgl_input', $pen['tgl_inp']); ?>">
                            <div class="invalid-feedback">
                                <?= validation_show_error('tgl_input') ?>
                            </div>
                        </div>


                        <label>Nama Barang</label>
                        <div id="modal_content"></div>
                        <div class="input-group mb-3" id="elemetSelect">
                            <select type="text" name="nama_barang" id="nama_barang_edit" class="form-control <?= (validation_show_error('nama_barang') != '') ? 'is-invalid' : ''; ?>">
                                <option value="" selected disabled>-Pilih-</option>
                                <?php
                                $db      = \Config\Database::connect();
                                $builder = $db->table('etalase');
                                $data = $builder->select('etalase.id_pro,etalase.nama_et,p.harga,p.ukuran,etalase.jmlh_et')->join('produksi p', 'etalase.id_pro=p.id_pro')->where('etalase.jmlh_et >', 0)->orWhere('etalase.id_pro', $pen['id_pro'])->get();
                                ?>
                                <?php foreach ($data->getResultArray() as $pro) : ?>
                                    <option value="<?= $pro['id_pro']; ?>" data-harga="<?= $pro['harga']; ?>" data-stok="<?= $pro['jmlh_et']; ?>" <?= $pen['id_pro'] == $pro['id_pro'] ? 'selected' : ''; ?>><?= $pro['nama_et']; ?> - <?= $pro['ukuran']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= validation_show_error('nama_barang') ?>
                            </div>
                        </div>
                        <input type="hidden" value="<?= $pen['banyak_brg']; ?>" id="jumlahAwal">
                        <div class="row">
                            <div class="col-md">
                                <label>Banyaknya</label>
                                <div class="input-group mb-3">
                                    <input type="number" name="banyak" id="banyakEdit" class="form-control <?= (validation_show_error('banyak') != '') ? 'is-invalid' : ''; ?>" placeholder="Banyaknya" value="<?= old('banyak', $pen['banyak_brg']); ?>">
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('banyak') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Sisa Stok</label>
                                <div class="input-group mb-3">
                                    <input type="number" id="sisaEdit" class="form-control" placeholder="0">
                                </div>
                            </div>
                        </div>
                        <label>Total Penjualan</label>
                        <div class="input-group mb-3">
                            <input type="number" name="total_penj" id="total_penj_edit" class="form-control" placeholder="0" readonly value="<?= $pen['total_penj']; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn bg-gradient-info"> <i class="fas fa-save"></i> Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Delete Data -->
<?php foreach ($penjualan as $pen) : ?>
    <div class="modal fade" id="deleteData<?= $pen['id_penj']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Data Penjualan</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form text-left" action="<?= base_url('penjualan/destroy/' . $pen['id_penj']); ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <p>Apakah yakin untuk hapus data penjualan <strong></strong><?= $pen['nm_pro']; ?>?</p>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn bg-gradient-danger"> <i class="fas fa-trash"></i> Delete Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection(); ?>

<?= $this->section('css-internal'); ?>
<style>
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropbtn {
        background-color: #4CAF50;
        color: white;
        padding: 12px;
        font-size: 12px;
        border: none;
        cursor: pointer;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        min-width: 480px;
        max-height: 160px;
        overflow-y: auto;
        z-index: 1;
        background-color: #f9f9f9;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    }

    .dropdown-content ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .dropdown-content li {
        display: flex;
        align-items: center;
        padding: 8px;
        cursor: pointer;
    }

    .dropdown-content li img {
        width: 100px;
        height: 100px;
        margin-right: 8px;
    }

    .dropdown-content li:hover {
        background-color: #e2e2e2;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    // Hanya diperlukan jika ingin menambahkan logika tambahan

    // Contoh: menampilkan teks yang dipilih saat opsi di dropdown diklik
    document.querySelectorAll('.dropdown-content ul li').forEach(item => {
        item.addEventListener('click', function() {
            var stok = this.querySelector('span').getAttribute('data-stok');
            var id = this.querySelector('span').getAttribute('data-id');
            var harga = this.querySelector('span').getAttribute('data-harga');
            $("#sisa").val(stok)
            $("#idBarang").val(id)
            $("#hargaBarang").val(harga)
            $("#stokBarang").val(stok)
            $("#selectNamaBarang").val(this.innerText)
        });
    });

    $("#nama_barang").on('change', function() {
        let selectedI = this.selectedIndex;
        var stok = this.options[selectedI].dataset.stok
        $("#sisa").val(stok)
    })

    $("#nama_barang_edit").on('change', function() {
        let selectedI = this.selectedIndex;
        var stok = this.options[selectedI].dataset.stok
        $("#sisaEdit").val(stok)
    })

    $("[name='banyak']").on('keyup', function() {
        // let selectedI = document.getElementById('nama_barang').selectedIndex;
        var harga = $('#hargaBarang').val()
        var stok = $('#stokBarang').val()
        var total = parseInt(harga) * parseInt($("[name='banyak']").val())
        var sisaAkhir = parseInt(stok) - parseInt($("[name='banyak']").val())
        $("#sisa").val(sisaAkhir)
        $("#total_penj").val(total)
    })

    $("#banyakEdit").on('keyup', function() {
        let selectedI = document.getElementById('nama_barang_edit').selectedIndex;
        var harga = document.getElementById('nama_barang_edit').options[selectedI].dataset.harga
        var stok = document.getElementById('nama_barang_edit').options[selectedI].dataset.stok
        var jumlahAwal = $('#jumlahAwal').val()
        var total = parseInt(harga) * parseInt($("#banyakEdit").val())
        var sisaAkhir = parseInt(jumlahAwal) + parseInt(stok) - parseInt($("#banyakEdit").val())
        $("#sisaEdit").val(sisaAkhir)
        $("#total_penj_edit").val(total)
    })

    $('.editData').on('show.bs.modal', function(event) {
        // var button = $(event.relatedTarget)
        // var id = button.data('id')
        // var tgl = button.data('tgl')
        // var nama = button.data('nama')
        // var market = button.data('market')
        // var banyak = button.data('banyak')
        // var total = button.data('total')
        // var modal = $(this)
        // modal.find('.modal-body #editDataForm').attr("action", "<?= base_url(); ?>/penjualan/update/" + id)
        // modal.find('.modal-body #tgl_input').val(tgl)
        // modal.find('.modal-body #banyakEdit').val(banyak)
        // modal.find('.modal-body #total_penj_edit').val(total)
        // var select = modal.find('.modal-body #marketplace')[0];
        // for (var i = 0; i < select.options.length; i++) {
        //     if (select.options[i].value == market) {
        //         select.options[i].selected = true;
        //         break;
        //     }
        // }

        let selectedI = document.getElementById('nama_barang_edit').selectedIndex;
        var stok = document.getElementById('nama_barang_edit').options[selectedI].dataset.stok
        $("#sisaEdit").val(stok)

        // $.ajax({
        //     type: 'GET',
        //     url: 'penjualan/getdata',
        //     data: {
        //         id: id,
        //     },
        //     success: function(response) {
        //         // var data = JSON.parse(response);
        //         $('#modal_content').html(response.isi);
        //     },
        //     error: function() {
        //         alert('Terjadi kesalahan saat memuat data');
        //     }
        // });
    });
</script>
<?= $this->endSection(); ?>