<?= $this->extend('admin/layouts/index'); ?>

<?= $this->section('content-main'); ?>
<br>
<br>
<div class="container-fluid">
    <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="<?= base_url(); ?>/assets/img/<?= user()->user_image; ?>" alt=" profile_image" class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        <?= user()->username; ?>
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        <?= user()->email; ?>
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Kelola Profile</h4>
        </div>
        <?= view('admin\layouts\message-block'); ?>
        <?php $validation = \Config\Services::validation(); ?>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="Masukkan Username Baru" value="<?= user()->username; ?>">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <small class="text-muted">eg.<i>someone@example.com</i></small>
                            <input type="email" class="form-control" id="email" placeholder="Masukkan Email Baru" value="<?= user()->email; ?>">
                        </div>

                        <div class="form-group">
                            <label for="username">Kata Sandi</label>
                            <input type="password" class="form-control" id="username" placeholder="Masukkan Kata Sandi Baru">
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">Konfirmasi Kata Sandi</label>
                            <input type="password" class="form-control" id="password-confirm" placeholder="Masukkan Kata Sandi Konfirmasi">
                        </div>

                        <button type="submit" class="btn bg-gradient-info"> <i class="fas fa-save"></i> Simpan Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>