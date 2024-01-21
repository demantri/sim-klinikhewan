<?= $this->extend('layouts/app'); ?>

<?= $this->section('page_title'); ?>
Pendaftaran Baru
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<?php
$validation = \Config\Services::validation();
?>
<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success notif" role="alert"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<a href="<?= base_url('pendaftaran') ?>" class="btn btn-light mb-4">
    Kembali
</a>
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Data Peliharaan</h3>
            </div>
            <form id="myForm">
                <div class="card-body">
                    <div class="form-group">
                        <label>ID Pendaftaran</label>
                        <input type="text" name="id_pendaftaran" id="id_pendaftaran" class="form-control" value="<?= $kode ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Peliharaan</label>
                        <div class="d-flex">
                            <select name="nama_peliharaan[]" id="nama_peliharaan" class="form-control" data-placeholder="Pilih Peliharaan" multiple required>
                                <option value=""></option>
                                <?php foreach ($hewan as $item) { ?>
                                <option value="<?= $item->id_hewan ?>"><?= $item->nama .' ('. $item->spesies . ' - ' . $item->ras . ')'?></option>
                                <?php } ?>
                            </select>
                            
                            <div class="ml-3">
                                <button class="btn btn-lg btn-outline-success" type="submit" id="btn_tambah_detail">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div> 
                </div>
            </form>
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Detail Pendaftaran</h3>
            </div>
            <form id="formDetail">
                <div class="card-body">
                    <!-- table detail -->
                    <table class="table table-bordered">
                        <thead>
                            <tr style="font-size: 12px;">
                                <th></th>
                                <th>ID Hewan</th>
                                <th>Nama Peliharaan</th>
                                <th>Jenis Peliharaan</th>
                                <th>Tanggal Lahir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($detail as $item) { ?>
                            <tr style="font-size: 12px;">
                                <td>
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusDetail('<?= $item->id ?>')" type="button">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                                <td><?= $item->id_hewan ?></td>
                                <td><?= $item->nama_peliharaan ?></td>
                                <td><?= $item->spesies .' - '. $item->ras ?></td>
                                <td><?= $item->tanggal_lahir ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php if (count($detail) > 0) { ?>
                        <div class="form-group">
                            <label>Nama Pemilik</label>
                            <select name="pemilik" id="pemilik" class="form-control <?= $validation->hasError('pemilik') ? 'is-invalid' : '' ?>" required>
                                <option value="" selected disabled>- Pilih -</option>
                                <?php foreach ($pemilik as $item) : ?>
                                    <option value="<?= $item->id_user ?>" <?= $item->id_user == $pendaftaran->id_customer ? 'selected' : '' ?>><?= $item->id_user . ' / ' . $item->nama_lengkap ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if ($validation->getError('pemilik')) { ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('pemilik'); ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    
                </div>
                <hr>
                <div class="card-footer">
                    <?php if (count($detail) > 0) { ?>
                        <button class="btn btn-primary" type="submit">Update Data</button>
                        <!-- <button class="btn btn-outline-danger" type="button">Batal Pendaftaran</button> -->
                    <?php } else { ?>
                        <button class="btn btn-primary" type="button" disabled>Update Data</button>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
    <?= $this->include('pendaftaran/script'); ?>
<?= $this->endSection(); ?>