<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function __construct() {
        $this->db = db_connect();
    }

    public function index()
    {
        $role = session()->get('role_name');
        $year = date('Y');
        $month = date('m');
        $datenow = date('Y-m-d');
        $transaksi = $this->db->query("SELECT 
            a.*, b.nama_lengkap
        FROM transaksi a 
        JOIN users b ON a.id_customer = b.id_user
        ORDER BY tgl_trx DESC
        LIMIT 5;")->getResult();
        $users = $this->db->query("SELECT  
            SUM(CASE WHEN role_name = 'admin' THEN 1 ELSE 0 END) as total_admin,
            SUM(CASE WHEN role_name = 'customer' THEN 1 ELSE 0 END) as total_customer,
            SUM(CASE WHEN role_name = 'kasir' THEN 1 ELSE 0 END) as total_kasir,
            SUM(CASE WHEN role_name = 'dokter' THEN 1 ELSE 0 END) as total_dokter
        FROM users;")->getRow();
        $book_pertahun = $this->db->query("select count(kode_booking) as total from booking where year(created_at) = '$year'")->getRow();
        $book_perbulan = $this->db->query("select count(kode_booking) as total from booking where year(created_at) = '$year' and month(created_at) = '$month'")->getRow();
        $book_perhari = $this->db->query("select count(kode_booking) as total from booking where left(created_at, 10) = '$datenow'")->getRow();
        return view('dashboard', [
            'role' => $role,
            'transaksi' => $transaksi,
            'users' => $users,
            'total' => [
                'tahun' => $book_pertahun->total,
                'bulan' => $book_perbulan->total,
                'hari' => $book_perhari->total,
            ]
        ]);
    }

    public function getSpesies()
    {
        $data = $this->db->query("SELECT deskripsi FROM dropdown WHERE jenis = 'spesies'")->getResult();
        echo json_encode($data);
    }

    public function getRas()
    {
        $data = $this->db->query("SELECT deskripsi FROM dropdown WHERE jenis = 'ras'")->getResult();
        echo json_encode($data);
    }

    public function getTrx()
    {
        $year = date('Y');

        $data = $this->db->query("SELECT MONTHNAME(a.tanggal) AS bulan, SUM(b.grand_total) AS total FROM ambulator a JOIN transaksi b ON a.id_ambulator = b.id_ambulator WHERE YEAR(tanggal) = '$year' GROUP BY MONTHNAME(tanggal) ORDER BY MONTH(tanggal);")->getResult();

        echo json_encode($data);
    }

    public function mark_as_read()
    {
        $this->db->table('log_history')
            ->update([
                'is_read' => 1
            ]);

        echo json_encode('Sukses');
    }
}
