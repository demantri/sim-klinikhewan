<?php

namespace App\Controllers;

use App\Models\CrudModel;
use App\Models\GenerateCode;
use App\Controllers\BaseController;

class Kategori extends BaseController
{
    public function __construct() {
        $this->model = new CrudModel();
        $this->code = new GenerateCode;
        helper('form');
        $this->db = db_connect();
    }

    public function index()
    {
        $kategori = $this->model->getData('dropdown');
        return view('masterdata/kategori/index', [
            'kategori'   => $kategori,
            'validation' => $this->validator,
        ]);
    }

    public function simpan()
    {
        $valid = $this->validate([
            'jenis' => [
                'label' => 'Jenis kategori',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                ]
            ],
            'deskripsi' => [
                'label' => 'Deskripsi',
                'rules' => 'required|is_unique[dropdown.deskripsi,id]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                    'is_unique' => '{field} sudah terdaftar sebelumnya.',
                ]
            ],
        ]);

        if (!$valid) {
            $kategori = $this->model->getData('dropdown');
            return view('masterdata/kategori/index', [
                'kategori'   => $kategori,
                'validation' => $this->validator,
            ]);
        } else {
            $deskripsi = $this->request->getVar('deskripsi');
            $jenis = $this->request->getVar('jenis');
    
            $data = [
                'deskripsi' => $deskripsi,
                'jenis' => $jenis,
            ];
            $this->model->insertData($data, 'dropdown');
            
            session()->setFlashdata("success", "Data berhasil disimpan.");
    
            return redirect()->to(base_url('masterdata/kategori'));
        }
    }

    public function update()
    {
        $id = $this->request->getVar('id');
        $jenis = $this->request->getVar('jenis');
        $deskripsi = $this->request->getVar('deskripsi');

        $data = [
            'deskripsi' => $deskripsi,
            'jenis' => $jenis
        ];
        $this->db->table('dropdown')
            ->where('id', $id)
            ->update($data);

        session()->setFlashdata("success", "Data berhasil diubah.");

        return redirect()->to(base_url('masterdata/kategori'));
    }

    public function hapus($id)
    {
        $this->db->table('dropdown')
            ->where('id', $id)
            ->delete();

        session()->setFlashdata("success", "Data berhasil dihapus.");

        return redirect()->to(base_url('masterdata/kategori'));
    }
}
