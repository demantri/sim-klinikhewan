<?= $this->extend('layouts/app');?>

<?= $this->section('page_title');?>
User
<?= $this->endSection();?>

<?= $this->section('content');?>

<?php
    $validation = \Config\Services::validation();
    $errors = $validation->getErrors();
?>

<?php if (!empty(session()->getFlashdata('error'))) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h4>Periksa Entrian Form</h4>
        </hr />
        <?php echo session()->getFlashdata('error'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success notif" role="alert"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="row">
    <div class="col-sm-12">

        <div class="mb-3">
            <button class="btn btn-primary" data-target="#add" data-toggle="modal">
                Tambah Data
            </button>
        </div>

        <div class="card card-primary">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center"></th>
                                <th class="text-center">#</th>
                                <th class="text-center">Nama Lengkap</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">No Telp</th>
                                <th class="text-center">Jenis Kelamin</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Aktivasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($user as $item) : ?>
                            <tr>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-light btn-sm btn-edit mr-2" 
                                        data-toggle="modal" 
                                        data-target="#edit"
                                        data-id="<?= $item->id_user ?>"
                                        ><i class="fa-solid fa-pencil"></i></button>

                                        <!-- <a href="<?= base_url('masterdata/user/hapus/' . $item->id_user)?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-outline-danger btn-sm"
                                        ><i class="fa-solid fa-trash"></i></a> -->
                                        <a href="javascript:void(0)" onclick="hapusData('<?= $item->id_user ?>')" class="btn btn-outline-danger btn-sm">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                                <td><?= $no++ ?></td>
                                <td><?= $item->nama_lengkap ?></td>
                                <td><?= ucwords($item->role_name) ?></td>
                                <td><?= $item->no_telp ?></td>
                                <td><?= $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                                <td><?= $item->alamat ?></td>
                                <td><?= $item->username ?></td>
                                <td class="text-center">
                                    <?php if ($item->is_active == 1) { ?>
                                        <span class="badge badge-success">Aktif</span>
                                    <?php } else { ?>
                                        <a class="badge badge-danger text-white" onclick="return confirm('Apakah anda yakin?')" href="<?= base_url('masterdata/user/is_active/' . $item->id_user)?>">Tidak Aktif</a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection();?>

<?= $this->section('modal');?>
    <?= $this->include('masterdata/user/add');?>
    <?= $this->include('masterdata/user/edit');?>
<?= $this->endSection();?>

<?= $this->section('script');?>
<script>
    function hapusData(id_user) {
        swal({
            title: "Apakah anda yakin?",
            text: "Data yang sudah dihapus tidak dapat dikembalikan. Apakah yakin?",
            icon: "info",
            buttons: true,
            // dangerMode: true,
        })
        .then((isConfirm) => {
            if (isConfirm) {
                // location.reload();
                $.ajax({
                    url: '<?= base_url('masterdata/user/hapus/') ?>' + id_user,
                    type: 'post',
                    dataType: 'json',
                    success: function(response) {
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
                    }
                })
            }
        });
    }
    
    $(document).on("click", ".btn-edit", function() {
        let id = $(this).data('id');
        $.ajax({
            url: "<?= base_url('masterdata/user/getUser')?>",
            type: "post",
            dataType: "json",
            data: {
                id_user : id
            },
            success: function(response) {
                let data = response;
                $("#id_user_edit").val(data.id_user);
                $("#nama_lengkap_edit").val(data.nama_lengkap);
                $("#no_telp_edit").val(data.no_telp);
                $("#role_edit").val(data.role_name);
                $("#jenis_kelamin_edit").val(data.jenis_kelamin);
                $("#alamat_edit").val(data.alamat);
            }
        })
    });
    
    $(document).ready(function() {
        // $("#table").DataTable({
        //     destroy: true,
        //     scrollX: true,
        //     columnDefs: [{
        //         orderable: false,
        //         targets:   0
        //     }],
        //     order: [[ 1, "asc" ]],
        //     pageLength : 5,
        //     lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']]
        // });

        $("#table").DataTable({
            order: [[ 1, "asc" ]],
            pageLength : 5,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']]
        });
    });
</script>
<script type="text/javascript">
    if (count($errors) > 0) {
        $("#add").modal('show');
    }
</script>
<?= $this->endSection();?>