
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Register &mdash; Stisla</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url('assets/modules/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/modules/fontawesome/css/all.min.css') ?>">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url('assets/modules/jquery-selectric/selectric.css') ?>">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components.css') ?>">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                    <div class="login-brand">
                        <img src="assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
                    </div>

                    <div class="card card-primary">
                        <div class="card-header"><h4>Form Pendaftaran</h4></div>

                            <div class="card-body">
                                <form action="<?= base_url('register') ?>" method="post">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="nama_lengkap">Nama Lengkap</label>
                                            <input id="nama_lengkap" type="text" class="form-control" name="nama_lengkap" value="<?= set_value('nama_lengkap') ?>" placeholder="Masukan nama lengkap" autofocus required>
                                            <?php if(isset($validation)):?>
                                                <small class="text-danger"><?= $validation->getError('nama_lengkap') ?></small>
                                            <?php endif;?>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="no_telp">No telp</label>
                                            <input id="no_telp" type="text" class="form-control telp" name="no_telp" value="<?= set_value('no_telp') ?>" placeholder="Masukan no telp" autofocus required>
                                            <?php if(isset($validation)):?>
                                                <small class="text-danger"><?= $validation->getError('no_telp') ?></small>
                                            <?php endif;?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                                <option value="" disabled selected>- Pilih -</option>
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                            <?php if(isset($validation)):?>
                                                <small class="text-danger"><?= $validation->getError('jenis_kelamin') ?></small>
                                            <?php endif;?>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="alamat">Alamat</label>
                                            <input id="alamat" type="text" class="form-control" name="alamat" value="<?= set_value('alamat') ?>" placeholder="Masukan alamat lengkap" required>
                                            <?php if(isset($validation)):?>
                                                <small class="text-danger"><?= $validation->getError('alamat') ?></small>
                                            <?php endif;?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input id="username" type="text" class="form-control" name="username" value="<?= set_value('username') ?>" placeholder="Masukan username" required>
                                        <?php if(isset($validation)):?>
                                            <small class="text-danger"><?= $validation->getError('username') ?></small>
                                        <?php endif;?>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="password" class="d-block">Password</label>
                                            <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" placeholder="Masukan password" required>
                                            <?php if(isset($validation)):?>
                                                <small class="text-danger"><?= $validation->getError('password') ?></small>
                                            <?php endif;?>
                                            <div id="pwindicator" class="pwindicator">
                                                <div class="bar"></div>
                                                <div class="label"></div>
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="password2" class="d-block">Konfirmasi Password</label>
                                            <input id="password2" type="password" class="form-control" name="confirm_password" placeholder="Masukan password sebelumnya" required>
                                            <?php if(isset($validation)):?>
                                                <small class="text-danger"><?= $validation->getError('confirm_password') ?></small>
                                            <?php endif;?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        Register
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="simple-footer">
                        Copyright &copy; 2023
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="<?= base_url('assets/modules/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/modules/popper.js') ?>"></script>
    <script src="<?= base_url('assets/modules/tooltip.js') ?>"></script>
    <script src="<?= base_url('assets/modules/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/modules/nicescroll/jquery.nicescroll.min.js') ?>"></script>
    <script src="<?= base_url('assets/modules/moment.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/stisla.js') ?>"></script>
    
    <!-- JS Libraies -->
    <script src="<?= base_url('assets/modules/jquery-pwstrength/jquery.pwstrength.min.js') ?>"></script>
    <script src="<?= base_url('assets/modules/jquery-selectric/jquery.selectric.min.js') ?>"></script>

    <!-- Page Specific JS File -->
    <script src="<?= base_url('assets/js/page/auth-register.js') ?>"></script>
    
    <!-- Template JS File -->
    <script src="<?= base_url('assets/js/scripts.js') ?>"></script>
    <script src="<?= base_url('assets/js/custom.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/dist/jquery.mask.min.js"></script>
    <script>
        $('.telp').mask('62000000000000');
    </script>
</body>
</html>