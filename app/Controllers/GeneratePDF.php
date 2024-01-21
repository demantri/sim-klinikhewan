<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use App\Controllers\BaseController;

class GeneratePDF extends BaseController
{
    public function __construct() {
        $this->db = db_connect();
    }
    public function index()
    {
        //
    }

    public function cetak_rm($id_ambulator)
    {
        // $ambulator = $this->db->query("select * from ambulator where id_ambulator = '$id_ambulator'")->getRow();
        $sql = "SELECT
            a.*,
            b.pemilik,
            c.nama_dokter,
            d.warna,
            d.postur,
            d.tanggal_lahir,
            d.spesies,
            d.ras,
            d.jenis_kelamin
        FROM ambulator a
        JOIN 
        (
            SELECT 
            z.id_user as id_pemilik, 
            z.nama_lengkap as pemilik
            FROM users z
        ) as b on b.id_pemilik = a.id_customer
        JOIN 
        (
            SELECT 
            x.id_user as id_dokter, 
            x.nama_lengkap as nama_dokter
            FROM users x
        ) as c on c.id_dokter = a.id_dokter
        JOIN hewan d ON a.id_hewan = d.id_hewan
        WHERE a.id_ambulator = '$id_ambulator'";
        $ambulator = $this->db->query($sql)->getRow();

        $filename = date('YmdHis'). '_report_rekam_medis';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        $data = [
            'ambulator' => $ambulator
        ];

        // load HTML content
        $dompdf->loadHtml(view('rekam-medis/pdf/index', $data));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename);
    }

    public function cetak_invoice($id_ambulator)
    {
        $sql = "SELECT
            a.*,
            b.pemilik,
            c.nama_dokter,
            d.nama_kasir
        FROM transaksi a
        JOIN 
        (
            SELECT 
            z.id_user as id_pemilik, 
            z.nama_lengkap as pemilik
            FROM users z 
        ) AS b ON b.id_pemilik = a.id_customer
        JOIN 
        (
            SELECT 
            x.id_user as id_dokter, 
            x.nama_lengkap as nama_dokter
            FROM users x
        ) as c on c.id_dokter = a.id_dokter
        JOIN 
        (
            SELECT 
            u.id_user as id_kasir, 
            u.nama_lengkap as nama_kasir
            FROM users u
        ) as d on d.id_kasir = a.id_kasir
        WHERE a.id_ambulator = '$id_ambulator'";
        $transaksi = $this->db->query($sql)->getRow();

        $filename = date('YmdHis'). '_report_invoice';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        $data = [
            'transaksi' => $transaksi
        ];

        // load HTML content
        $dompdf->loadHtml(view('rekam-medis/pdf/invoice', $data));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename);
    }
}
