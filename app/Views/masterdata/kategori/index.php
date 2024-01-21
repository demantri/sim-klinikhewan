<?= $this->extend('layouts/app');?>

<?= $this->section('page_title');?>
Kategori
<?= $this->endSection();?>

<?= $this->section('content');?>

<?php 
    $validation = \Config\Services::validation();
?>

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
                            <th class="text-center">#</th>
                            <th class="text-center">Jenis Kategori</th>
                            <th class="text-center">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach ($kategori as $item) : ?>
                        <tr>
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-light btn-edit mr-2" 
                                    data-toggle="modal" 
                                    data-target="#edit"
                                    data-id="<?= $item->id?>"
                                    data-jenis="<?= $item->jenis?>"
                                    data-deskripsi="<?= $item->deskripsi?>"
                                    ><i class="fa-solid fa-pencil"></i></button>

                                    <a href="<?= base_url('masterdata/kategori/hapus/' . $item->id)?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-outline-danger"
                                    ><i class="fa-solid fa-trash"></i></a>
                                </div>
                            </td>
                            <td><?= $no++ ?></td>
                            <td><?= $item->jenis ?></td>
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
            <form action="<?= base_url('masterdata/kategori/simpan')?>" method="post">
                <div class="card-header">
                    <h4>Form Tambah</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Jenis Kategori</label>
                        <select name="jenis" id="jenis" class="form-control <?= $validation->hasError('jenis') ? 'is-invalid' : ''?>">
                            <option value="" disabled selected>- Pilih -</option>
                            <option value="spesies" <?= set_select('jenis', 'spesies')?>>Spesies</option>
                            <option value="ras" <?= set_select('jenis', 'ras')?>>Ras</option>
                        </select>
                        <?php if ($validation->getError('jenis')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('jenis'); ?>
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
    <?= $this->include('masterdata/kategori/edit');?>
<?= $this->endSection();?>

<?= $this->section('script');?>
<script>

    $(document).on("click", ".btn-edit", function() {
        let id = $(this).data("id");
        let jenis = $(this).data("jenis");
        let deskripsi = $(this).data("deskripsi");

        $("#id_edit").val(id);
        $("#jenis_edit").val(jenis);
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