<?php

namespace App\Controllers;

use App\Models\CrudModel;
use App\Models\GenerateCode;
use App\Controllers\BaseController;

class Ras extends BaseController
{
    public function __construct()
    {
        $this->model = new CrudModel();
        $this->code = new GenerateCode;
        helper('form');
        $this->db = db_connect();
    }

    public function index()
    {
        $ras = $this->model->getData('ras');
        $kode = $this->code->id_ras();
        return view('masterdata/ras/index', [
            'kode'   => $kode,
            'ras'   => $ras,
            'validation' => $this->validator,
        ]);
    }

    public function simpan()
    {
        $valid = $this->validate([
            'deskripsi' => [
                'label' => 'Deskripsi',
                'rules' => 'required|is_unique[ras.deskripsi]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                    'is_unique' => '{field} sudah terdaftar sebelumnya.',
                ]
            ],
        ]);

        if (!$valid) {
            $ras = $this->model->getData('ras');
            $kode = $this->code->id_ras();
            return view('masterdata/ras/index', [
                'kode'   => $kode,
                'ras'   => $ras,
                'validation' => $this->validator,
            ]);
        } else {
            $id_ras = $this->request->getVar('id_ras');
            $deskripsi = $this->request->getVar('deskripsi');
            $data = [
                'id_ras' => $id_ras,
                'deskripsi' => $deskripsi,
            ];
            $this->model->insertData($data, 'ras');

            session()->setFlashdata("success", "Data berhasil disimpan.");

            return redirect()->to(base_url('masterdata/ras'));
        }
    }

    public function update()
    {
        $id = $this->request->getVar('id');

        $valid = $this->validate([
            'deskripsi_edit' => [
                'label' => 'Deskripsi',
                'rules' => 'required|is_unique[ras.deskripsi,id_ras,' . $id . ']',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada sebelumnya',
                ],
            ],
        ]);

        if (!$valid) {
            $ras = $this->model->getData('ras');
            $kode = $this->code->id_ras();
            return view('masterdata/ras/index', [
                'kode'   => $kode,
                'ras'   => $ras,
                'validation' => $this->validator,
            ]);
        } else {
            $deskripsi = $this->request->getVar('deskripsi_edit');
            $data = [
                'deskripsi' => $deskripsi,
            ];
            $this->db->table('ras')
                ->where('id_ras', $id)
                ->update($data);

            session()->setFlashdata("success", "Data berhasil diubah.");

            return redirect()->to(base_url('masterdata/ras'));
        }
    }

    public function hapus($id)
    {
        $this->db->table('ras')
            ->where('id_ras', $id)
            ->delete();

        session()->setFlashdata("success", "Data berhasil dihapus.");

        return redirect()->to(base_url('masterdata/ras'));
    }
}
