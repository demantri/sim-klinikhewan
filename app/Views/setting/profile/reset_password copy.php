<?php 
    $validation = \Config\Services::validation();
?>

<div class="modal fade" id="reset-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detail_header">Reset Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formReset" method="post">
                <div class="modal-body">
                    <input type="hidden" id="id_user_reset" name="id_user_reset">
                    <div class="form-group" id="content_password_lama">
                        <label>Password Lama</label>
                        <input type="password" class="form-control" name="password_lama" id="password_lama" placeholder="Masukan password lama" autocomplete required>
                        <div class="invalid-feedback">
                            Please fill in the first name
                        </div>
                    </div>

                    <div id="content_reset_password" class="d-none">
                        <div class="form-group">
                            <label>Password Baru</label>
                            <input type="password" class="form-control" name="password_baru" id="password_baru" placeholder="Masukan password baru" autocomplete required>
                            <div class="invalid-feedback">
                                Please fill in the first name
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Password</label>
                            <input type="password" class="form-control" name="konfirmasi_password" id="konfirmasi_password" placeholder="Konfirmasi password" required>
                            <div class="invalid-feedback">
                                Please fill in the first name
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" id="btn-proses">Proses</button>
                    <button type="submit" class="btn btn-light d-none" id="btn-simpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>