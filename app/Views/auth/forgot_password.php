
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
                            <img src="assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header"><h4>Reset Password</h4></div>
                            <div class="card-body">
                                <!-- <p class="text-muted">We will send a link to reset your password</p> -->
                                <form id="myForm">
                                    <div class="form-group">
                                        <label for="username">Email</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Masukan alamat email" id="email" name="email" autofocus>
                                            <button class="btn btn-light" type="submit" id="btn-submit" style="border-radius: 0px 4px 4px 0px;">
                                                <i class="fas fa-chevron-circle-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; 2024
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
            $("#myForm").on("submit", function(e) {
                e.preventDefault();

                let email = $("#email").val();

                if (email == '') {
                    swal('Gagal', 'Email tidak boleh kosong!', 'warning');
                } else {
                    $.ajax({
                        url: '<?= base_url('sent-email') ?>',
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
                            email: email
                        },
                        success: function(response) {
                            $.unblockUI();
                            // swal('Berhasil', response.msg, 'success');
                            // location.reload()
                            swal({
                                title: "Berhasil",
                                text: response.msg,
                                icon: "success",
                                // buttons: true,
                                // dangerMode: true,
                            })
                            .then((isConfirm) => {
                                if (isConfirm) {
                                    location.reload();
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            $.unblockUI();
                            swal('Gagal', xhr.responseJSON.message, 'warning')
                        }
                    })
                }
            })
        });
    </script>
</body>
</html>