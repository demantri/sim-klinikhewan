<?= $this->extend('layouts/app');?>

<?= $this->section('page_title');?>
Dokter
<?= $this->endSection();?>

<?= $this->section('content');?>

<?php 
    $validation = \Config\Services::validation();
?>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success notif" role="alert"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="row">
    <div class="col-sm-12">
        <div class="card card-primary">
            <form action="<?= base_url('masterdata/dokter/simpan')?>" method="post" id="myForm">
                <div class="card-header">
                    <h4>Form Tambah</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>Data Dokter</h5>
                            <hr>
                            <input type="hidden" name="id_user" value="<?= $id_user ?>">
                            <div class="form-group">
                                <label>ID Dokter</label>
                                <input type="text" class="form-control" name="id_dokter" id="id_dokter" value="<?= $kode ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input name="nama_lengkap" id="nama_lengkap" class="form-control <?= $validation->hasError('nama_lengkap') ? 'is-invalid' : ''?>" placeholder="Masukan nama lengkap" value="<?= set_value('nama_lengkap') ?>" autofocus>
                                <?php if ($validation->getError('nama_lengkap')) { ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama_lengkap'); ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label>No Telp</label>
                                <input type="text" name="no_telp" id="no_telp" class="form-control telp <?= $validation->hasError('no_telp') ? 'is-invalid' : ''?>" placeholder="Masukan no telp" value="<?= set_value('no_telp') ?>">
                                <?php if ($validation->getError('no_telp')) { ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('no_telp'); ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control <?= $validation->hasError('jenis_kelamin') ? 'is-invalid' : ''?>">
                                    <option value="" disabled selected>- Pilih -</option>
                                    <option value="L" <?= set_select('jenis_kelamin', 'L')?>>Laki laki</option>
                                    <option value="P" <?= set_select('jenis_kelamin', 'P')?>>Perempuan</option>
                                </select>
                                <?php if ($validation->getError('jenis_kelamin')) { ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('jenis_kelamin'); ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <input name="alamat" id="alamat" class="form-control <?= $validation->hasError('alamat') ? 'is-invalid' : ''?>" placeholder="Masukan alamat" value="<?= set_value('alamat') ?>">
                                <?php if ($validation->getError('alamat')) { ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('alamat'); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h5>Detail User</h5>
                            <hr>
                            <input type="hidden" value="dokter" name="role_name">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" id="username" class="form-control <?= $validation->hasError('username') ? 'is-invalid' : ''?>" value="<?= set_value('username') ?>" placeholder="Masukan username">
                                <?php if(isset($validation)):?>
                                    <small class="text-danger"><?= $validation->getError('username') ?></small>
                                <?php endif;?>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" id="password" class="form-control <?= $validation->hasError('password') ? 'is-invalid' : ''?>" value="<?= set_value('password') ?>" placeholder="Masukan password">
                                <?php if(isset($validation)):?>
                                    <small class="text-danger"><?= $validation->getError('password') ?></small>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card card-primary">
            <div class="card-body">
                <table class="table table-bordered" id="table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center">#</th>
                            <th class="text-center">ID Dokter</th>
                            <th class="text-center">Nama Lengkap</th>
                            <th class="text-center">No Telp</th>
                            <th class="text-center">Jenis Kelamin</th>
                            <th class="text-center">Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach ($dokter as $item) : ?>
                        <tr>
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-light btn-edit mr-2" 
                                    data-toggle="modal" 
                                    data-target="#edit"
                                    data-id="<?= $item->id ?>"
                                    data-id_dokter="<?= $item->id_dokter ?>"
                                    data-nama_lengkap="<?= $item->nama_lengkap ?>"
                                    data-no_telp="<?= $item->no_telp ?>"
                                    data-jenis_kelamin="<?= $item->jenis_kelamin ?>"
                                    data-alamat="<?= $item->alamat ?>"
                                    ><i class="fa-solid fa-pencil"></i></button>

                                    <!-- <a href="<?= base_url('masterdata/dokter/edit/' . $item->id_dokter)?>"></a> -->

                                    <a href="<?= base_url('masterdata/dokter/hapus/' . $item->id)?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-outline-danger"
                                    ><i class="fa-solid fa-trash"></i></a>
                                </div>
                            </td>
                            <td><?= $no++ ?></td>
                            <td><?= $item->id_dokter ?></td>
                            <td><?= $item->nama_lengkap ?></td>
                            <td><?= $item->no_telp ?></td>
                            <td><?= $item->jenis_kelamin ?></td>
                            <td><?= $item->alamat ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection();?>

<?= $this->section('modal');?>
    <?= $this->include('masterdata/dokter/edit');?>
<?= $this->endSection();?>

<?= $this->section('script');?>
<script>
    $(document).on("click", ".btn-edit", function() {
        let id = $(this).data("id");
        let id_dokter = $(this).data("id_dokter");
        let nama_lengkap = $(this).data("nama_lengkap");
        let no_telp = $(this).data("no_telp");
        let jenis_kelamin = $(this).data("jenis_kelamin");
        let alamat = $(this).data("alamat");

        $("#id_edit").val(id);
        $("#id_dokter_edit").val(id_dokter);
        $("#nama_lengkap_edit").val(nama_lengkap);
        $("#no_telp_edit").val(no_telp);
        $("#jenis_kelamin_edit").val(jenis_kelamin);
        $("#alamat_edit").val(alamat);
    });
    
    $(document).ready(function() {
        $("#table").DataTable({
            destroy: true,
            scrollX: true,
            columnDefs: [{
                orderable: false,
                // className: 'select-checkbox',
                targets:   0
            }],
            order: [[ 1, "asc" ]],
        });

        $.validator.setDefaults({
            debug: false,
            ignore: "",
            highlight: function(element) {
                $(element).closest('.form-control').addClass('is-invalid');
                $(element).siblings('.select2-container').find('.select2-selection').addClass(
                    'is-invalid');
            },
            unhighlight: function(element) {
                $(element).closest('.form-control').removeClass('is-invalid');
                $(element).siblings('.select2-container').find('.select2-selection').removeClass(
                    'is-invalid');
            },
            errorPlacement: function(error, element) {
                if (element.hasClass('select-dua') || element.hasClass('select2-without-search')) {
                    error.insertAfter(element.siblings('.select2'));
                } else {
                    error.insertAfter(element);
                }
            }
        });

        $("#myForm").validate({
            rules: {
                nama_lengkap: {
                    required: true,
                },
                no_telp: {
                    required: true,
                },
                jenis_kelamin: {
                    required: true,
                },
                alamat: {
                    required: true,
                },
                username: {
                    required: true,
                    minlength: 4
                },
                password: {
                    required: true,
                    minlength: 8
                }
            }
        })
    });
</script>
<?= $this->endSection();?>