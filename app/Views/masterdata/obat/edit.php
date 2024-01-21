<!-- Modal -->
<?php 
    $validation = \Config\Services::validation();
?>

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Data Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('masterdata/obat/update')?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>ID Obat</label>
                        <input type="text" name="id_obat_edit" id="id_obat_edit" class="form-control" value="<?= $kode ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Obat</label>
                        <input type="text" name="nama_obat_edit" id="nama_obat_edit" class="form-control <?= $validation->hasError('nama_obat') ? 'is-invalid' : ''?>" placeholder="Masukan nama obat" value="<?= set_value('nama_obat') ?>">
                        <?php if ($validation->getError('nama_obat')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_obat'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input name="harga_edit" id="harga_edit" class="form-control money <?= $validation->hasError('harga') ? 'is-invalid' : ''?>" placeholder="Masukan harga" value="<?= set_value('harga') ?>">
                        <?php if ($validation->getError('harga')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('harga'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Stok</label>
                        <input name="stok_edit" id="stok_edit" class="form-control numeric <?= $validation->hasError('stok') ? 'is-invalid' : ''?>" placeholder="Masukan stok" value="<?= set_value('stok') ?>">
                        <?php if ($validation->getError('stok')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('stok'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Tgl Expired</label>
                        <input type="date" name="tgl_expired_edit" id="tgl_expired_edit" class="form-control <?= $validation->hasError('tgl_expired') ? 'is-invalid' : ''?>" value="<?= set_value('tgl_expired') ?>">
                        <?php if ($validation->getError('tgl_expired')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('tgl_expired'); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>