<?php

namespace App\Controllers;

use App\Models\CrudModel;
use App\Models\GenerateCode;
use App\Controllers\BaseController;

class Obat extends BaseController
{
    public function __construct()
    {
        $this->model = new CrudModel;
        $this->code = new GenerateCode;
        helper('form');
        $this->db = db_connect();
    }

    public function index()
    {
        $obat = $this->model->getData('obat');
        $kode = $this->code->createIDObat();
        return view('masterdata/obat/index', [
            'kode' => $kode,
            'obat' => $obat,
            'validation' => $this->validator,
        ]);
    }

    public function simpan()
    {
        $valid = $this->validate([
            'nama_obat' => [
                'label' => 'Nama Obat',
                'rules' => 'required|min_length[4]|max_length[255]|is_unique[obat.nama_obat]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 4 karakter',
                    'max_length' => '{field} maksimal 255 karakter',
                    'is_unique' => '{field} sudah ada sebelumnya',
                ],
            ],
            'harga' => [
                'label' => 'Harga',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'stok' => [
                'label' => 'Jumlah resep',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                ]
            ],
            'tgl_expired' => [
                'label' => 'Tanggal expired',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                ]
            ],
        ]);

        if (!$valid) {
            $obat = $this->model->getData('obat');
            $kode = $this->code->createIDObat();
            return view('masterdata/obat/index', [
                'kode' => $kode,
                'obat' => $obat,
                'validation' => $this->validator,
            ]);
        } else {
            $post = $this->request->getVar();

            $data = [
                'id_obat' => $post['id_obat'],
                'nama_obat' => $post['nama_obat'],
                'harga' => str_replace('.', '', $post['harga']),
                'resep' => $post['stok'],
                'tgl_expired' => $post['tgl_expired'],
            ];

            $this->model->insertData($data, 'obat');

            session()->setFlashdata("success", "Data berhasil disimpan.");

            return redirect()->to(base_url('masterdata/obat'));
        }
    }

    public function update()
    {
        $id = $this->request->getVar('id_obat_edit');
        $valid = $this->validate([
            'nama_obat_edit' => [
                'label' => 'Nama Obat',
                'rules' => 'required|min_length[4]|max_length[255]|is_unique[obat.nama_obat,id_obat,'.$id.']',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 4 karakter',
                    'max_length' => '{field} maksimal 255 karakter',
                    'is_unique' => '{field} sudah ada sebelumnya',
                ],
            ],
            'harga_edit' => [
                'label' => 'Harga',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'stok_edit' => [
                'label' => 'Jumlah resep',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                ]
            ],
            'tgl_expired_edit' => [
                'label' => 'Tanggal expired',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                ]
            ],
        ]);
        if (!$valid) {
            // kalau gak valid, redirect ke form lagi
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            $post = $this->request->getVar();

            $data = [
                'nama_obat' => $post['nama_obat_edit'],
                'harga' => str_replace('.', '', $post['harga_edit']),
                'resep' => $post['stok_edit'],
                'tgl_expired' => $post['tgl_expired_edit'],
            ];

            $this->db->table('obat')
                ->where('id_obat', $post['id_obat_edit'])
                ->update($data);

            session()->setFlashdata("success", "Data berhasil diubah.");

            return redirect()->to(base_url('masterdata/obat'));
        }
    }

    public function hapus($id)
    {
        $this->db->table('obat')
            ->where('id', $id)
            ->delete();

        return $this->response->setJSON([
            'msg' => 'Data berhasil dihapus'
        ]);

        // session()->setFlashdata("success", "Data berhasil dihapus.");

        // return redirect()->to(base_url('masterdata/obat'));
    }
}
