<?php

namespace App\Models;

use CodeIgniter\Model;

class CrudModel extends Model
{
    public function __construct()
    {
        $this->db = db_connect();
    }

    public function getDataAkun($jenis)
    {
        $data = $this->db->query("select a.*, b.role_name
        from pemilik a 
        join users b on a.id_user = b.id_user
        where role_name = '$jenis';")->getResult();
        return $data;
    }

    public function getDataIsRegister($jenis)
    {
        $data = $this->db->query("select a.*, b.role_name
        from pemilik a 
        join users b on a.id_user = b.id_user
        where role_name = '$jenis'
        and is_register != 0;")->getResult();
        return $data;
    }

    public function getData($table)
    {
        $data = $this->db->table($table)
            ->get()
            ->getResult();

        return $data;
    }

    public function getPeliharaanByID($id)
    {
        $data = $this->db->query("select * from pendaftaran where id_pendaftaran = '$id'")->getRow();
        return $data;
    }

    public function getSpesies()
    {
        $data = $this->db->query("select * from dropdown where jenis = 'spesies'")->getResult();
        return $data;
    }

    public function getRas()
    {
        $data = $this->db->query("select * from dropdown where jenis = 'ras'")->getResult();
        return $data;
    }

    public function getDataPendaftaran()
    {
        $data = $this->db->query("select a.*, b.nama_lengkap as nama_pemilik 
        from pendaftaran a join pemilik b on a.id_pemilik = b.id_pemilik");
        return $data->getResult();
    }

    public function insertData($data, $table)
    {
        return $this->db->table($table)
            ->insert($data);
    }

    public function updateData($table, $id, $data)
    {
        return $this->db->table($table)
            ->where('id_pendaftaran', $id)
            ->update($data);
    }
}
