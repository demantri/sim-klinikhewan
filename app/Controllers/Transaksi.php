<?php

namespace App\Controllers;

use App\Models\GenerateCode;
use App\Models\TransaksiModel;
use App\Controllers\BaseController;

class Transaksi extends BaseController
{
    public function __construct() {
        $this->trx = new TransaksiModel;
        $this->db = db_connect();
    }

    public function index()
    {
        $trx = $this->trx->getDataTrx();
        $transaksi = $this->db->query("select * from transaksi where status = 0")->getResult();
        $data = [
            'trx' => $trx,
            'transaksi' => $transaksi
        ];
        return view('rekam-medis/pembayaran/index', $data);
    }

    public function bayar()
    {
        $id_kasir = session()->get('id_user');
        $id_trx = $this->request->getVar('id_trx');
        // update status
        $this->db->table('transaksi')
            ->where('id_transaksi', $id_trx)
            ->update([
                'status' => 1,
                'id_kasir' => $id_kasir
            ]);

        return $this->response->setJSON([
            'msg' => 'Data berhasil disimpan'
        ], 200);
    }

    public function addToDetail()
    {
        $id_trx = $this->request->getVar('id_trx');
        $jml = count($id_trx);
        $array = [];
        $total = 0;
        $invoice = rand();
        foreach ($id_trx as $key => $value) {
            $grandtotal = $this->db->query("select * from transaksi where id_transaksi = '$value'")->getRow();
            $total = $grandtotal->grand_total;
            // insert ke tabel transaksi detail
            $data = [
                'invoice' => $invoice,
                'id_transaksi' => $value,
                'total_trx' => $total
            ];
            $this->db->table('transaksi_detail')
                ->insert($data);
        }

        // sum total trx based invoice
        $transaksi_detail = $this->db->query("select * from transaksi_detail where invoice = '$invoice'")->getResult();
        $grandtotal_invoice = 0;
        foreach ($transaksi_detail as $key => $value) {
            $grandtotal_invoice += $value->total_trx;
        }

        $invoice = [
            'invoice' => $invoice,
            'grandtotal' => $grandtotal_invoice,
        ];
        $this->db->table('invoice')
            ->insert($invoice);

        return $this->response->setJSON([
            'msg' => 'Berhasil di tambah',
            'data' => $invoice
        ], 200);
    }

    public function prosesMultiple()
    {
        $id_trx = $this->request->getVar('id_trx');
        $id_kasir = session()->get('id_user');
        foreach ($id_trx as $key => $value) {
            $this->db->table('transaksi')
                ->where('id_transaksi', $value)
                ->update([
                    'status' => 1,
                    'id_kasir' => $id_kasir
                ]);
        }

        return $this->response->setJSON([
            'msg' => 'Data berhasil disimpan'
        ], 200);
    }

    public function reset()
    {
        $data = $this->request->getVar('id_trx');

        foreach ($data as $key => $value) {
            $this->db->table('transaksi_detail')
                ->where('id_transaksi', $value)
                ->delete();
        }

        return $this->response->setJSON([
            'msg' => 'Data berhasil direset'
        ], 200);
    }
}
