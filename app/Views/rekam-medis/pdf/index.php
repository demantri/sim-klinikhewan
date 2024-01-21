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

		</style>
	</head>
	<body>
		<div style="font-size:64px; color:'#dddddd'"><i>Rekam Medis</i></div>
		<p>
		<i>Klinik Hewan Renald</i><br>
        <i>dr.</i> <?= $ambulator->nama_dokter ?> <br>
		Jakarta, Indonesia
		</p>
		<hr>
        <p>
            Tgl Cetak : <?= date('d/m/Y H:i:s')?><br>
        </p>
		<p>
			ID Ambulator : <?= $ambulator->id_ambulator ?><br>
			Nama Pemilik : <?= $ambulator->pemilik ?><br>
			Nama Peliharaan : <?= $ambulator->nama_peliharaan ?><br>
			Spesies Peliharaan : <?= $ambulator->spesies . ' - ' . $ambulator->ras ?><br>
			Detail Peliharaan : <?= $ambulator->warna .' - '. $ambulator->postur ?><br> 
		</p>
        <hr>
		<table cellpadding="6" >
            <tr>
                <th class="text-left"><strong>Deskripsi Rekam Medis</strong></th>
                <td class="text-left"><strong>Hasil Rekam Medis</strong></td>
            </tr>
            <tr>
                <td class="text-left">Frekuensi pulsus</td>
                <td class="text-left"><?= $ambulator->frekuensi_pulsus ?></td>
            </tr>
            <tr>
                <td class="text-left">Temperatur rektal</td>
                <td class="text-left"><?= $ambulator->temperatur_rektal ?></td>
            </tr>
            <tr>
                <td class="text-left">Frekuensi nafas</td>
                <td class="text-left"><?= $ambulator->frekuensi_nafas ?></td>
            </tr>
            <tr>
                <td class="text-left">Berat badan</td>
                <td class="text-left"><?= $ambulator->berat_badan ?></td>
            </tr>
            <tr>
                <td class="text-left">Kondisi umum</td>
                <td class="text-left"><?= $ambulator->kondisi_umum ?></td>
            </tr>
            <tr>
                <td class="text-left">Kulit bulu</td>
                <td class="text-left"><?= $ambulator->kulit_bulu ?></td>
            </tr>
            <tr>
                <td class="text-left">Membran mukosa</td>
                <td class="text-left"><?= $ambulator->membran_mukosa ?></td>
            </tr>
            <tr>
                <td class="text-left">Kelenjar limfa</td>
                <td class="text-left"><?= $ambulator->kelenjar_limfa ?></td>
            </tr>
            <tr>
                <td class="text-left">Muskuloskeletal</td>
                <td class="text-left"><?= $ambulator->muskuloskeletal ?></td>
            </tr>
            <tr>
                <td class="text-left">Sistem sirkulasi</td>
                <td class="text-left"><?= $ambulator->sistem_sirkulasi ?></td>
            </tr>
            <tr>
                <td class="text-left">Sistem respirasi</td>
                <td class="text-left"><?= $ambulator->sistem_respirasi ?></td>
            </tr>
            <tr>
                <td class="text-left">Sistem digesti</td>
                <td class="text-left"><?= $ambulator->sistem_digesti ?></td>
            </tr>
            <tr>
                <td class="text-left">Sistem urogenital</td>
                <td class="text-left"><?= $ambulator->sistem_urogenital ?></td>
            </tr>
            <tr>
                <td class="text-left">Sistem saraf</td>
                <td class="text-left"><?= $ambulator->sistem_saraf ?></td>
            </tr>
            <tr>
                <td class="text-left">Mata telinga</td>
                <td class="text-left"><?= $ambulator->mata_telinga ?></td>
            </tr>
		</table>
	</body>
</html>