<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CrudModel;
use App\Models\GenerateCode;

class Pendaftaran extends BaseController
{
    public function __construct()
    {
        $this->model = new CrudModel;
        $this->code = new GenerateCode;
        $this->db = db_connect();
    }

    public function index()
    {
        $pendaftaran = $this->db->query("select 
            a.*, 
            b.nama_lengkap
            from pendaftaran a
            join users b on a.id_customer = b.id_user
        ")->getResult();
        $data = [
            'pendaftaran' => $pendaftaran
        ];
        return view('pendaftaran/index', $data);
    }

    public function form_add()
    {
        $kode = $this->code->createIDPendaftaran();
        // die($kode);
        $user = $this->db->query("select id_user, nama_lengkap from users where is_active = 1 and role_name = 'customer'")->getResult();
        $hewan = $this->db->query("SELECT * FROM hewan WHERE id_hewan NOT IN (SELECT id_hewan FROM pendaftaran_detail);")->getResult();
        $detail_pendaftaran = $this->db->query("select * from pendaftaran_detail where id_pendaftaran = '$kode'")->getResult();
        $pendaftaran = $this->db->query("select * from pendaftaran where id_pendaftaran = '$kode'")->getResult();

        $count = count($pendaftaran);
        
        $data = [
            'kode' => $kode,
            'pemilik' => $user,
            'hewan' => $hewan,
            'detail' => $detail_pendaftaran,
            'is_register' => $count,
            'pendaftaran' => $pendaftaran
        ];
        
        // print_r($data);exit;
        return view('pendaftaran/add', $data);
    }

    public function add_detail() 
    {
        $data = $this->request->getVar();
        $id_pendaftaran = $data['id_pendaftaran'];
        $pemilik = $data['pemilik'] ?? '';
        $id_hewan = $data['nama_peliharaan'];
        // cek tabel pendaftaran
        $pendaftaran = $this->db->query("select * from pendaftaran where id_pendaftaran = '$id_pendaftaran'")->getResult();
        // print_r(count($pendaftaran));exit;
        if (count($pendaftaran) == 0) {
            // print_r('kosong');exit;
            $tbl_pendaftaran = [
                'id_pendaftaran' => $data['id_pendaftaran'],
                'id_customer' => $pemilik,
            ];
            $this->db->table('pendaftaran')->insert($tbl_pendaftaran);

            // insert tabel detail
            foreach ($id_hewan as $key => $items) {
                $get_detail_hewan_by_id = $this->db->query("select * from hewan where id_hewan = '$items'")->getRow();
                $tbl_pendaftaran_detail = [
                    'id_pendaftaran' => $data['id_pendaftaran'],
                    'id_hewan' => $items,
                    'nama_peliharaan' => $get_detail_hewan_by_id->nama,
                    'spesies' => $get_detail_hewan_by_id->spesies,
                    'ras' => $get_detail_hewan_by_id->ras,
                    'tanggal_lahir' => $get_detail_hewan_by_id->tanggal_lahir,
                ];
                $this->db->table('pendaftaran_detail')->insert($tbl_pendaftaran_detail);
            }
        } else {
            foreach ($id_hewan as $key => $items) {
                // $pendaftaran_detail = $this->db->query("select * from pendaftaran_detail where id_pendaftaran = '$id_pendaftaran' and id_hewan = '$items'")->getResult();
                $get_detail_hewan_by_id = $this->db->query("select * from hewan where id_hewan = '$items'")->getRow();
                $tbl_pendaftaran_detail = [
                    'id_pendaftaran' => $data['id_pendaftaran'],
                    'id_hewan' => $items,
                    'nama_peliharaan' => $get_detail_hewan_by_id->nama,
                    'spesies' => $get_detail_hewan_by_id->spesies,
                    'ras' => $get_detail_hewan_by_id->ras,
                    'tanggal_lahir' => $get_detail_hewan_by_id->tanggal_lahir,
                ];
                $this->db->table('pendaftaran_detail')->insert($tbl_pendaftaran_detail);
            }
        }

        return $this->response->setJSON([
            'msg' => 'Data berhasil ditambahkan'
        ]);
    }

    public function form_edit($id)
    {
        $kode = $id;
        $user = $this->db->query("select id_user, nama_lengkap from users where is_active = 1 and role_name = 'customer'")->getResult();
        $hewan = $this->db->query("SELECT * FROM hewan WHERE id_hewan NOT IN (SELECT id_hewan FROM pendaftaran_detail);")->getResult();
        $detail_pendaftaran = $this->db->query("select * from pendaftaran_detail where id_pendaftaran = '$kode'")->getResult();
        $pendaftaran = $this->db->query("select * from pendaftaran where id_pendaftaran = '$kode'")->getRow();
        $data = [
            'kode' => $kode,
            'pemilik' => $user,
            'hewan' => $hewan,
            'detail' => $detail_pendaftaran,
            'pendaftaran' => $pendaftaran,
        ];
        return view('pendaftaran/update', $data);
    }

    public function simpan()
    {
        $data = $this->request->getVar();
        
        // update status kalo selesai daftar
        $this->db->table('pendaftaran')
            ->where('id_pendaftaran', $data['id_pendaftaran'])
            ->update([
                'id_customer' => $data['pemilik'],
                'status' => 1
            ]);
        
        return $this->response->setJSON([
            "msg" => "Data berhasil disimpan"
        ]);
    }

    public function update()
    {
        $data = $this->request->getVar();
        // print_r($data);exit;
        $id_pendaftaran = $data['id_pendaftaran'];
        $pemilik = $data['pemilik'];
        // update ke table pendaftaran
        $this->db->table('pendaftaran')
            ->where('id_pendaftaran', $id_pendaftaran)
            ->update([
                'id_user' => $pemilik
            ]);

        // hapus dulu data yang sudah ada sebelumnya
        $this->db->table('pendaftaran_detail')
            ->where('id_pendaftaran', $id_pendaftaran)
            ->delete();

        $nama_peliharaan = $this->request->getVar('nama_peliharaan');
        $jenis_peliharaan = $this->request->getVar('jenis_peliharaan');
        $warna = $this->request->getVar('warna');
        $postur = $this->request->getVar('postur');
        $tgl_lahir = $this->request->getVar('tgl_lahir');

        foreach ($nama_peliharaan as $key => $value) {
            $pendaftaran_detail = [
                'id_pendaftaran' => $id_pendaftaran,
                'id_hewan' => $jenis_peliharaan[$key],
                'nama_peliharaan' => $nama_peliharaan[$key],
                'warna' => $warna[$key],
                'postur' => $postur[$key],
                'tanggal_lahir' => date('Y-m-d', strtotime($tgl_lahir[$key])),
            ];
            $this->db->table('pendaftaran_detail')->insert($pendaftaran_detail);
        }
        return $this->response->setJSON([
            "msg" => "Perubahan data berhasil disimpan"
        ]);
    }

    public function hapus()
    {
        $id = $this->request->getVar('id_detail');
        $this->db->table('pendaftaran_detail')
            ->where('id', $id)
            ->delete();

        // session()->setFlashdata("success", "Detail berhasil dihapus.");

        // return redirect()->to(base_url('pendaftaran/form/add'));
        return $this->response->setJSON([
            "msg" => "Data berhasil dihapus"
        ]);
    }

    public function getDetail()
    {
        $id_pendaftaran = $this->request->getVar('id_pendaftaran');
        $data = $this->db->query("SELECT
            a.*,
            b.id_pendaftaran
        FROM hewan a
        JOIN pendaftaran_detail b ON a.id_hewan = b.id_hewan
        WHERE b.id_pendaftaran = '$id_pendaftaran';")->getResult();
        return $this->response->setJSON($data);

    }
}
