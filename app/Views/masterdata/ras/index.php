<?= $this->extend('layouts/app');?>

<?= $this->section('page_title');?>
Kategori
<?= $this->endSection();?>

<?= $this->section('content');?>

<?php 
    $validation = \Config\Services::validation();
    $errors = $validation->getErrors();
?>

<?php if (count($errors) > 0) : ?>
    <div class="alert alert-danger" role="alert">
        <?= $validation->listErrors(); ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success notif" role="alert"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="row">
    <div class="col-sm-8">
        <div class="card card-primary">
            <div class="card-body">
                <table class="table table-bordered" id="table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center">No</th>
                            <th class="text-center">ID Ras</th>
                            <th class="text-center">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach ($ras as $item) : ?>
                        <tr>
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-light btn-edit mr-2" 
                                    data-toggle="modal" 
                                    data-target="#edit"
                                    data-id="<?= $item->id_ras?>"
                                    data-deskripsi="<?= $item->deskripsi?>"
                                    ><i class="fa-solid fa-pencil"></i></button>

                                    <a href="<?= base_url('masterdata/ras/hapus/' . $item->id_ras)?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-outline-danger"
                                    ><i class="fa-solid fa-trash"></i></a>
                                </div>
                            </td>
                            <td><?= $no++ ?></td>
                            <td><?= $item->id_ras ?></td>
                            <td><?= $item->deskripsi ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card card-primary">
            <form action="<?= base_url('masterdata/ras/simpan')?>" method="post">
                <div class="card-header">
                    <h4>Form Tambah</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>ID Ras</label>
                        <input name="id_ras" id="id_ras" class="form-control <?= $validation->hasError('id_ras') ? 'is-invalid' : ''?>" value="<?= $kode ?>" readonly>
                        <?php if ($validation->getError('id_ras')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('id_ras'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <input name="deskripsi" id="deskripsi" class="form-control <?= $validation->hasError('deskripsi') ? 'is-invalid' : ''?>" placeholder="Masukan Deskripsi" value="<?= set_value('deskripsi') ?>">
                        <?php if ($validation->getError('deskripsi')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('deskripsi'); ?>
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
    <?= $this->include('masterdata/ras/edit');?>
<?= $this->endSection();?>

<?= $this->section('script');?>
<script>

    $(document).on("click", ".btn-edit", function() {
        let id = $(this).data("id");
        let deskripsi = $(this).data("deskripsi");

        $("#id_edit").val(id);
        $("#deskripsi_edit").val(deskripsi);
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
    });
</script>
<?= $this->endSection();?>