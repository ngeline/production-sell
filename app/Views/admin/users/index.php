<?= $this->extend('admin/layouts/index'); ?>

<?= $this->section('breadcrumbs'); ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/">Dashboard /</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Users</h6>
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
                        <!-- <a role="button" id="createData" class="btn btn-info clear" data-bs-toggle="modal" data-bs-target="#create-data"><i class="fas fa-edit"></i> Tambah Data</a> -->
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
                        <?php $i = 1 + (5 * ($currentPage - 1)); ?>
                        <tbody>
                            <?php foreach ($users as $user) : ?>
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
                                                <h6 class="mb-0 text-sm"><?= $user->email; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><?= $user->username; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a role="button" class="btn btn-info" data-bs-target="#editData" data-bs-toggle="modal" data-id="<?= $user->id; ?>" data-email="<?= $user->email; ?>" data-username="<?= $user->username; ?>"><i class="fas fa-edit"></i> Edit Data</a>
                                        <a role="button" class="btn btn-warning" data-bs-target="#updatePassword" data-bs-toggle="modal" data-id="<?= $user->id; ?>"><i class="fas fa-edit"></i> Edit Password</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mx-3">
                <?= $pager->links('users', 'customPagination') ?>
            </div>
        </div>
    </div>
</div>

<!-- Create Data Users -->


<!-- Modal Edit Data -->
<div class="modal fade" id="editData" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Users</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formInput" role="form text-left" action="" method="post">
                    <?= csrf_field(); ?>
                    <label>Email</label>
                    <div class="input-group mb-3">
                        <input type="email" name="email" id="email" class="form-control <?= (validation_show_error('email') != '') ? 'is-invalid' : ''; ?>" placeholder="Email" required value="<?= old('email'); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('email') ?>
                        </div>
                    </div>
                    <label for="username">Username</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control <?= (validation_show_error('username') != '') ? 'is-invalid' : ''; ?>" name="username" id="username" placeholder="Masukkan Username Baru" value="<?= old('username'); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('username') ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-gradient-info"> <i class="fas fa-save"></i> Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="updatePassword" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Change Password Users</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formInput" role="form text-left" action="" method="post">
                    <?= csrf_field(); ?>
                    <label for="password">Kata Sandi</label>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control <?= (validation_show_error('password') != '') ? 'is-invalid' : ''; ?>" name="password" id="password" placeholder="Masukkan Kata Sandi Baru" value="<?= old('password'); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('password') ?>
                        </div>
                    </div>
                    <label for="password-confirm">Konfirmasi Kata Sandi</label>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control <?= (validation_show_error('password_confirm') != '') ? 'is-invalid' : ''; ?>" id="password-confirm" placeholder="Masukkan Kata Sandi Konfirmasi" name="password_confirm">
                        <div class="invalid-feedback">
                            <?= validation_show_error('password_confirm') ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-gradient-info"> <i class="fas fa-save"></i> Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $('#editData').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var email = button.data('email')
        var username = button.data('username')
        var modal = $(this)
        modal.find('.modal-body #formInput').attr("action", "<?= base_url(); ?>/users/update/" + id)
        modal.find('.modal-body #email').val(email)
        modal.find('.modal-body #username').val(username)
    });

    $('#updatePassword').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var modal = $(this)
        modal.find('.modal-body #formInput').attr("action", "<?= base_url(); ?>/users/passw/" + id)
        console.log("<?= base_url(); ?>'/users/passw/" + id);
    });
</script>
<?= $this->endSection(); ?>