<?= $this->extend('layouts/app');?>

<?= $this->section('page_title');?>
Input Rekam Medis
<?= $this->endSection();?>

<?= $this->section('content');?>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success notif" role="alert"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-primary">
                <form id="myform">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h4>
                                    Detail
                                </h4>
                                <hr>
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
                                                    <option value="" selected>Pilih</option>
                                                    <?php foreach ($pemilik as $row) { ?>
                                                    <option value="<?= $row->id_pemilik ?>"><?= $row->nama_lengkap ?></option>
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
                                    <label>Dokter</label>
                                    <input type="hidden" class="form-control" name="dokter" id="dokter" value="<?= $dokter->id_dokter ?>" readonly>
                                    <input type="text" class="form-control" value="<?= $dokter->nama_lengkap ?>" readonly>
                                </div>
                                <!-- <hr> -->
                                <h4>
                                    Detail Obat
                                </h4>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Obat</label>
                                            <div class="wrapper_obat">
                                                <div class="row">
                                                    <div class="col-lg-7">
                                                        <select name="obat[]" class="form-control obat" required>
                                                            <option value="" selected disabled>Pilih</option>
                                                            <?php foreach ($obat as $item) { ?>
                                                            <option value="<?= $item->id_obat ?>"><?= $item->nama_obat ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <input type="number" name="qty[]" class="form-control qty" min="1" value="1" placeholder="Masukan QTY">
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

                                <!-- tidak dimunculkan karena ini gak butuh dimunculkan untuk nominal2 selain kasir -->
                                <div class="content_pembayaran d-none">
                                    <h4>
                                        Pembayaran
                                    </h4>
                                    <hr>
                                    <div class="form-group">
                                        <label>Jasa Dokter</label>
                                        <input type="text" class="form-control" value="<?= number_format('150000')?>" readonly>
                                        <input type="hidden" value="150000" name="jasa_dokter" id="jasa_dokter">
                                    </div>
                                    <div class="form-group">
                                        <label>Total Transaksi</label>
                                        <input type="text" class="form-control" value="<?= number_format('200000')?>" readonly>
                                        <input type="hidden" value="200000" name="total_transaksi" id="total_transaksi">
                                    </div>
                                    <div class="form-group">
                                        <label>Grand Total</label>
                                        <input type="text" class="form-control" value="<?= number_format('350000')?>" readonly>
                                        <input type="hidden" value="350000" name="grandtotal" id="grandtotal">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <h4>Rekam medis</h4>
                                <hr>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary" type="submit">Proses</button>
                        <!-- <button class="btn btn-outline-success" type="button">Simpan & Print</button> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
<?= $this->endSection();?>

<?= $this->section('script');?>
<?= $this->include('rekam-medis/script');?>
<?= $this->endSection();?>