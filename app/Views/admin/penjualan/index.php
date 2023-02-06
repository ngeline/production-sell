<?= $this->extend('admin/layouts/index'); ?>

<?= $this->section('content-main'); ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-md">
                        <h6><?= $title; ?></h6>
                        <a role="button" id="createData" class="btn btn-info clear" data-bs-toggle="modal" data-bs-target="#create-data"><i class="fas fa-edit"></i> Tambah Data Penjualan</a>
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Banyaknya</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Penjualan</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
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
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><?= $pen['total_penj']; ?></h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="align-middle">
                                        <a role="button" class="btn btn-warning" data-bs-target="#editData" data-bs-toggle="modal" data-id="<?= $pen['id_penj']; ?>" data-market="<?= $pen['marketplace']; ?>" data-tgl="<?= $pen['tgl_inp']; ?>" data-nama="<?= $pen['id_pro']; ?>" data-banyak="<?= $pen['banyak_brg']; ?>" data-total="<?= $pen['total_penj']; ?>"><i class="fas fa-file-alt"></i> Edit Data</a>
                                        <a role="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteData<?= $pen['id_penj']; ?>"><i class="fas fa-trash"></i> Delete Data</a>
                                    </td>
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
                        <input type="text" name="marketplace" id="marketplace" class="form-control <?= (validation_show_error('marketplace') != '') ? 'is-invalid' : ''; ?>" placeholder="Marketplace Penjualan" value="<?= old('marketplace'); ?>">
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
                    <div class="input-group mb-3">
                        <select type="text" name="nama_barang" id="nama_barang" class="form-control <?= (validation_show_error('nama_barang') != '') ? 'is-invalid' : ''; ?>">
                            <option value="" selected disabled>-Pilih-</option>
                            <?php foreach ($produksi as $pro) : ?>
                                <option value="<?= $pro['id_pro']; ?>" data-harga="<?= $pro['harga']; ?>"><?= $pro['nama_brg']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('nama_barang') ?>
                        </div>
                    </div>
                    <label>Banyaknya</label>
                    <div class="input-group mb-3">
                        <input type="number" name="banyak" id="banyak" class="form-control <?= (validation_show_error('banyak') != '') ? 'is-invalid' : ''; ?>" placeholder="Banyaknya" value="<?= old('banyak'); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('banyak') ?>
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
<div class="modal fade" id="editData" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Penjualan</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form text-left" id="editDataForm" action="<?= base_url(''); ?>" method="post">
                    <?= csrf_field(); ?>
                    <label>Marketplace</label>
                    <div class="input-group mb-3">
                        <input type="text" name="marketplace" id="marketplace" class="form-control <?= (validation_show_error('marketplace') != '') ? 'is-invalid' : ''; ?>" placeholder="Marketplace Penjualan" value="<?= old('marketplace'); ?>">
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
                    <div class="input-group mb-3" id="elemetSelect">
                        <select type="text" name="nama_barang" id="nama_barang_edit" class="form-control <?= (validation_show_error('nama_barang') != '') ? 'is-invalid' : ''; ?>">
                            <option value="" selected disabled>-Pilih-</option>
                            <?php foreach ($produksi as $pro) : ?>
                                <option value="<?= $pro['id_pro']; ?>" data-harga="<?= $pro['harga']; ?>"><?= $pro['nama_brg']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('nama_barang') ?>
                        </div>
                    </div>
                    <label>Banyaknya</label>
                    <div class="input-group mb-3">
                        <input type="number" name="banyak" id="banyakEdit" class="form-control <?= (validation_show_error('banyak') != '') ? 'is-invalid' : ''; ?>" placeholder="Banyaknya" value="<?= old('banyak'); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('banyak') ?>
                        </div>
                    </div>
                    <label>Total Penjualan</label>
                    <div class="input-group mb-3">
                        <input type="number" name="total_penj" id="total_penj_edit" class="form-control" placeholder="0" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-gradient-info"> <i class="fas fa-save"></i> Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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

<?= $this->section('script'); ?>
<script>
    $("[name='banyak']").on('keyup', function() {
        let selectedI = document.getElementById('nama_barang').selectedIndex;
        var harga = document.getElementById('nama_barang').options[selectedI].dataset.harga
        var total = parseInt(harga) * parseInt($("[name='banyak']").val())
        $("#total_penj").val(total)
    })

    $("#banyakEdit").on('keyup', function() {
        let selectedI = document.getElementById('nama_barang_edit').selectedIndex;
        var harga = document.getElementById('nama_barang_edit').options[selectedI].dataset.harga
        var total = parseInt(harga) * parseInt($("#banyakEdit").val())
        $("#total_penj_edit").val(total)
    })

    $('#editData').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var tgl = button.data('tgl')
        var nama = button.data('nama')
        var market = button.data('market')
        var banyak = button.data('banyak')
        var total = button.data('total')
        var modal = $(this)
        modal.find('.modal-body #editDataForm').attr("action", "<?= base_url(); ?>/penjualan/update/" + id)
        modal.find('.modal-body #marketplace').val(market)
        modal.find('.modal-body #tgl_input').val(tgl)
        modal.find('.modal-body #banyakEdit').val(banyak)
        modal.find('.modal-body #total_penj_edit').val(total)
        var nama = nama;
        var select = modal.find('.modal-body #nama_barang_edit')[0];
        console.log(select.options)
        for (var i = 0; i < select.options.length; i++) {
            if (select.options[i].value == nama) {
                select.options[i].selected = true;
                break;
            }
        }

    });
</script>
<?= $this->endSection(); ?>