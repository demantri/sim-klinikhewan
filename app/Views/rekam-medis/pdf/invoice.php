<html>
	<head>
		<style>
			table {
			  font-family: arial, sans-serif;
			  border-collapse: collapse;
			  width: 100%;
			}

			td, th {
			  border: 1px solid #000000;
			  text-align: center;
			  height: 20px;
			  margin: 8px;
			}

            .text-left {
                text-align: left;
            }

			.text-center {
                text-align: center;
            }

			.text-right {
                text-align: right;
            }

		</style>
	</head>
	<body>
		<div style="font-size:64px; color:'#dddddd'"><i>Invoice Pembayaran</i></div>
		<p>
		<i>Klinik Hewan Renald</i><br>
        <i>dr.</i> <?= $transaksi->nama_dokter ?> <br>
		Jakarta, Indonesia
		</p>
		<hr>
        <p>
            Tgl Cetak : <?= date('d/m/Y H:i:s')?><br>
            Nama Kasir : <?= $transaksi->nama_kasir ?>
        </p>
        <p></p>
		<p>
			ID Ambulator : <?= $transaksi->id_ambulator ?><br>
			Nama Customer : <?= $transaksi->pemilik ?><br>
		</p>
        <hr>
		<table cellpadding="6" >
            <tr>
                <th class="text-center"><strong>Deskripsi</strong></th>
                <td class="text-center"><strong>Nominal</strong></td>
            </tr>
            <tr>
                <td class="text-left">Jasa Dokter</td>
                <td class="text-right"><?= number_format($transaksi->jasa_dokter, 0, ',','.') ?></td>
            </tr>
            <tr>
                <td class="text-left">Total Transaksi</td>
                <td class="text-right"><?= number_format($transaksi->total_transaksi, 0, ',','.') ?></td>
            </tr>
            <tr>
                <td class="text-left">Grand total</td>
                <td class="text-right"><?= number_format($transaksi->grand_total, 0, ',','.') ?></td>
            </tr>
		</table>
	</body>
</html>