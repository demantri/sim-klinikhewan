<?php 
    $validation = \Config\Services::validation();
?>

<div class="modal fade" id="detail_pendaftaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detail_header"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('masterdata/user/update')?>" method="post">
                <div class="modal-body">
                    <table class="table table-bordered" style="width: 100%;" id="table-detail">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Peliharaan</th>
                                <th>Jenis Kelamin</th>
                                <th>Jenis Peliharaan</th>
                                <th>Warna</th>
                                <th>Postur</th>
                                <th>Tanggal Lahir</th>
                            </tr>
                        </thead>
                        <tbody id="tbody"></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>