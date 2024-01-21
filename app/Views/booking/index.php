
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

                    <div class="mb-3 mt-3">
                        <a href="javascript:window.history.go(-1);" class="btn btn-light">
                            Kembali
                        </a>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Form Booking</h4>
                        </div>

                            <div class="card-body">
                                <?php if (session()->getFlashdata('success')) : ?>
                                    <div class="alert alert-success notif" role="alert"><?= session()->getFlashdata('success') ?></div>
                                <?php endif; ?>
                                <form action="<?= base_url('booking') ?>" method="post">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="kode_booking">Kode Booking</label>
                                            <input id="kode_booking" type="text" class="form-control" name="kode_booking" value="<?= $kode ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label>ID Pelanggan</label>
                                            <input type="text" name="id_pelanggan" id="id_pelanggan" class="form-control" value="<?= $data_pemilik->id_user ?>" readonly>
                                            <?php if(isset($validation)):?>
                                                <small class="text-danger"><?= $validation->getError('id_pelanggan') ?></small>
                                            <?php endif;?>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="nama_lengkap">Nama Lengkap</label>
                                            <input type="text" class="form-control" value="<?= $data_pemilik->nama_lengkap ?>" readonly>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="tgl_booking">Dokter</label>
                                            <select name="dokter" id="dokter" class="form-control">
                                                <option value="" selected disabled>- Pilih Dokter -</option>
                                                <?php foreach ($dokter as $item) : ?>
                                                <option value="<?= $item->id_user ?>"><?= 'Dr. ' . $item->nama_lengkap ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?php if(isset($validation)):?>
                                                <small class="text-danger"><?= $validation->getError('dokter') ?></small>
                                            <?php endif;?>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="tgl_booking">Tanggal Booking</label>
                                            <input id="tgl_booking" type="date" class="form-control" name="tgl_booking" value="<?= set_value('tgl_booking') ?>" required>
                                            <?php if(isset($validation)):?>
                                                <small class="text-danger"><?= $validation->getError('tgl_booking') ?></small>
                                            <?php endif;?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        Booking
                                        </button>
                                    </div>
                                </form>
                            </div>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/dist/jquery.mask.min.js"></script>
    <script>
        $('.telp').mask('62000000000000');
    </script>
</body>
</html>