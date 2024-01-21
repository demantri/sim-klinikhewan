<?php 
    $validation = \Config\Services::validation();
?>

<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('masterdata/hewan/simpan')?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>ID Hewan</label>
                            <input name="id_hewan" id="id_hewan" class="form-control <?= $validation->hasError('id_hewan') ? 'is-invalid' : ''?>" value="<?= $kode ?>" readonly>
                            <?php if ($validation->getError('id_hewan')) { ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('id_hewan'); ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Nama Peliharaan</label>
                            <input name="nama_peliharaan" id="nama_peliharaan" class="form-control <?= $validation->hasError('nama_peliharaan') ? 'is-invalid' : ''?>" placeholder="Masukan nama peliharaan" value="<?= set_value('nama_peliharaan') ?>">
                            <?php if ($validation->getError('nama_peliharaan')) { ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nama_peliharaan'); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Tanggal Lahir</label>
                            <input name="tanggal_lahir" id="tanggal_lahir" class="form-control <?= $validation->hasError('tanggal_lahir') ? 'is-invalid' : ''?>" placeholder="Masukan tanggal lahir" value="<?= set_value('tanggal_lahir') ?>">
                            <?php if ($validation->getError('tanggal_lahir')) { ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('tanggal_lahir'); ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                <option value="" disabled selected>- Pilih Jenis Kelamin-</option>
                                <option value="Betina"<?= set_select('jenis_kelamin', 'Betina')?>>Betina</option>
                                <option value="Jantan"<?= set_select('jenis_kelamin', 'Jantan')?>>Jantan</option>
                            </select>
                            <?php if ($validation->getError('jenis_kelamin')) { ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('jenis_kelamin'); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Warna</label>
                            <input name="warna" id="warna" class="form-control <?= $validation->hasError('warna') ? 'is-invalid' : ''?>" placeholder="Masukan warna" value="<?= set_value('warna') ?>">
                            <?php if ($validation->getError('warna')) { ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('warna'); ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Postur</label>
                            <input name="postur" id="postur" class="form-control <?= $validation->hasError('postur') ? 'is-invalid' : ''?>" placeholder="Masukan postur" value="<?= set_value('postur') ?>">
                            <?php if ($validation->getError('postur')) { ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('postur'); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Spesies</label>
                            <input name="spesies" id="spesies" class="form-control <?= $validation->hasError('spesies') ? 'is-invalid' : ''?>" placeholder="Masukan spesies" value="<?= set_value('spesies') ?>">
                            <?php if ($validation->getError('spesies')) { ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('spesies'); ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Ras</label>
                            <input name="ras" id="ras" class="form-control <?= $validation->hasError('ras') ? 'is-invalid' : ''?>" placeholder="Masukan ras" value="<?= set_value('ras') ?>">
                            <?php if ($validation->getError('ras')) { ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('ras'); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>