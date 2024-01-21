<?= $this->extend('layouts/app');?>

<?= $this->section('page_title');?>
Input Rekam Medis
<?= $this->endSection();?>

<?= $this->section('content');?>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success notif" role="alert"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <form id="myform">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="card">
                    <div class="card-header">
                    <h4>Detail Informasi</h4>
                        <div class="card-header-action">
                            <a data-collapse="#card-1" class="btn btn-icon btn-light" href="#">
                                <i class="fas fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="collapse show" id="card-1" style="">
                        <div class="card-body">
                            <div class="form-group">
                                <label>ID Rekam Medis</label>
                                <input type="text" name="id_rekam_medis" id="id_rekam_medis" class="form-control" value="<?= $kode ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= date('Y-m-d')?>">
                            </div>
                            <div class="form-group">
                                <label>Kode Booking</label>
                                <input type="text" name="kode_booking" id="kode_booking" class="form-control" value="<?= $kode_booking ?>" readonly>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Pemilik</label>
                                        <?php if ($kode_booking != '') { ?>
                                            <input type="hidden" class="form-control" id="pemilik" name="pemilik" readonly>
                                            <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" readonly>
                                        <?php } else { ?>
                                            <select name="pemilik" id="pemilik" class="form-control pemilik" required>
                                                <option value="" selected disabled>Pilih</option>
                                                <?php foreach ($pemilik as $row) { ?>
                                                <option value="<?= $row->id_user ?>"><?= $row->nama_lengkap ?></option>
                                                <?php } ?>
                                            </select>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Peliharaan</label>
                                        <select name="peliharaan" id="peliharaan" class="form-control" required>
                                            <option value="">-</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Dokter</label>
                                        <input type="hidden" class="form-control" name="dokter" id="dokter" value="<?= $dokter->id_user ?>" readonly>
                                        <input type="text" class="form-control" value="<?= $dokter->nama_lengkap ?>" readonly>
                                    </div>
                                    <div class="col-6">
                                        <label>Jasa Dokter</label>
                                        <input type="text" class="form-control money" name="jasa_dokter" id="jasa_dokter" value="0" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="card">
                    <div class="card-header">
                    <h4>Ambulator</h4>
                        <div class="card-header-action">
                            <a data-collapse="#card-2" class="btn btn-icon btn-light" href="#">
                                <i class="fas fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="collapse show" id="card-2" style="">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Temperatur Rektal</label>
                                        <input type="text" value="0" name="temperatur_rektal" id="temperatur_rektal" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Frekuensi Pulsus</label>
                                        <input type="text" value="0" name="frekuensi_pulsus" id="frekuensi_pulsus" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Frekuensi Nafas</label>
                                        <input type="text" value="0" name="frekuensi_nafas" id="frekuensi_nafas" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Berat Badan</label>
                                        <input type="text" value="0" name="berat_badan" id="berat_badan" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Kondisi Umum</label>
                                        <input type="text" value="0" name="kondisi_umum" id="kondisi_umum" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Kulit Bulu</label>
                                        <input type="text" value="0" name="kulit_bulu" id="kulit_bulu" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Membran Mukosa</label>
                                        <input type="text" value="0" name="membran_mukosa" id="membran_mukosa" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Kelenjar Limfa</label>
                                        <input type="text" value="0" name="kelenjar_limfa" id="kelenjar_limfa" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Muskuloskeletal</label>
                                        <input type="text" value="0" name="muskuloskeletal" id="muskuloskeletal" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Sistem Sirkulasi</label>
                                        <input type="text" value="0" name="sistem_sirkulasi" id="sistem_sirkulasi" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Sistem Respirasi</label>
                                        <input type="text" value="0" name="sistem_respirasi" id="sistem_respirasi" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Sistem Digesti</label>
                                        <input type="text" value="0" name="sistem_digesti" id="sistem_digesti" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Sistem Urogenital</label>
                                        <input type="text" value="0" name="sistem_urogenital" id="sistem_urogenital" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Sistem Saraf</label>
                                        <input type="text" value="0" name="sistem_saraf" id="sistem_saraf" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Mata Telinga</label>
                                        <input type="text" value="0" name="mata_telinga" id="mata_telinga" class="form-control" required>
                                    </div>
                                    <!-- <input type="hidden" value="150000" name="jasa_dokter" id="jasa_dokter"> -->
                                    <!-- <input type="text" value="200000" name="total_transaksi" id="total_transaksi"> -->
                                    <!-- <input type="text" value="350000" name="grandtotal" id="grandtotal"> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Detail Obat</h4>
                        <div class="card-header-action">
                            <a data-collapse="#card-3" class="btn btn-icon btn-light" href="#">
                                <i class="fas fa-chevron-down"></i>
                            </a>
                        </div>
                    </div>
                    <div class="collapse" id="card-3" style="">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Obat</label>
                                        <div class="wrapper_obat">
                                            <div class="row">
                                                <div class="col-lg-7">
                                                    <select name="obat[]" id="select_obat_1" class="form-control obat" onchange="inputHargaObat('select_obat_1', 'obat_1')">
                                                        <option value="">Pilih</option>
                                                        <?php foreach ($obat as $item) { ?>
                                                        <option value="<?= $item->id_obat ?>"><?= $item->nama_obat ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <input type="text" class="harga_obat" name="harga_obat[]" id="obat_1">
                                                </div>
                                                <div class="col-lg-3">
                                                    <input type="number" name="qty[]" class="form-control qty" value="0" placeholder="Masukan QTY">
                                                </div>
                                                <div class="col-lg-2">
                                                    <button class="btn btn-success" type="button" id="button_tambah_obat">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <center>
                    <button class="btn btn-primary" type="submit" id="btn-submit">
                        Submit
                    </button>
                </center>
            </div>
        </div>
    </form>
<?= $this->endSection();?>

<?= $this->section('script');?>
<?= $this->include('rekam-medis/script');?>
<?= $this->endSection();?>