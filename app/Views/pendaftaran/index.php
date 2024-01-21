<?= $this->extend('layouts/app'); ?>

<?= $this->section('page_title'); ?>
Pendaftaran Peliharaan
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success notif" role="alert"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card card-primary">
            <div class="card-body">
                <a href="<?= base_url('pendaftaran/form/add') ?>" class="btn btn-primary mb-4">
                    Tambah Data
                </a>
                <table class="table table-bordered" id="table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center">#</th>
                            <th class="text-center">Tanggal Pendaftaran</th>
                            <th class="text-center">ID Pendaftaran</th>
                            <th class="text-center">Pemilik</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $no = 1;
                        foreach ($pendaftaran as $item) : ?>
                        <tr>
                            <?php
                            if ($item->status != 2) { ?>
                            <td class="text-center">
                                <button class="btn btn-sm btn-info btn-detail" data-toggle="modal" data-target="#detail_pendaftaran" data-id="<?= $item->id_pendaftaran ?>">Detail</button>
                                <a href="<?= base_url('pendaftaran/form/edit/' . $item->id_pendaftaran)?>" class="btn btn-sm btn-warning">Ubah Data</a>
                            </td>
                            <?php } else { ?>
                            <td></td>
                            <?php } ?>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= date('d-m-Y H:i:s', strtotime($item->created_at)) ?></td>
                            <td><?= $item->id_pendaftaran ?></td>
                            <td><?= $item->nama_lengkap ?></td>
                            <td class="text-center">
                                <?php if ($item->status == 1) { ?>
                                    <span class="badge badge-success">Pendaftaran Sukses</span>
                                <?php } else if ($item->status == 2) { ?>
                                    <span class="badge badge-danger">Pendaftaran Batal</span>
                                <?php } else { ?>
                                    <span class="badge badge-warning">Pendaftaran Sedang Berlangsung</span>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('modal');?>
    <?= $this->include('pendaftaran/detail');?>
<?= $this->endSection();?>

<?= $this->section('script'); ?>
<script>
    $(document).on("click", ".btn-detail", function(e) {
        let id_pendaftaran = $(this).data('id');
        $.ajax({
            url: "<?= base_url('pendaftaran/getDetail')?>",
            type: "post",
            dataType: "json",
            data: {
                id_pendaftaran : id_pendaftaran
            },
            success: function(response) {
                let data = response;
                console.log();
                if ( $.fn.DataTable.isDataTable('table.table#table-detail') ) {
                    $('table.table#table-detail').DataTable().destroy();
                }
                
                if (data.length > 0) {
                    $("#detail_header").text("Detail #" + data[0].id_pendaftaran);
                    let no = 1;
                    let row = '';
                    for (let i = 0; i < data.length; i++) {
                        let jenis = data[i].spesies + ' - ' + data[i].ras;
                        row += `<tr>
                                    <td>${ no++ }</td>
                                    <td>${data[i].nama}</td>
                                    <td>${data[i].jenis_kelamin}</td>
                                    <td>${jenis}</td>
                                    <td>${data[i].warna}</td>
                                    <td>${data[i].postur}</td>
                                    <td>${data[i].tanggal_lahir}</td>
                                </tr>`;
                    }
                    $("#tbody").html(row);
                    $("#table-detail").DataTable({
                        destroy: true,
                        scrollX: true,
                        columnDefs: [{
                            orderable: false,
                            // className: 'select-checkbox',
                            targets:   0
                        }],
                        order: [[ 0, "asc" ]],
                        pageLength : 5,
                        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']]
                    });
                }
            }
        });
    });
    $(document).ready(function() {
        $("#table").DataTable({
            destroy: true,
            scrollX: true,
            columnDefs: [{
                orderable: false,
                // className: 'select-checkbox',
                targets: 0
            }],
            order: [
                [1, "asc"]
            ],
        });
    });
</script>
<?= $this->endSection(); ?>