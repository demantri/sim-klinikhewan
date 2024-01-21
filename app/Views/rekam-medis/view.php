<?= $this->extend('layouts/app');?>

<?= $this->section('page_title');?>
List Rekam Medis
<?= $this->endSection();?>

<?= $this->section('content');?>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success notif" role="alert"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-primary">
                <div class="card-body">
                    <table class="table table-bordered" id="table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">ID Rekam Medis</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Jasa Dokter</th>
                                <th class="text-center">Total Transaksi</th>
                                <th class="text-center">Grand Total</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($list as $row) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row->id_ambulator ?></td>
                                <td><?= date('d-m-Y', strtotime($row->tanggal)) ?></td>
                                <td class="text-right"><?= 'Rp. ' . number_format($row->jasa_dokter) ?></td>
                                <td class="text-right"><?= 'Rp. ' . number_format($row->total_transaksi) ?></td>
                                <td class="text-right"><?= 'Rp. ' . number_format($row->grand_total) ?></td>
                                <!-- <td class="text-center">
                                    <button class="btn btn-outline-info btn-sm btn_detail_pemilik" 
                                    data-toggle="modal" 
                                    data-target="#detail_pemilik" 
                                    data-id="<?= $row->id_ambulator ?>">Detail Pemilik</button>
                                    <button class="btn btn-outline-info btn-sm btn_detail_rm" 
                                    data-toggle="modal" 
                                    data-target="#detail_rm" 
                                    data-id="<?= $row->id_ambulator ?>">Detail Rekam Medis</button>
                                </td> -->
                                <td class="text-center">
                                    <div class="dropdown d-inline mr-2">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Pilih Aksi
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 29px, 0px);">
                                            <a class="dropdown-item btn_detail_pemilik" href="javascript:void(0)" data-toggle="modal" data-target="#detail_pemilik" data-id="<?= $row->id_ambulator ?>">Detail Pemilik</a>
                                            <a class="dropdown-item btn_detail_rm" href="javascript:void(0)" data-toggle="modal" data-target="#detail_rm" data-id="<?= $row->id_ambulator ?>">Detail Rekam Medis</a>
                                            <a class="dropdown-item" href="<?= base_url('rekam-medis/cetakrm/' . $row->id_ambulator ) ?>">Cetak Rekam Medis</a>
                                        </div>
                                    </div>
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
    <?= $this->include('rekam-medis/modal_pemilik');?>
    <?= $this->include('rekam-medis/modal_rm');?>
<?= $this->endSection();?>

<?= $this->section('script');?>
<script>
    $(document).on("click", ".btn_detail_rm", function() {
        let id_rm = $(this).data("id");
        $.ajax({
            url: "<?= base_url('rekam-medis/getDetail')?>",
            type: "post",
            data: {
                id_rm : id_rm
            },
            success: function(response) {
                let data = response;

                let html = `<table class="table table-striped table-sm table-bordered">
                    <tr>
                        <th class="text-center"><strong>Deskripsi RM</strong></th>
                        <td class="text-center"><strong>Hasil RM</strong></td>
                    </tr>
                    <tr>
                        <th class="text-left">Frekuensi pulsus</th>
                        <td>${data.frekuensi_pulsus}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Temperatur rektal</th>
                        <td>${data.temperatur_rektal}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Frekuensi nafas</th>
                        <td>${data.frekuensi_nafas}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Berat badan</th>
                        <td>${data.berat_badan}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Kondisi umum</th>
                        <td>${data.kondisi_umum}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Kulit bulu</th>
                        <td>${data.kulit_bulu}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Membran mukosa</th>
                        <td>${data.membran_mukosa}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Kelenjar limfa</th>
                        <td>${data.kelenjar_limfa}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Muskuloskeletal</th>
                        <td>${data.muskuloskeletal}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Sistem sirkulasi</th>
                        <td>${data.sistem_sirkulasi}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Sistem respirasi</th>
                        <td>${data.sistem_respirasi}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Sistem digesti</th>
                        <td>${data.sistem_digesti}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Sistem urogenital</th>
                        <td>${data.sistem_urogenital}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Sistem saraf</th>
                        <td>${data.sistem_saraf}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Mata telinga</th>
                        <td>${data.mata_telinga}</td>
                    </tr>
                </table>`; 

                $("#table-rm").html(html);
            }
        });
    });

    $(document).on("click", ".btn_detail_pemilik", function() {
        let id_rm = $(this).data("id");
        $.ajax({
            url: "<?= base_url('rekam-medis/getDetail')?>",
            type: "post",
            data: {
                id_rm : id_rm
            },
            success: function(response) {
                let data = response;
                let html = `<table class="table table-striped table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Pemilik</th>
                            <th>Nama Peliharaan</th>
                            <th>Spesies Peliharaan</th>
                            <th>Detail Peliharaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>${data.pemilik}</td>
                            <td>${data.nama_peliharaan}</td>
                            <td>${data.spesies} - ${data.ras}</td>
                            <td>${data.warna} - ${data.postur}</td>
                        </tr>
                    </tbody>
                </table>`; 

                $("#table-pemilik").html(html);
            }
        });
    });

    $(document).ready(function() {
        $("#table").DataTable();
    });
</script>
<?= $this->endSection();?>