<?php

namespace App\Controllers;

use App\Models\CrudModel;
use App\Models\GenerateCode;
use App\Controllers\BaseController;
use App\Filters\Auth;

class Booking extends BaseController
{
    public function __construct() {
        $this->model = new CrudModel;
        $this->code = new GenerateCode;
        helper('form');
        $this->db = db_connect();
    }

    public function index()
    {
        $id_user = session()->get('id_user');
        $pmlk = $this->db->query("select * from users where id_user = '$id_user'")->getRow();
        // untuk ambil id pelanggan berdasarkan id user login
        $kode = $this->code->kode_booking();
        $dokter = $this->db->query("select id_user, nama_lengkap from users where role_name = 'dokter' and is_active = '1'")->getResult();
        return view('booking/index', [
            'kode' => $kode,
            'dokter' => $dokter,
            'data_pemilik' => $pmlk,
        ]);
    }

    public function simpan()
    {
        $post = $this->request->getVar();
        $data = [
            'kode_booking' => $post['kode_booking'],
            'tgl_booking' => $post['tgl_booking'],
            'id_customer' => $post['id_pelanggan'],
            'id_dokter' => $post['dokter'],
        ];
        $this->db->table('booking')->insert($data);

        // insert log
        $id_pelanggan = $post['id_pelanggan'];
        $user = $this->db->query("select * from users where id_user = '$id_pelanggan'")->getRow();
        $log = [
            'id_ref' => $post['kode_booking'],
            'id_user' => $id_pelanggan,
            'message' => '<strong>'. $user->nama_lengkap .'</strong> telah melakukan booking.',
        ];
        $this->db->table('log_history')->insert($log);

        session()->setFlashdata("success", "Data berhasil disimpan!");
    
        return redirect()->to(base_url('form-booking'));
    }

    public function listBooking()
    {
        $role = session()->get('role_name');
        $query = "SELECT
                a.*,
                b.nama_lengkap,
                b.no_telp,
                b.alamat
            FROM booking a
            JOIN users b ON a.id_customer = b.id_user 
            ";
        if ($role == 'admin') {
            $query .= "WHERE status = 0";
        } else if ($role == 'dokter') {
            $id_dokter = session()->get('id_user');
            $query .= "WHERE status = 2 AND id_dokter = '$id_dokter'";
        }
        $booking = $this->db->query($query)->getResult();
        return view('booking/list_booking', [
            'booking' => $booking
        ]);
    }

    public function getDataBooking()
    {
        $kode_booking = $this->request->getVar('kode_booking');
        
        $data = $this->db->query("select a.*, b.nama_lengkap, b.no_telp, b.alamat 
        from booking a 
        join users b on a.id_customer = b.id_user
        where a.kode_booking = '$kode_booking'
        ")->getRow();
        
        return $this->response->setJSON($data);
    }

    public function prosesBooking($kode_booking)
    {
        $this->db->table('booking')
            ->where('kode_booking', $kode_booking)
            ->update([
                'status' => 2
            ]);

        session()->setFlashdata("success", "Data berhasil diproses!");

        return redirect()->to(base_url('daftar-booking'));
    }

    public function prosesBatal($kode_booking)
    {
        $this->db->table('booking')
            ->where('kode_booking', $kode_booking)
            ->update([
                'status' => 9
            ]);

        return $this->response->setJSON([
            'msg' => 'Data berhasil dibatalkan'
        ]);

        // session()->setFlashdata("success", "Data berhasil dibatalkan!");

        // return redirect()->to(base_url('daftar-booking'));
    }
}
