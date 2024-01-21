<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Data Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('masterdata/dokter/update')?>" method="post">
                <div class="modal-body">
                    <input type="hidden" id="id_edit" name="id">
                    <div class="form-group">
                        <label>ID Dokter</label>
                        <input type="text" class="form-control" name="id_dokter" id="id_dokter_edit" value="<?= $kode ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input name="nama_lengkap_edit" id="nama_lengkap_edit" class="form-control" placeholder="Masukan nama lengkap">
                        <?php if(isset($validation)):?>
                            <small class="text-danger"><?= $validation->getError('nama_lengkap_edit') ?></small>
                        <?php endif;?>
                    </div>
                    <div class="form-group">
                        <label>No Telp</label>
                        <input name="no_telp_edit" id="no_telp_edit" class="form-control telp" placeholder="Masukan no telp">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin_edit" id="jenis_kelamin_edit" class="form-control">
                            <option value="" disabled selected>- Pilih -</option>
                            <option value="L" <?= set_select('jenis_kelamin', 'L')?>>Laki laki</option>
                            <option value="P" <?= set_select('jenis_kelamin', 'P')?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input name="alamat_edit" id="alamat_edit" class="form-control" placeholder="Masukan alamat">
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