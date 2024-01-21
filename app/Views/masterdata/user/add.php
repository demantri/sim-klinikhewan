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
            <form action="<?= base_url('masterdata/user/simpan')?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input id="nama_lengkap" type="text" class="form-control" name="nama_lengkap" value="<?= set_value('nama_lengkap') ?>" placeholder="Masukan nama lengkap" autofocus>
                            <?php if(isset($validation)):?>
                                <small class="text-danger"><?= $validation->getError('nama_lengkap') ?></small>
                            <?php endif;?>
                        </div>

                        <div class="form-group col-6">
                            <label for="no_telp">No telp</label>
                            <input id="no_telp" type="text" class="form-control telp" name="no_telp" value="<?= set_value('no_telp') ?>" placeholder="Masukan no telp" autofocus>
                            <?php if(isset($validation)):?>
                                <small class="text-danger"><?= $validation->getError('no_telp') ?></small>
                            <?php endif;?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-3">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control">
                                <option value="" disabled selected>- Pilih -</option>
                                <option value="admin"<?= set_select('role', 'admin')?>>Admin</option>
                                <option value="dokter"<?= set_select('role', 'dokter')?>>Dokter</option>
                                <option value="kasir"<?= set_select('role', 'kasir')?>>Kasir</option>
                                <option value="customer"<?= set_select('role', 'customer')?>>Customer</option>
                            </select>
                            <?php if(isset($validation)):?>
                                <small class="text-danger"><?= $validation->getError('role') ?></small>
                            <?php endif;?>
                        </div>

                        <div class="form-group col-3">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                <option value="" disabled selected>- Pilih -</option>
                                <option value="L"<?= set_select('jenis_kelamin', 'L')?>>Laki-laki</option>
                                <option value="P"<?= set_select('jenis_kelamin', 'P')?>>Perempuan</option>
                            </select>
                            <?php if(isset($validation)):?>
                                <small class="text-danger"><?= $validation->getError('jenis_kelamin') ?></small>
                            <?php endif;?>
                        </div>

                        <div class="form-group col-6">
                            <label for="alamat">Alamat</label>
                            <input id="alamat" type="text" class="form-control" name="alamat" value="<?= set_value('alamat') ?>" placeholder="Masukan alamat lengkap">
                            <?php if(isset($validation)):?>
                                <small class="text-danger"><?= $validation->getError('alamat') ?></small>
                            <?php endif;?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="username">Username</label>
                            <input id="username" type="text" class="form-control" name="username" value="<?= set_value('username') ?>" placeholder="Masukan username">
                            <?php if(isset($validation)):?>
                                <small class="text-danger"><?= $validation->getError('username') ?></small>
                            <?php endif;?>
                        </div>

                        <div class="form-group col-6">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control" name="email" value="<?= set_value('email') ?>" placeholder="Masukan email">
                            <?php if(isset($validation)):?>
                                <small class="text-danger"><?= $validation->getError('email') ?></small>
                            <?php endif;?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="password" class="d-block">Password</label>
                            <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" placeholder="Masukan password">
                            <?php if(isset($validation)):?>
                                <small class="text-danger"><?= $validation->getError('password') ?></small>
                            <?php endif;?>
                            <div id="pwindicator" class="pwindicator">
                                <div class="bar"></div>
                                <div class="label"></div>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="password2" class="d-block">Konfirmasi Password</label>
                            <input id="password2" type="password" class="form-control" name="confirm_password" placeholder="Masukan password sebelumnya">
                            <?php if(isset($validation)):?>
                                <small class="text-danger"><?= $validation->getError('confirm_password') ?></small>
                            <?php endif;?>
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