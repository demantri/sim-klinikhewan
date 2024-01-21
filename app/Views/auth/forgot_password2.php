
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Reset Password &mdash; Stisla</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url('assets/modules/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/modules/fontawesome/css/all.min.css') ?>">

    <!-- CSS Libraries -->

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
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="<?= base_url('assets/img/stisla-fill.svg') ?>" alt="logo" width="100" class="shadow-light rounded-circle">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header"><h4>Reset Password</h4></div>

                            <div class="card-body">
                                <!-- <p class="text-muted">We will send a link to reset your password</p> -->
                                <form id="myForm">
                                    <input type="text" name="link" id="link" value="<?= $link ?>" hidden>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Masukan email" id="email" name="email" value="<?= $user->email ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="" id="div_content">
                                        <div class="form-group">
                                            <label for="password">Password Baru</label>
                                            <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" tabindex="2" required autofocus>
                                            <div id="pwindicator" class="pwindicator">
                                                <div class="bar"></div>
                                                <div class="label"></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Konfirmasi Password</label>
                                            <input id="konfirm_password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="konfirm_password" tabindex="2" required>
                                            <div id="pwindicator" class="pwindicator">
                                                <div class="bar"></div>
                                                <div class="label"></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4" id="btn-reset">
                                                Reset Password
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="simple-footer">
                        Copyright &copy; Stisla 2018
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

    <!-- Page Specific JS File -->
    
    <!-- Template JS File -->
    <script src="<?= base_url('assets/js/scripts.js') ?>"></script>
    <script src="<?= base_url('assets/js/custom.js') ?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="<?= base_url('assets/js/jquery.blockUI.min.js')?>"></script>

    <script>
        $(document).ready(function() {
            $("#myForm").validate({
                rules: {
                    'password' : {
                        required: true,
                        minlength: 8,
                    },
                    'konfirm_password' : {
                        required: true,
                        minlength: 8,
                        equalTo: '[name="password"]'
                    }
                },
                messages: {
                    konfirm_password: {
                        equalTo: 'Passwords do not match. Try again.'
                    }
                },
                submitHandler: function () {
                    // console.log(form);
                    // form.submit();
                    $.ajax({
                        url: '<?= base_url('forgot-password') ?>',
                        type: 'post',
                        dataType: 'json',
                        beforeSend: function() {
                            $.blockUI({ 
                                message: '<h4>Please wait...</h4>',
                                baseZ: 2000,
                                css: { 
                                    border: 'none', 
                                    padding: '15px', 
                                    backgroundColor: '#000', 
                                    '-webkit-border-radius': '10px', 
                                    '-moz-border-radius': '10px', 
                                    // opacity: .5, 
                                    color: '#fff'
                                }
                            });
                        },
                        data: {
                            email: $("#email").val(),
                            password: $("#password").val(),
                            link: $("#link").val()
                            // confirm: $("#konfirm_password").val()
                        },
                        success: function(response) {
                            $.unblockUI();
                            swal({
                                title: "Berhasil",
                                text: response.msg,
                                icon: "success",
                                // buttons: true,
                                // dangerMode: true,
                            })
                            .then((isConfirm) => {
                                if (isConfirm) {
                                    // location.reload();
                                    window.location.href = '/';
                                }
                            });
                        }
                    })
                }
            });
        });
    </script>
</body>
</html>