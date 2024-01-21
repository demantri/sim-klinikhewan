<?php 
    $validation = \Config\Services::validation();
?>

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('masterdata/user/update')?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="id_user_edit" name="id_user_edit">
                        <div class="form-group col-6">
                            <label for="">Nama Lengkap</label>
                            <input id="nama_lengkap_edit" type="text" class="form-control" name="nama_lengkap_edit" value="<?= set_value('nama_lengkap') ?>" placeholder="Masukan nama lengkap" autofocus>
                            <?php if(isset($validation)):?>
                                <small class="text-danger"><?= $validation->getError('nama_lengkap') ?></small>
                            <?php endif;?>
                        </div>

                        <div class="form-group col-6">
                            <label for="">No telp</label>
                            <input id="no_telp_edit" type="text" class="form-control telp" name="no_telp_edit" value="<?= set_value('no_telp') ?>" placeholder="Masukan no telp" autofocus>
                            <?php if(isset($validation)):?>
                                <small class="text-danger"><?= $validation->getError('no_telp') ?></small>
                            <?php endif;?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-3">
                            <label for="">Role</label>
                            <select name="role_edit" id="role_edit" class="form-control">
                                <option value="" disabled selected>- Pilih -</option>
                                <option value="admin">Admin</option>
                                <option value="dokter">Dokter</option>
                                <option value="kasir">Kasir</option>
                                <option value="customer">Customer</option>
                            </select>
                            <?php if(isset($validation)):?>
                                <small class="text-danger"><?= $validation->getError('role') ?></small>
                            <?php endif;?>
                        </div>

                        <div class="form-group col-3">
                            <label for="">Jenis Kelamin</label>
                            <select name="jenis_kelamin_edit" id="jenis_kelamin_edit" class="form-control">
                                <option value="" disabled selected>- Pilih -</option>
                                <option value="L"<?= set_select('jenis_kelamin', 'L')?>>Laki-laki</option>
                                <option value="P"<?= set_select('jenis_kelamin', 'P')?>>Perempuan</option>
                            </select>
                            <?php if(isset($validation)):?>
                                <small class="text-danger"><?= $validation->getError('jenis_kelamin') ?></small>
                            <?php endif;?>
                        </div>

                        <div class="form-group col-6">
                            <label for="">Alamat</label>
                            <input id="alamat_edit" type="text" class="form-control" name="alamat_edit" value="<?= set_value('alamat') ?>" placeholder="Masukan alamat lengkap">
                            <?php if(isset($validation)):?>
                                <small class="text-danger"><?= $validation->getError('alamat') ?></small>
                            <?php endif;?>
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