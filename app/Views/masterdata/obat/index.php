<?= $this->extend('layouts/app');?>

<?= $this->section('page_title');?>
Obat
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
    <div class="col-sm-8">
        <div class="card card-primary">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center"></th>
                                <th class="text-center">#</th>
                                <th class="text-center">ID Obat</th>
                                <th class="text-center">Nama Obat</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Jumlah Resep</th>
                                <th class="text-center">Tgl Expired</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($obat as $item) : ?>
                            <tr>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-light btn-sm btn-edit mr-2" 
                                        data-toggle="modal" 
                                        data-target="#edit"
                                        data-id_obat="<?= $item->id_obat ?>"
                                        data-nama_obat="<?= $item->nama_obat ?>"
                                        data-harga="<?= $item->harga ?>"
                                        data-stok="<?= $item->resep ?>"
                                        data-tgl_expired="<?= $item->tgl_expired ?>"
                                        ><i class="fa-solid fa-pencil"></i></button>
    
                                        <!-- <a href="<?= base_url('masterdata/obat/hapus/' . $item->id)?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-outline-danger btn-sm"
                                        ><i class="fa-solid fa-trash"></i></a> -->

                                        <a href="javascript:void(0)" onclick="hapusData('<?= $item->id ?>')" class="btn btn-outline-danger btn-sm">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                                <td><?= $no++ ?></td>
                                <td><?= $item->id_obat ?></td>
                                <td><?= $item->nama_obat ?></td>
                                <td><?= number_format($item->harga,0,',','.') ?></td>
                                <td><?= $item->resep ?></td>
                                <td><?= $item->tgl_expired ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card card-primary">
            <form action="<?= base_url('masterdata/obat/simpan')?>" method="post">
                <div class="card-header">
                    <h4>Form Tambah</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>ID Obat</label>
                        <input type="text" name="id_obat" id="id_obat" class="form-control" value="<?= $kode ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Obat</label>
                        <input type="text" name="nama_obat" id="nama_obat" class="form-control <?= $validation->hasError('nama_obat') ? 'is-invalid' : ''?>" placeholder="Masukan nama obat" value="<?= set_value('nama_obat') ?>">
                        <?php if ($validation->getError('nama_obat')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_obat'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input name="harga" id="harga" class="form-control money <?= $validation->hasError('harga') ? 'is-invalid' : ''?>" placeholder="Masukan harga" value="<?= set_value('harga') ?>">
                        <?php if ($validation->getError('harga')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('harga'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Resep</label>
                        <input name="stok" id="stok" class="form-control numeric <?= $validation->hasError('stok') ? 'is-invalid' : ''?>" placeholder="Masukan jumlah resep" value="<?= set_value('stok') ?>">
                        <?php if ($validation->getError('stok')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('stok'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Tgl Expired</label>
                        <input type="date" name="tgl_expired" id="tgl_expired" class="form-control <?= $validation->hasError('tgl_expired') ? 'is-invalid' : ''?>" value="<?= set_value('tgl_expired') ?>">
                        <?php if ($validation->getError('tgl_expired')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('tgl_expired'); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection();?>

<?= $this->section('modal');?>
    <?= $this->include('masterdata/obat/edit');?>
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
                    url: '<?= base_url('masterdata/obat/hapus/') ?>' + kode,
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
        let id_obat = $(this).data("id_obat");
        let nama_obat = $(this).data("nama_obat");
        let harga = $(this).data("harga");
        let stok = $(this).data("stok");
        let tgl_expired = $(this).data("tgl_expired");

        $("#id_obat_edit").val(id_obat);
        $("#nama_obat_edit").val(nama_obat);
        $("#harga_edit").val(numerFormat(harga));
        $("#stok_edit").val(stok);
        $("#tgl_expired_edit").val(tgl_expired);
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
    });
</script>
<?= $this->endSection();?>