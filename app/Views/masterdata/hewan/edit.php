<?php 
    $validation = \Config\Services::validation();
?>

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('masterdata/hewan/update')?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>ID Hewan</label>
                            <input name="id_hewan_edit" id="id_hewan_edit" class="form-control <?= $validation->hasError('id_hewan_edit') ? 'is-invalid' : ''?>" value="<?= $kode ?>" readonly>
                            <?php if ($validation->getError('id_hewan_edit')) { ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('id_hewan_edit'); ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Nama Peliharaan</label>
                            <input name="nama_peliharaan_edit" id="nama_peliharaan_edit" class="form-control <?= $validation->hasError('nama_peliharaan_edit') ? 'is-invalid' : ''?>" placeholder="Masukan nama peliharaan" value="<?= set_value('nama_peliharaan_edit') ?>">
                            <?php if ($validation->getError('nama_peliharaan_edit')) { ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nama_peliharaan_edit'); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Tanggal Lahir</label>
                            <input name="tanggal_lahir_edit" id="tanggal_lahir_edit" class="form-control <?= $validation->hasError('tanggal_lahir_edit') ? 'is-invalid' : ''?>" placeholder="Masukan tanggal lahir" value="<?= set_value('tanggal_lahir_edit') ?>">
                            <?php if ($validation->getError('tanggal_lahir_edit')) { ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('tanggal_lahir_edit'); ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin_edit" id="jenis_kelamin_edit" class="form-control">
                                <option value="" disabled selected>- Pilih Jenis Kelamin-</option>
                                <option value="Betina"<?= set_select('jenis_kelamin_edit', 'Betina')?>>Betina</option>
                                <option value="Jantan"<?= set_select('jenis_kelamin_edit', 'Jantan')?>>Jantan</option>
                            </select>
                            <?php if ($validation->getError('jenis_kelamin_edit')) { ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('jenis_kelamin_edit'); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Warna</label>
                            <input name="warna_edit" id="warna_edit" class="form-control <?= $validation->hasError('warna_edit') ? 'is-invalid' : ''?>" placeholder="Masukan warna" value="<?= set_value('warna_edit') ?>">
                            <?php if ($validation->getError('warna_edit')) { ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('warna_edit'); ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Postur</label>
                            <input name="postur_edit" id="postur_edit" class="form-control <?= $validation->hasError('postur_edit') ? 'is-invalid' : ''?>" placeholder="Masukan postur" value="<?= set_value('postur_edit') ?>">
                            <?php if ($validation->getError('postur_edit')) { ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('postur_edit'); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Spesies</label>
                            <input name="spesies_edit" id="spesies_edit" class="form-control <?= $validation->hasError('spesies_edit') ? 'is-invalid' : ''?>" placeholder="Masukan spesies" value="<?= set_value('spesies_edit') ?>">
                            <?php if ($validation->getError('spesies_edit')) { ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('spesies_edit'); ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Ras</label>
                            <input name="ras_edit" id="ras_edit" class="form-control <?= $validation->hasError('ras_edit') ? 'is-invalid' : ''?>" placeholder="Masukan ras" value="<?= set_value('ras_edit') ?>">
                            <?php if ($validation->getError('ras_edit')) { ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('ras_edit'); ?>
                                </div>
                            <?php } ?>
                        </div>
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