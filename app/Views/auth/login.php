<?= $this->extend('auth/layouts/index'); ?>

<?= $this->section('main-content'); ?>
<main class="main-content  mt-0">
    <section>
        <div class="page-header min-vh-75">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                        <div class="card card-plain mt-8">
                            <div class="card-header pb-0 text-left bg-transparent">
                                <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
                                <p class="mb-0">Enter your email and password to sign in</p>
                                <br>
                                <?= view('Myth\Auth\Views\_message_block') ?>
                            </div>
                            <div class="card-body">
                                <form action="<?= url_to('login') ?>" method="post" role="form">
                                    <?= csrf_field() ?>
                                    <label>Email</label>
                                    <div class="mb-3">
                                        <input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" placeholder="Email" aria-label="Email" aria-describedby="email-addon" name="login">
                                        <div class="invalid-feedback">
                                            <?= session('errors.login') ?>
                                        </div>
                                    </div>
                                    <label>Password</label>
                                    <div class="mb-3">
                                        <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="Password" aria-label="Password" aria-describedby="password-addon" name="password">
                                        <div class="invalid-feedback">
                                            <?= session('errors.password') ?>
                                        </div>
                                    </div>
                                    <?php if ($config->allowRemembering) : ?>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="rememberMe" <?php if (old('remember')) : ?> checked="" <?php endif ?> name="remember">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                    <?php endif; ?>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign in</button>
                                    </div>
                                </form>
                            </div>
                            <?php if ($config->allowRegistration) : ?>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Don't have an account?
                                        <a href="<?= url_to('register') ?>" class="text-info text-gradient font-weight-bold">Sign up</a>
                                    </p>
                                </div>
                            <?php endif; ?>
                            <?php if ($config->activeResetter) : ?>
                                <p><a href="<?= url_to('forgot') ?>"><?= lang('Auth.forgotYourPassword') ?></a></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                            <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('../assets/img/curved-images/curved6.jpg')"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?= $this->endSection(); ?>