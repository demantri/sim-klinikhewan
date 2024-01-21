<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use TCPDF;
use App\Models\CrudModel;
use App\Models\GenerateCode;
use App\Controllers\BaseController;
use App\Models\TransaksiModel;

class RekamMedis extends BaseController
{
    public function __construct() {
        $this->code = new GenerateCode;
        $this->model = new CrudModel;
        $this->trx = new TransaksiModel;
        $this->db = db_connect();
    }

    public function add($kode_booking = '')
    {
        $id_user = session()->get('id_user');
        $kode = $this->code->createIDRM();
        // $pemilik = $this->model->getDataAkun('customer');

        // yang baru pemilik di table user 
        $pemilik = $this->db->query("select * from users where role_name ='customer' and is_active = 1")->getResult();

        // yang baru dokter ambil dr tabel user
        $dokter = $this->db->query("select *
        from users
        where id_user = '$id_user'
        and role_name = 'dokter'
        and is_active = '1'
        ")->getRow();
        $obat = $this->model->getData('obat');
        $data = [
            'kode' => $kode,
            'pemilik' => $pemilik,
            'dokter' => $dokter,
            'kode_booking' => $kode_booking,
            'obat' => $obat,
        ];
        return view('rekam-medis/add', $data);
    }

    public function get_peliharaan()
    {
        $id_pemilik = $this->request->getVar('id_pemilik');
        // $data = $this->db->query("select * from pendaftaran where id_user = '$id_pemilik'")->getResult();
        $data = $this->db->query("select 
            a.id_pendaftaran,
            a.id_customer,
            b.id_hewan,
            b.nama_peliharaan
        from pendaftaran a 
        join pendaftaran_detail b on a.id_pendaftaran = b.id_pendaftaran
        where id_customer = '$id_pemilik';")->getResult();
        return $this->response->setJSON($data);
    }

    public function simpan()
    {
        $data = $this->request->getVar();
        $kode_booking = $data['kode_booking'];
        if ($kode_booking !== '') {
            // update status booking
            $this->db->table('booking')
                ->where('kode_booking', $kode_booking)
                ->update([
                    'status' => 1
                ]);
        }
        $id_hewan = $data['peliharaan'];
        $hewan = $this->db->query("select * from hewan where id_hewan = '$id_hewan'")->getRow();
        $nama_peliharaan = $hewan->nama;
        $insert = [
            'id_ambulator' => $data['id_rekam_medis'],
            'tanggal' => $data['tanggal'],
            'id_customer' => $data['pemilik'],
            'id_hewan' => $id_hewan,
            'nama_peliharaan' => $nama_peliharaan,
            'id_dokter' => $data['dokter'],
            'temperatur_rektal' => $data['temperatur_rektal'],
            'frekuensi_pulsus' => $data['frekuensi_pulsus'],
            'frekuensi_nafas' => $data['frekuensi_nafas'],
            'berat_badan' => $data['berat_badan'],
            'kondisi_umum' => $data['kondisi_umum'],
            'kulit_bulu' => $data['kulit_bulu'],
            'membran_mukosa' => $data['membran_mukosa'],
            'kelenjar_limfa' => $data['kelenjar_limfa'],
            'muskuloskeletal' => $data['muskuloskeletal'],
            'sistem_sirkulasi' => $data['sistem_sirkulasi'],
            'sistem_respirasi' => $data['sistem_respirasi'],
            'sistem_digesti' => $data['sistem_digesti'],
            'sistem_urogenital' => $data['sistem_urogenital'],
            'sistem_saraf' => $data['sistem_saraf'],
            'mata_telinga' => $data['mata_telinga'],
            'kode_booking' => $kode_booking,
        ];
        $this->db->table('ambulator')
            ->insert($insert);

        // insert table transaksi utk pembayaran
        $id_trx = $this->code->createTrxCode();
        // insert untuk tabel transaksi
        $this->trx->createTrx($data, $id_trx);

        // insert untuk pencatatan obat
        $this->trx->insertObat($data);
        $this->trx->updateStokObat($data);

        return $this->response->setJSON([
            'msg' => 'Data berhasil disimpan'
        ], 200);
    }

    public function view()
    {
        $query = "SELECT
            a.*,
            b.pemilik,
            c.nama_dokter,
            d.id_trx,
            d.tgl_trx,
            d.jasa_dokter,
            d.total_transaksi,
            d.grand_total,
            d.status
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
        JOIN transaksi d ON a.id_ambulator = d.id_ambulator;";

        $list = $this->db->query($query)->getResult();

        $data = [
            'list' => $list
        ];

        return view('rekam-medis/view', $data);
    }
    
    public function cetak()
    {
        $id_rekam_medis = $this->request->getVar('id_rekam_medis');

        $rm = $this->db->query("SELECT 
            a.*,
            b.nama_lengkap,
            c.nama_lengkap AS nama_dokter,
            d.spesies,
            d.ras,
            d.warna,
            d.postur
        FROM rekam_medis a
        JOIN pemilik b ON a.id_pemilik = b.id_pemilik
        JOIN dokter c ON a.id_dokter = c.id_dokter
        JOIN pendaftaran d ON a.id_pemilik = d.id_pemilik
        WHERE a.id_ambulator = '$id_rekam_medis'")->getRow();

        $data = [
            'rm' => $rm
        ];

        $html = view('pdf/cetak_rm', $data);

		$pdf = new TCPDF('L', PDF_UNIT, 'A5', true, 'UTF-8', false);

		// $pdf->SetCreator(PDF_CREATOR);
		// $pdf->SetAuthor('Dea Venditama');
		// $pdf->SetTitle('Invoice');
		// $pdf->SetSubject('Invoice');

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->addPage();

		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');
		//line ini penting
		$this->response->setContentType('application/pdf');
		//Close and output PDF document
		$pdf->Output('rekam_medis.pdf', 'I');
    }

    public function getDetail()
    {
        $id_rm = $this->request->getVar('id_rm');

        $data = $this->db->query("SELECT
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
        WHERE a.id_ambulator = '$id_rm'")->getRow();

        return $this->response->setJSON($data);
    }

    public function getObat()
    {
        $id_obat = $this->request->getVar('id_obat');
        
        $data = $this->db->query("select * from obat where id_obat = '$id_obat'")->getRow();
        
        return $this->response->setJSON($data);
    }
}
