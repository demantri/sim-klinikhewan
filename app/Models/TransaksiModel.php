<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    public function __construct() {
        $this->db = \Config\Database::connect();
    }

    public function cekStok($data)
    {
        $id_obat = $data['obat'];
        $qty = $data['qty'];
        if (!empty($id_obat)) {
            foreach ($id_obat as $key => $value) {
                $obat = $this->db->query("select * from obat where id_obat = '$value'")->getRow();
                $stok = $obat->resep;
                
                $last_stok = $stok - $qty[$key];

                // return $last_stok;

                if ($last_stok <= 0) {
                    return $this->response->setJSON('Kode barang : ' . $value . ' Stok kurang dari 0 !', 400);
                }
            }
        }
    }

    public function createTrx($data, $id_trx)
    {
        $harga_obat = $data['harga_obat'];
        $qty = $data['qty'];
        $subtotal = 0;

        if ($harga_obat[0] == '') {
            $subtotal += 0;
        } else {
            foreach ($harga_obat as $key => $item) {
                $subtotal += $item * $qty[$key];
            }
        }

        $trx = [
            'id_ambulator' => $data['id_rekam_medis'],
            'id_transaksi' => $id_trx,
            'tgl_transaksi' => $data['tanggal'],
            'id_customer' => $data['pemilik'],
            'id_dokter' => $data['dokter'],
            'jasa_dokter' => str_replace('.', '', $data['jasa_dokter']),
            'total_transaksi' => $subtotal,
            'grand_total' => str_replace('.', '', $data['jasa_dokter']) + $subtotal,
            // 'status' => $data['id_rekam_medis'],
        ];
        $this->db->table('transaksi')->insert($trx);
    }

    public function getDataTrx()
    {
        $query = "SELECT 
            a.*,
            b.pemilik as nama_customer,
            c.nama_dokter
        FROM transaksi a 
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
        ) as c on c.id_dokter = a.id_dokter;";
        $data = $this->db->query($query)->getResult();
        return $data;
    }

    // insert detail obat
    public function insertObat($data)
    {
        $id_obat = $data['obat'];
        $qty = $data['qty'];

        if ($id_obat[0] != '') {
            foreach ($id_obat as $key => $item) {
                $obat = $this->db->query("select * from obat where id_obat = '$item'")->getRow();
                $insert = [
                    'id_ambulator' => $data['id_rekam_medis'],
                    'id_obat' => $item,
                    'nama_obat' => $obat->nama_obat,
                    'qty' => $qty[$key],
                    'harga_obat' => $obat->harga,
                    'subtotal' => $qty[$key] * $obat->harga,
                ];
                // print_r($insert);exit;
                $this->db->table('ambulator_obat_detail')->insert($insert);
            }
        }
    }

    // update stok obat
    public function updateStokObat($data)
    {
        $id_obat = $data['obat'];
        $qty = $data['qty'];
        
        if ($id_obat[0] != '') {
            foreach ($id_obat as $key => $item) {
                $obat = $this->db->query("select * from obat where id_obat = '$item'")->getRow();
                $stok = $obat->resep;
                $last_stok = $stok - $qty[$key];
    
                // update stok
                $this->db->table('obat')
                    ->where('id_obat', $item)
                    ->update([
                        'resep' => $last_stok
                    ]);
            }
        }
    }
}
