<?= $this->extend('layouts/app');?>

<?= $this->section('page_title');?>
Hewan
<?= $this->endSection();?>

<?= $this->section('content');?>

<?php 
    $validation = \Config\Services::validation();
    $errors = $validation->getErrors();
?>

<?php if (!empty(session()->getFlashdata('error'))) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h5>Periksa Entrian Form</h5>
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
    <div class="col-sm-12 col-md-12">

        <div class="mb-3">
            <button class="btn btn-primary" data-target="#add" data-toggle="modal">
                Tambah Data
            </button>
        </div>

        <div class="card card-primary">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center"></th>
                                <th class="text-center">No</th>
                                <th class="text-center">ID Hewan</th>
                                <th class="text-center">Nama Peliharaan</th>
                                <th class="text-center">Tanggal Lahir</th>
                                <th class="text-center">Jenis Kelamin</th>
                                <th class="text-center">Warna</th>
                                <th class="text-center">Postur</th>
                                <th class="text-center">Spesies</th>
                                <th class="text-center">Ras</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($list as $item) : ?>
                            <tr>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-light btn-edit mr-2" 
                                        data-toggle="modal" 
                                        data-target="#edit"
                                        data-id="<?= $item->id_hewan?>"
                                        ><i class="fa-solid fa-pencil"></i></button>
    
                                        <!-- <a href="<?= base_url('masterdata/hewan/hapus/' . $item->id_hewan)?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-outline-danger"
                                        ><i class="fa-solid fa-trash"></i></a> -->

                                        <a href="javascript:void(0)" onclick="hapusData('<?= $item->id_hewan ?>')" class="btn btn-outline-danger btn-sm">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                                <td><?= $no++ ?></td>
                                <td><?= $item->id_hewan ?></td>
                                <td><?= $item->nama ?></td>
                                <td><?= $item->tanggal_lahir ?></td>
                                <td><?= $item->jenis_kelamin ?></td>
                                <td><?= $item->warna ?></td>
                                <td><?= $item->postur ?></td>
                                <td><?= $item->spesies ?></td>
                                <td><?= $item->ras ?></td>
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
    <?= $this->include('masterdata/hewan/add');?>
    <?= $this->include('masterdata/hewan/edit');?>
<?= $this->endSection();?>

<?= $this->section('script');?>
<script>
    function hapusData(kode) {
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
                    url: '<?= base_url('masterdata/hewan/hapus/') ?>' + kode,
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
        let id = $(this).data("id");
        $.ajax({
            url: "<?= base_url('masterdata/hewan/getData')?>",
            type: "post",
            dataType: "json",
            data: {
                id_hewan : id
            },
            success: function(response) {
                let data = response;
                $("#id_hewan_edit").val(data.id_hewan);
                $("#nama_peliharaan_edit").val(data.nama);
                $("#tanggal_lahir_edit").val(data.tanggal_lahir);
                $("#jenis_kelamin_edit").val(data.jenis_kelamin);
                $("#warna_edit").val(data.warna);
                $("#postur_edit").val(data.postur);
                $("#spesies_edit").val(data.spesies);
                $("#ras_edit").val(data.ras);
            }
        });
    });
    
    $(document).ready(function() {
        // $("#table").DataTable({
        //     destroy: true,
        //     scrollX: true,
        //     columnDefs: [{
        //         orderable: false,
        //         // className: 'select-checkbox',
        //         targets:   0
        //     }],
        //     order: [[ 1, "asc" ]],
        // });

        $("#table").DataTable({
            order: [[ 1, "asc" ]],
            pageLength : 5,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']]
        });

        $("#tanggal_lahir").datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });
</script>
<?= $this->endSection();?>