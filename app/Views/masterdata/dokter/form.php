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