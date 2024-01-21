<?= $this->extend('layouts/app');?>

<?= $this->section('page_title');?>
Profile
<?= $this->endSection();?>

<?= $this->section('content');?>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success notif" role="alert"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-5">
            <div class="card profile-widget">
                <div class="profile-widget-header">                     
                    <img alt="image" src="<?= $profile->foto_profil == null ? base_url('assets/img/avatar/avatar-1.png') : base_url('uploads/image/' . $profile->foto_profil )?>" class="rounded-circle profile-widget-picture">
                </div>
                <div class="profile-widget-description">
                    <div class="profile-widget-name">
                        <?= $profile->nama_lengkap ?> 
                        <div class="text-muted d-inline font-weight-normal">
                            <div class="slash"></div> 
                            <?= '@'. $profile->username ?>
                        </div>
                    </div>
                    <?= $profile->alamat ?>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-7">
            <div class="card">
                <form method="post" class="needs-validation" novalidate="" action="<?= base_url('setting/profile/update')?>" enctype="multipart/form-data">
                    <div class="card-header">
                        <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <input type="hidden" value="<?= $profile->id_user?>" name="id_user">
                        <div class="row">                               
                            <div class="form-group col-md-4 col-12">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" value="<?= $profile->nama_lengkap ?>" required="" name="nama_lengkap">
                                <div class="invalid-feedback">
                                    Please fill in the first name
                                </div>
                            </div>
                            <div class="form-group col-md-4 col-12">
                                <label>Username</label>
                                <input type="text" class="form-control" value="<?= $profile->username ?>" required="" name="username" readonly>
                                <div class="invalid-feedback">
                                    Please fill in the last name
                                </div>
                            </div>
                            <div class="form-group col-md-4 col-12">
                                <label>Email</label>
                                <input type="email" class="form-control" value="<?= $profile->email ?>" required="" name="email">
                                <div class="invalid-feedback">
                                    Please fill in the last name
                                </div>
                            </div>
                        </div>
                        <div class="row">                               
                            <div class="form-group col-md-6 col-12">
                                <label>Alamat</label>
                                <input type="text" class="form-control" value="<?= $profile->alamat ?>" required="" name="alamat">
                                <div class="invalid-feedback">
                                    Please fill in the first name
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>No Telp</label>
                                <input type="text" class="form-control telp" name="no_telp" value="<?= $profile->no_telp ?>">
                                <div class="invalid-feedback">
                                    Please fill in the last name
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" class="form-control" name="foto">
                            <div class="invalid-feedback">
                                Please fill in the last name
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary" type="submit">Update Data</button>

                        <button class="btn btn-light btn-reset-password" type="button" data-id="<?= $profile->id_user ?>" data-toggle="modal" data-target="#reset-password">Reset Password</button>
                        
                        <?php if ($profile->foto_profil != null) { ?>
                            <a href="<?= base_url('setting/profile/delete-img/' . $profile->id_user)?>" class="btn btn-outline-danger" onclick="return confirm('Apakah anda yakin?')">Hapus Foto</a>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?= $this->endSection();?>

<?= $this->section('modal');?>
    <?= $this->include('setting/profile/reset_password');?>
<?= $this->endSection();?>

<?= $this->section('script');?>
<script>
    $(document).on("click", ".btn-reset-password", function(e) {
        e.preventDefault();
        let id_user = $(this).data('id');
        $("#id_user_reset").val(id_user);
    });

    $(document).on("click", "#btn-proses", function(e) {
        e.preventDefault();
        let id_user = $("#id_user_reset").val();
        let password = $("#password_lama").val();
        $.ajax({
            url: "<?= base_url('setting/profile/check-password')?>",
            type: "post",
            dataType: "json",
            data: {
                id_user : id_user,
                password_lama : password
            },
            success: function(response) {
                let data = response;
                if (data.status === false) {
                    swal('Gagal!', data.msg, 'warning');
                } else {
                    swal('Berhasil!', '', 'warning');
                    $("#content_password_lama").addClass('d-none');
                    $("#content_reset_password").removeClass('d-none');
                    $("#btn-proses").addClass('d-none');
                    $("#btn-simpan").removeClass('d-none');
                }
            }
        });
    });

    $("#formReset").on("submit", function(e) {
        e.preventDefault();
        let params = $("#formReset").serialize();
        $.ajax({
            url: "<?= base_url('setting/profile/reset-password')?>",
            type: "post",
            dataType: "json",
            data: params,
            success: function(response) {
                let data = response;
                swal({
                    title: 'Sukses!',
                    text: data.msg,
                    icon: 'success',
                }).then(function() {
                    location.reload();
                });
            }
        });
    })

    $("#reset-password").on("hidden.bs.modal", function() {
        $("#content_password_lama").removeClass('d-none');
        $("#content_reset_password").addClass('d-none');
        
        $("#btn-proses").removeClass('d-none');
        $("#btn-simpan").addClass('d-none');

        $("#password_lama").val('');
        $("#password_baru").val('');
        $("#konfirmasi_password").val('');
    });
</script>
<?= $this->endSection();?>