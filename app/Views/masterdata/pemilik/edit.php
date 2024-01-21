<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Data Pemilik</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('masterdata/pemilik/update')?>" method="post">
                <div class="modal-body">
                    <input type="text" id="id_edit" name="id">
                    <div class="form-group">
                        <label>ID Pemilik</label>
                        <input type="text" name="id_pemilik_edit" id="id_pemilik_edit" class="form-control" value="<?= $kode ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Pemilik</label>
                        <input type="text" name="nama_edit" id="nama_edit" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label>No Telfon</label>
                        <input type="text" name="no_telp_edit" id="no_telp_edit" class="form-control telp" required="">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat_edit" id="alamat_edit" cols="10" rows="5" class="form-control" required=""></textarea>
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