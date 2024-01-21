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
            <form action="<?= base_url('masterdata/kategori/update')?>" method="post">
                <div class="modal-body">
                    <input type="hidden" id="id_edit" name="id">
                    <div class="form-group">
                        <label>Jenis Kategori</label>
                        <select name="jenis" id="jenis_edit" class="form-control" required>
                            <option value="" disabled selected>- Pilih -</option>
                            <option value="spesies">Spesies</option>
                            <option value="ras">Ras</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <input name="deskripsi" id="deskripsi_edit" class="form-control" placeholder="Masukan Deskripsi" required>
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