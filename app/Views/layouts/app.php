<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>SIM - Klinik Hewan</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url('assets/modules/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/modules/fontawesome/css/all.min.css') ?>">

    <!-- CSS Libraries -->
    <!-- <link rel="stylesheet" href="<?= base_url('assets/modules/jqvmap/dist/jqvmap.min.css') ?>"> -->
    <!-- <link rel="stylesheet" href="<?= base_url('assets/modules/weather-icon/css/weather-icons.min.css') ?>"> -->
    <!-- <link rel="stylesheet" href="<?= base_url('assets/modules/weather-icon/css/weather-icons-wind.min.css') ?>"> -->
    <!-- <link rel="stylesheet" href="<?= base_url('assets/modules/summernote/summernote-bs4.css') ?>"> -->
    <link rel="stylesheet" href="<?= base_url('assets/modules/ionicons/css/ionicons.min.css')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <link rel="stylesheet" href="<?= base_url('assets/modules/select2/dist/css/select2.min.css')?>">
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components.css') ?>">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    
    
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
    </script>
</head>
    <body>
        <?php
            $username = session()->get('username');
            $id_user = session()->get('id_user');
            // dd($id_user);
            $db = db_connect();
            $profile = $db->query("select 
                a.*
            from users a
            where a.id_user = '$id_user'")->getRow();
            // dd($profile);
        ?>
        <div id="app">
            <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <?php 
                    $db = db_connect();
                    $query = $db->query("SELECT * FROM log_history WHERE is_read = 0 ORDER BY id DESC LIMIT 5")->getResult();
                    // print_r(count($query));exit;
                    if (session()->get('role_name') == 'admin') { ?>
                    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg <?= count($query) > 0 ? 'beep' : ''?>" aria-expanded="false"><i class="far fa-bell"></i></a>
                        
                    <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">Notifications
                                <?php if (count($query) > 0) { ?>
                                <div class="float-right">
                                    <a href="javascript:void(0);" id="mark_as_read">Mark All As Read</a>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="dropdown-list-content dropdown-list-icons" tabindex="2" style="overflow: hidden; outline: none;">
                                <?php 
                                foreach ($query as $key => $value) { ?>
                                    <a href="#" class="dropdown-item">
                                        <div class="dropdown-item-icon bg-info text-white">
                                            <i class="far fa-user"></i>
                                        </div>
                                        <div class="dropdown-item-desc">
                                            <?= $value->message ?>
                                            <div class="time"><?= Carbon\Carbon::parse($value->created_at)->diffForHumans() ?></div>
                                        </div>
                                    </a>
                                <?php } ?>
                            </div>
                            <!-- <div class="dropdown-footer text-center">
                                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                            </div> -->
                        </div>
                    </li>
                    <?php } ?>
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" src="<?= $profile->foto_profil == null ? base_url('assets/img/avatar/avatar-1.png') : base_url('uploads/image/' . $profile->foto_profil ) ?>" class="rounded-circle mr-1">
                        <div class="d-sm-none d-lg-inline-block">Hi, <?= session()->get('username') . ' (' . session()->get('role_name') . ')' ?></div></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="<?= base_url('logout')?>" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.html">Klinik Hewan A</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">KHA</a>
                    </div>
                    
                    <?= $this->include('layouts/sidebar') ;?>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1><?= $this->renderSection('page_title');?></h1>
                    </div>
                    <?= $this->renderSection('content');?>
                </section>
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                Copyright &copy; 2018
                </div>
                <div class="footer-right">
                
                </div>
            </footer>
            </div>
        </div>
        <?= $this->renderSection('modal');?>

        <!-- General JS Scripts -->
        <script src="<?= base_url('assets/modules/jquery.min.js') ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <!-- <script src="<?= base_url('assets/modules/popper.js') ?>"></script> -->
        <!-- <script src="<?= base_url('assets/modules/tooltip.js') ?>"></script> -->
        <script src="<?= base_url('assets/modules/bootstrap/js/bootstrap.min.js') ?>"></script>
        <script src="<?= base_url('assets/modules/nicescroll/jquery.nicescroll.min.js') ?>"></script>
        <script src="<?= base_url('assets/modules/moment.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/stisla.js') ?>"></script>
        
        <!-- JS Libraies -->
        <!-- <script src="<?= base_url('assets/modules/simple-weather/jquery.simpleWeather.min.js') ?>"></script> -->
        <!-- <script src="<?= base_url('assets/modules/summernote/summernote-bs4.js') ?>"></script> -->

        <!-- Page Specific JS File -->
        <!-- <script src="<?= base_url('assets/js/page/index-0.js') ?>"></script> -->
        
        <!-- Template JS File -->
        <script src="<?= base_url('assets/js/scripts.js') ?>"></script>
        <script src="<?= base_url('assets/js/custom.js') ?>"></script>

        <!-- addons -->
        <script src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/dist/jquery.mask.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
        <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
        <script src="<?= base_url('assets/js/sweetalert.min.js')?>"></script>
        <script src="<?= base_url('assets/js/jquery.blockUI.min.js')?>"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
        <script src="<?= base_url('assets/modules/select2/dist/js/select2.full.min.js')?>"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        
        <script>
            $(document).ready(function() {
                // location.reload();
                $("#mark_as_read").on("click", function() {
                    $.ajax({
                        url: '<?= base_url('read_notification') ?>',
                        type: 'get',
                        success: function(response) {
                            console.log(response);
                            location.reload();
                        }
                    })
                });
            })
            $(".notif").fadeTo(2000, 500).slideUp(500, function(){
                $(".notif").slideUp(500);
            });

            function numerFormat(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            $('.telp').mask('62000000000000');

            $('.money').mask('000.000.000.000.000', {reverse: true});

            $(document).on("input", ".numeric", function() {
                this.value = this.value.replace(/\D/g,'');
            });
        </script>
        <?= $this->renderSection('script');?>
        
    </body>
</html>