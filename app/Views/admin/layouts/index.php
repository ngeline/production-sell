<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url(); ?>/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= base_url(); ?>/assets/img/favicon.png">
    <title>
        <?= $title; ?>
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="<?= base_url(); ?>/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>/assets/css/nucleo-svg.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <link href="<?= base_url(); ?>/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?= base_url(); ?>/assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
    <?= $this->renderSection('css-internal'); ?>


</head>

<body class="g-sidenav-show  bg-gray-100">
    <?= $this->include('admin/layouts/sidebar'); ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <?= $this->include('admin/layouts/navbar'); ?>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <?= $this->renderSection('content-main'); ?>
            <?= $this->include('admin/layouts/footer'); ?>
        </div>
    </main>
    <!--   Core JS Files   -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/core/popper.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/core/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/plugins/chartjs.min.js"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?= base_url(); ?>/assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
    <!-- datepicker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <?= $this->renderSection('script'); ?>
</body>

</html>