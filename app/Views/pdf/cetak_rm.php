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
			  /* text-align: center; */
			  height: 20px;
			  margin: 8px;
              font-size: small;
			}

            .text-center {
                text-align: center;
            }

            .text-left {
                text-align: left;
            }

            .text-right {
                text-align: right;
            }

		</style>
	</head>
	<body>
		<div style="font-size:64px; color:'#dddddd'"><i>Invoice</i></div>
		<p>
		<i><?= $rm->id_dokter?></i><br>
		<?= 'dr. ' . $rm->nama_dokter?>
		</p>
		<hr>
		<hr>
		<p></p>
		<p>
			Pemilik : <?= $rm->nama_lengkap ?><br>
			Nama Peliharaan : <?= $rm->nama_peliharaan ?><br>
			Spesies Peliharaan : <?= $rm->spesies .' - '. $rm->ras ?><br>
			Detail Peliharaan : <?= $rm->warna .' - '. $rm->postur ?><br>
		</p>
		<table cellpadding="6" >
			<tr>
				<th class="text-center"><strong>Jasa Dokter</strong></th>
				<th class="text-center"><strong>Total Transaksi</strong></th>
				<th class="text-center"><strong>Grand Total</strong></th>
			</tr>
			<tr>
				<td class="text-right"><?= "Rp " . number_format($rm->jasa_dokter,2,',','.')  ?></td>
				<td class="text-right"><?= "Rp " . number_format($rm->total_transaksi,2,',','.')  ?></td>
				<td class="text-right"><?= "Rp " . number_format($rm->grand_total,2,',','.')  ?></td>
			</tr>
		</table>
        <br>
        <div style="font-size:24px; color:'#dddddd'">
            Hasil Rekam Medis
        </div>
        <br>
        <table cellpadding="6" >
            <tr>
                <th class="text-center"><strong>Deskripsi RM</strong></th>
                <td class="text-center"><strong>Hasil RM</strong></td>
            </tr>
            <tr>
                <th class="text-left">Frekuensi pulsus</th>
                <td><?= $rm->frekuensi_pulsus ?></td>
            </tr>
            <tr>
                <th class="text-left">Temperatur rektal</th>
                <td><?= $rm->temperatur_rektal ?></td>
            </tr>
            <tr>
                <th class="text-left">Frekuensi nafas</th>
                <td><?= $rm->frekuensi_nafas ?></td>
            </tr>
            <tr>
                <th class="text-left">Berat badan</th>
                <td><?= $rm->berat_badan ?></td>
            </tr>
            <tr>
                <th class="text-left">Kondisi umum</th>
                <td><?= $rm->kondisi_umum ?></td>
            </tr>
            <tr>
                <th class="text-left">Kulit bulu</th>
                <td><?= $rm->kulit_bulu ?></td>
            </tr>
            <tr>
                <th class="text-left">Membran mukosa</th>
                <td><?= $rm->membran_mukosa ?></td>
            </tr>
            <tr>
                <th class="text-left">Kelenjar limfa</th>
                <td><?= $rm->kelenjar_limfa ?></td>
            </tr>
            <tr>
                <th class="text-left">Muskuloskeletal</th>
                <td><?= $rm->muskuloskeletal ?></td>
            </tr>
            <tr>
                <th class="text-left">Sistem sirkulasi</th>
                <td><?= $rm->sistem_sirkulasi ?></td>
            </tr>
            <tr>
                <th class="text-left">Sistem respirasi</th>
                <td><?= $rm->sistem_respirasi ?></td>
            </tr>
            <tr>
                <th class="text-left">Sistem digesti</th>
                <td><?= $rm->sistem_digesti ?></td>
            </tr>
            <tr>
                <th class="text-left">Sistem urogenital</th>
                <td><?= $rm->sistem_urogenital ?></td>
            </tr>
            <tr>
                <th class="text-left">Sistem saraf</th>
                <td><?= $rm->sistem_saraf ?></td>
            </tr>
            <tr>
                <th class="text-left">Mata telinga</th>
                <td><?= $rm->mata_telinga ?></td>
            </tr>
        </table>
	</body>
</html>