<?= $this->extend('layouts/app');?>

<?= $this->section('page_title');?>
Dashboard
<?= $this->endSection();?>

<?= $this->section('content');?>
<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-primary notif" role="alert"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<?php if ($role == 'admin') : ?>
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
            <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
            <h4>Total Admin</h4>
            </div>
            <div class="card-body">
            <?= $users->total_admin?>
            </div>
        </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
            <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
            <h4>Total Dokter</h4>
            </div>
            <div class="card-body">
            <?= $users->total_dokter?>
            </div>
        </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
            <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
            <h4>Total Kasir</h4>
            </div>
            <div class="card-body">
            <?= $users->total_kasir?>
            </div>
        </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
        <div class="card-icon bg-success">
            <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
            <h4>Total Customer</h4>
            </div>
            <div class="card-body">
            <?= $users->total_customer?>
            </div>
        </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
        <div class="card-icon bg-success">
            <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
            <h4>Total Booking (Pertahun)
            </div>
            <div class="card-body">
            <?= $total['tahun'] ?>
            </div>
        </div>
        </div>
    </div>             
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
        <div class="card-icon bg-success">
            <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
            <h4>Total Booking (Perbulan)</h4>
            </div>
            <div class="card-body">
            <?= $total['bulan'] ?>
            </div>
        </div>
        </div>
    </div> 
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
        <div class="card-icon bg-success">
            <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
            <h4>Total Booking (Perhari)</h4>
            </div>
            <div class="card-body">
            <?= $total['hari'] ?>
            </div>
        </div>
        </div>
    </div> 
</div>
<?php endif; ?>

<?php if ($role == 'kasir') : ?>
<div class="row">
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>Grafik Transaksi</h4>
            </div>
            <div class="card-body">
                <div class="">
                    <canvas id="myChart"></canvas>
                </div>
        
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>5 Transaksi Terakhir</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" style="width: 100%;">
                        <thead>
                            <tr style="font-size: 13px;">
                                <th>ID Ambulator</th>
                                <th>Tgl Transaksi</th>
                                <th>Nama Customer</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($transaksi as $item) { ?>
                            <tr style="font-size: 12px;">
                                <td><?= $item->id_ambulator ?></td>
                                <td><?= $item->tgl_trx ?></td>
                                <td><?= $item->nama_lengkap ?></td>
                                <td><?= number_format($item->grand_total, 0, ',', '.') ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?= $this->endSection();?>

<?= $this->section('script');?>
<script>
    function renderSpeciesChart() {
        $.ajax({
            url: '<?= base_url('getTrx')?>',
            type: 'get',
            dataType: 'json',
            success: function(response) {
                let label = [];
                let output = [];

                response.forEach(element => {
                    label.push(element.bulan);
                    output.push(element.total);
                });

                const ctx = document.getElementById('myChart');
                const labels = label;
                const data = {
                labels: labels,
                datasets: [{
                    label: 'Total Transaksi',
                    data: output,
                    backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }]
                };
                // const config = {
                //     type: 'bar',
                //     data: data,
                //     options: {
                //         scales: {
                //         y: {
                //             beginAtZero: true
                //         }
                //         }
                //     },
                // };
                // const data = {
                //     labels: [
                //         'Red',
                //         'Blue',
                //         'Yellow'
                //     ],
                //     datasets: [{
                //         label: 'My First Dataset',
                //         data: [
                //             300, 
                //             50, 
                //             100
                //         ],
                //         backgroundColor: [
                //             'rgb(255, 99, 132)',
                //             'rgb(54, 162, 235)',
                //             'rgb(255, 205, 86)'
                //         ],
                //         hoverOffset: 4
                //     }]
                // };
                
                new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options: {
                        scales: {
                        y: {
                            beginAtZero: true
                        }
                        }
                    },
                });
            }
        });
    }

    $(document).ready(function() {
        renderSpeciesChart();
        renderRasChart(); 
    });

</script>
<?= $this->endSection();?>