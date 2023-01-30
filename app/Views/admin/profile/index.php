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
                    <form action="profile/<?= user()->id; ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="image_lama" value="<?= user()->user_image ?>">
                        <div class="form-group">
                            <label for="user_image">Foto Profil</label>
                            <div class="row">
                                <div class="col-sm-2">
                                    <img src="<?= base_url(); ?>/assets/img/<?= user()->user_image; ?>" class="img-thumbnail img-preview" alt="gambar">
                                </div>
                                <div class="col-sm-8">
                                    <input type="file" contenteditable="Pilih gambar" class="form-control <?= (validation_show_error('user_image') != '') ? 'is-invalid' : ''; ?>" id="user_image" name="user_image" value="<?= old('user_image'); ?>" onchange="previewImg()">
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('user_image') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control <?= (validation_show_error('username') != '') ? 'is-invalid' : ''; ?>" name="username" id="username" placeholder="Masukkan Username Baru" value="<?= old('username', user()->username); ?>">
                            <div class="invalid-feedback">
                                <?= validation_show_error('username') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <small class="text-muted">eg.<i>someone@example.com</i></small>
                            <input type="email" class="form-control <?= (validation_show_error('email') != '') ? 'is-invalid' : ''; ?>" name="email" id="email" placeholder="Masukkan Email Baru" value="<?= old('email', user()->email); ?>">
                            <div class="invalid-feedback">
                                <?= validation_show_error('email') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username">Kata Sandi</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Kata Sandi Baru">
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

<?= $this->section('script'); ?>
<script>
    function previewImg() {
        const image = document.querySelector('#user_image');
        const imgPreview = document.querySelector('.img-preview');

        const fileImage = new FileReader();
        fileImage.readAsDataURL(image.files[0]);

        fileImage.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>
<?= $this->endSection(); ?>

<?= $this->section('css-internal'); ?>
<style>
    #user_image::before {
        content: "Pilih gambar";
        position: absolute;
        z-index: 2;
        display: block;
        background-color: #eee;
        width: 90px;
    }
</style>
<?= $this->endSection(); ?>