<?= $this->extend('layouts/app');?>

<?= $this->section('page_title');?>
Pembayaran
<?= $this->endSection();?>

<?= $this->section('content');?>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success notif" role="alert"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <button class="btn btn-primary mb-3" onclick="modalPembayaran()" type="button">
                <i class="fas fa-plus"></i>
                Input Pembayaran
            </button>
            <div class="card card-primary">
                <div class="card-body">
                    <table class="table table-bordered" id="table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">ID Ambulator</th>
                                <th class="text-center">ID Transaksi</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Nama Customer</th>
                                <th class="text-center">Nama Dokter</th>
                                <th class="text-center">Jasa Dokter</th>
                                <th class="text-center">Total Transaksi Obat</th>
                                <th class="text-center">Grand Total</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($trx as $row) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row->id_ambulator ?></td>
                                <td><?= $row->id_transaksi ?></td>
                                <td><?= date('d-m-Y', strtotime($row->tgl_transaksi)) ?></td>
                                <td><?= $row->nama_customer ?></td>
                                <td><?= $row->nama_dokter ?></td>
                                <td class="text-right"><?= number_format($row->jasa_dokter, 0, ',', '.') ?></td>
                                <td class="text-right"><?= number_format($row->total_transaksi, 0, ',', '.') ?></td>
                                <td class="text-right"><?= number_format($row->grand_total, 0, ',', '.') ?></td>
                                <td>
                                    <?php if ($row->status == 0) { ?>
                                        <button 
                                            class="btn-bayar btn btn-sm btn-outline-success"
                                            data-id="<?= $row->id_transaksi ?>"    
                                        >Bayar</button>
                                    <?php } else { ?>
                                        <button class="btn btn-success btn-sm" type="button">Terbayar</button>
                                    <?php } ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($row->status == 1) { ?>
                                        <a href="<?= base_url('rekam-medis/pembayaran/cetak/' . $row->id_ambulator )?>" class="btn btn-sm btn-light">
                                            <i class="fa fa-print"></i>
                                            Cetak Invoice
                                        </a>
                                    <?php } else { ?>
                                        <a href="javascript:void(0);">-</a>
                                    <?php } ?>
                                    
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection();?>

<?= $this->section('modal');?>
<!-- Modal -->
<div class="modal fade" id="modal_pembayaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="">
                <div class="modal-body">
                    <div class="form-group">
                        <label>ID Transaksi</label>
                        <select name="id_transaksi" id="id_transaksi" class="form-control id_transaksi" style="width: 100%;" multiple>
                            <option value=""></option>
                            <?php foreach ($transaksi as $item) { ?>
                            <option value="<?= $item->id_transaksi ?>"><?= $item->id_transaksi ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="">
                    <button class="btn btn-light mb-3 btn-sm" type="button" id="btnReset">
                        Reset
                    </button>
                    <button class="btn btn-primary mb-3 btn-sm" onclick="simpanDetail()" type="button" id="btn-lanjutkan">
                        Lanjutkan
                    </button>
                    </div>
                    <div class="form-group">
                        <label>Total Transaksi</label>
                        <input type="text" value="0" name="total_transaksi" id="total_transaksi" class="form-control" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" id="btn-submit" type="button" disabled>Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection();?>

<?= $this->section('script');?>
<script>
    $(document).on("click", "#btnReset", function() {
        $.ajax({
            url: '<?= base_url('rekam-medis/pembayaran/reset')?>',
            type: 'post',
            dataType: 'json',
            // beforeSend: function() {
            //     $.blockUI({ 
            //         message: '<h4>Please wait...</h4>',
            //         baseZ: 2000,
            //         css: { 
            //             border: 'none', 
            //             padding: '15px', 
            //             backgroundColor: '#000', 
            //             '-webkit-border-radius': '10px', 
            //             '-moz-border-radius': '10px', 
            //             // opacity: .5, 
            //             color: '#fff'
            //         }
            //     }); 
            // },
            data: {
                id_trx : $(".id_transaksi").val()
            },
            success: function(response) {
                $.unblockUI();
                swal('', response.msg, 'success');
                location.reload();
            }
        });
    })
    function simpanDetail() {
        swal({
            title: "",
            text: "Apakah anda sudah yakin?",
            icon: "warning",
            buttons: true,
            // dangerMode: true,
        }).then((isConfirm) => {
            if (isConfirm) {
                addDetail();
            }
        });
    }

    function addDetail() {
        if ($(".id_transaksi").val() == '' || $(".id_transaksi").val() == null) {
            swal('Gagal', 'ID Transaksi tidak boleh kosong!', 'warning')
        } else {
            $.ajax({
                url: '<?= base_url('rekam-medis/pembayaran/add-to-detail')?>',
                type: 'post',
                dataType: 'json',
                beforeSend: function() {
                    $.blockUI({ 
                        message: '<h4>Please wait...</h4>',
                        baseZ: 2000,
                        css: { 
                            border: 'none', 
                            padding: '15px', 
                            backgroundColor: '#000', 
                            '-webkit-border-radius': '10px', 
                            '-moz-border-radius': '10px', 
                            // opacity: .5, 
                            color: '#fff'
                        }
                    }); 
                },
                data: {
                    id_trx : $(".id_transaksi").val()
                },
                success: function(response) {
                    $.unblockUI();
                    swal('', response.msg, 'success');
                    $("#btn-lanjutkan").prop("disabled", true);
                    $("#id_transaksi").select2({
                        disabled: true
                    });
                    $("#total_transaksi").val(response.data.grandtotal);
                    $("#btn-submit").prop("disabled", false);
                    $("#btnReset").prop("disabled", false);
                }
            });
        }
    }

    function processMultiple() {
        $.ajax({
            url: '<?= base_url('rekam-medis/pembayaran/multiple')?>',
            type: 'post',
            dataType: 'json',
            data: {
                id_trx : $(".id_transaksi").val()
            },
            beforeSend: function() {
                $.blockUI({ 
                    message: '<h4>Please wait...</h4>',
                    baseZ: 2000,
                    css: { 
                        border: 'none', 
                        padding: '15px', 
                        backgroundColor: '#000', 
                        '-webkit-border-radius': '10px', 
                        '-moz-border-radius': '10px', 
                        // opacity: .5, 
                        color: '#fff'
                    }
                }); 
            },
            success: function(response) {
                $.unblockUI();
                swal({
                    title: 'Berhasil!',
                    text: response.msg,
                    icon: 'success',
                }).then(function() {
                    location.reload();
                })
            }
        });
    }

    function modalPembayaran() {
        $("#modal_pembayaran").modal("show");

        $("#id_transaksi").on("change", function() {
            let value = $(this).val();
        })
    }

    function prosesSimpan(id_trx) {
        $.ajax({
            url: '<?= base_url('rekam-medis/pembayaran/bayar')?>',
            type: 'post',
            dataType: 'json',
            data: {
                id_trx : id_trx
            },
            success: function(response) {
                swal({
                    title: 'Berhasil!',
                    text: response.msg,
                    icon: 'success',
                }).then(function() {
                    location.reload();
                    // window.location.href = '<?= base_url('rekam-medis/view') ?>';
                })
            }  
        });
    }

    $(document).on("click", ".btn-bayar", function(e) {
        e.preventDefault();
        let id_trx = $(this).data('id');
        swal({
            text: "Apakah anda yakin?",
            icon: "info",
            buttons: {
                confirm: {
                    text: 'Bayar',
                    value: 'selesai',
                },
                // print: {
                //     text: 'Bayar & print',
                //     value: 'selesai_print',
                // }
            },
        }).then((value) => {
            if (value == 'selesai') {
                prosesSimpan(id_trx);
            } 
            // else if (value == 'selesai_print') {
            //     prosesSimpanPrint();
            // }
        });
    });

    $(document).ready(function() {
        $("#btnReset").prop("disabled", true);

        $("#table").DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf'
            ]
        });

        $("#id_transaksi").select2({
            dropdownParent: $("#modal_pembayaran"),
            placeholder: "- Pilih -"
        });

        $("#btn-submit").on("click", function(e) {
            swal({
                title: "",
                text: "Data yang tersimpan tidak bisa dikembalikan, apakah anda yakin?",
                icon: "warning",
                buttons: true,
                // dangerMode: true,
            }).then((isConfirm) => {
                if (isConfirm) {
                    processMultiple();
                }
            });
        });
    });
</script>
<?= $this->endSection();?>