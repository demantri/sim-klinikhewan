<?php

namespace App\Models;

use CodeIgniter\Model;

class GenerateCode extends Model
{
    public function __construct()
    {
        $this->db = db_connect();
    }

    // gak dipake
    // public function createIDPemilik()
    // {
    //     $query = $this->db->query("select right(id_pemilik, 3) as kode from pemilik order by id desc limit 1");

    //     if (count($query->getResult()) <> 0) { // cek kondisi, kalau hasil data nya tidak = 0.
    //         $data = $query->getRow();
    //         $kode = intval($data->kode) + 1;
    //     } else {
    //         $kode = 1;
    //     }

    //     $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
    //     $kd = "P-" . $kodemax;
    //     return $kd;
    // }

    public function kode_booking()
    {
        $query = $this->db->query("select right(kode_booking, 3) as kode from booking order by kode_booking desc limit 1");

        if (count($query->getResult()) <> 0) { // cek kondisi, kalau hasil data nya tidak = 0.
            $data = $query->getRow();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $date = date('Ymd');
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kd = "B-" . $date . $kodemax;
        return $kd;
    }

    public function id_ras()
    {
        $query = $this->db->query("select right(id_ras, 3) as kode from ras order by id_ras desc limit 1");

        if (count($query->getResult()) <> 0) { // cek kondisi, kalau hasil data nya tidak = 0.
            $data = $query->getRow();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kd = "R-" . $kodemax;
        return $kd;
    }

    public function id_spesies()
    {
        $query = $this->db->query("select right(id_spesies, 3) as kode from spesies order by id_spesies desc limit 1");

        if (count($query->getResult()) <> 0) { // cek kondisi, kalau hasil data nya tidak = 0.
            $data = $query->getRow();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kd = "SP-" . $kodemax;
        return $kd;
    }

    public function id_peliharaan()
    {
        $query = $this->db->query("select right(id_peliharaan, 3) as kode from peliharaan order by id_peliharaan desc limit 1");
        if (count($query->getResult()) <> 0) { // cek kondisi, kalau hasil data nya tidak = 0.
            $data = $query->getRow();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kd = "P-" . $kodemax;
        return $kd;
    }

    public function id_hewan()
    {
        $query = $this->db->query("select right(id_hewan, 3) as kode from hewan order by id_hewan desc limit 1");
        if (count($query->getResult()) <> 0) { // cek kondisi, kalau hasil data nya tidak = 0.
            $data = $query->getRow();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kd = "H-" . $kodemax;
        return $kd;
    }

    public function createIDPendaftaran()
    {
        $query = $this->db->query("select right(id_pendaftaran, 4) as kode from pendaftaran where status <> 0 order by id_pendaftaran desc limit 1");
        if (count($query->getResult()) <> 0) { // cek kondisi, kalau hasil data nya tidak = 0.
            $data = $query->getRow();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kd = "RGST" . date('Ymd') . $kodemax;
        return $kd;
    }

    public function createIDRM()
    {
        $query = $this->db->query("select right(id_ambulator, 4) as kode from ambulator where status <> 0 order by id_ambulator desc limit 1");

        if (count($query->getResult()) <> 0) { // cek kondisi, kalau hasil data nya tidak = 0.
            $data = $query->getRow();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kd = "RM-" . date('Ymd') . $kodemax;
        return $kd;
    }

    public function createIDDokter()
    {
        $query = $this->db->query("select right(id_dokter, 3) as kode from dokter order by id desc limit 1");

        if (count($query->getResult()) <> 0) { // cek kondisi, kalau hasil data nya tidak = 0.
            $data = $query->getRow();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kd = "D-" . $kodemax;
        return $kd;
    }

    public function createIDObat()
    {
        $query = $this->db->query("select right(id_obat, 3) as kode from obat order by id desc limit 1");

        if (count($query->getResult()) <> 0) { // cek kondisi, kalau hasil data nya tidak = 0.
            $data = $query->getRow();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kd = "O-" . $kodemax;
        return $kd;
    }

    public function createIDUser()
    {
        $query = $this->db->query("select right(id_user, 3) as kode from users order by id_user desc limit 1");

        if (count($query->getResult()) <> 0) { // cek kondisi, kalau hasil data nya tidak = 0.
            $data = $query->getRow();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kd = "U-" . $kodemax;
        return $kd;
    }

    public function createTrxCode()
    {
        $query = $this->db->query("select right(id_trx, 3) as kode from transaksi order by id_trx desc limit 1;");
        if (count($query->getResult()) <> 0) { // cek kondisi, kalau hasil data nya tidak = 0.
            $data = $query->getRow();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);

        $date = date('Ymd');

        $kd = "TRX-" . $date . $kodemax;

        return $kd;
    }
}
