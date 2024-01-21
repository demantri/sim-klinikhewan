<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Halaman Login - SIM Klinik Hewan</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url('assets/node_modules/bootstrap-social/bootstrap-social.css')?>">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url('assets2/css/style.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets2/css/components.css')?>">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="d-flex flex-wrap align-items-stretch">
                <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                    <div class="p-4 m-3">
                        <img src="../assets/img/stisla-fill.svg" alt="logo" width="80" class="shadow-light rounded-circle mb-5 mt-2">
                        <h4 class="text-dark font-weight-normal">Selamat datang di <span class="font-weight-bold">SIM Klinik Hewan</span></h4>
                        <p class="text-muted">Pastikan username atau email anda sudah terdaftar.</p>

                        <?php if (session()->getFlashdata('logout')) : ?>
                            <div class="alert alert-info notif" role="alert"><?= session()->getFlashdata('logout') ?></div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('warning')) : ?>
                            <div class="alert alert-warning notif" role="alert"><?= session()->getFlashdata('warning') ?></div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('success')) : ?>
                            <div class="alert alert-success notif" role="alert"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>

                        <form method="POST" action="<?= base_url('doLogin') ?>" class="needs-validation" novalidate="">
                            <div class="form-group">
                                <label for="username">Username atau Email</label>
                                <input id="username" type="text" class="form-control" name="username" tabindex="1" value="<?php if(isset($_COOKIE["loginId"])) { echo $_COOKIE["loginId"]; } ?>" required autofocus>
                                <div class="invalid-feedback">
                                    Please fill in your username
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                    <div class="float-right">
                                        <a href="<?= base_url('forgot-password') ?>" class="text-small">
                                            Lupa Password ?
                                        </a>
                                    </div>
                                </div>
                                <input id="password" type="password" class="form-control" name="password" value="<?php if(isset($_COOKIE["loginPass"])) { echo $_COOKIE["loginPass"]; } ?>" tabindex="2" required>
                                <div class="invalid-feedback">
                                    please fill in your password
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me" <?php if(isset($_COOKIE["loginId"])) { ?> checked="checked" <?php } ?>>
                                    <label class="custom-control-label" for="remember-me">Remember Me</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    Login
                                </button>
                            </div>
                        </form>

                        <div class="mt-5 text-muted text-center">
                            Belum punya akun ? <a href="<?= base_url('register') ?>">Registrasi Disini</a>
                        </div>

                        <div class="text-center mt-5 text-small">
                            Copyright &copy; 2024
                            <!-- <div class="mt-2">
                                <a href="#">Privacy Policy</a>
                                <div class="bullet"></div>
                                <a href="#">Terms of Service</a>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="https://news.unair.ac.id/wp-content/uploads/2022/01/dokter-hewan.jpg">
                    <!-- <div class="absolute-bottom-left index-2">
                        <div class="text-light p-5 pb-2">
                            <div class="mb-5 pb-3">
                                <h1 class="mb-2 display-4 font-weight-bold">Good Morning</h1>
                                <h5 class="font-weight-normal text-muted-transparent">Bali, Indonesia</h5>
                            </div>
                            Photo by <a class="text-light bb" target="_blank" href="https://unsplash.com/photos/a8lTjWJJgLA">Justin Kauffman</a> on <a class="text-light bb" target="_blank" href="https://unsplash.com">Unsplash</a>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="<?= base_url('assets2/js/stisla.js')?>"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="<?= base_url('assets2/js/scripts.js')?>"></script>
    <script src="<?= base_url('assets2/js/custom.js')?>"></script>

    <!-- Page Specific JS File -->
</body>

</html>