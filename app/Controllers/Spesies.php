<?php

namespace App\Controllers;

use App\Models\CrudModel;
use App\Models\GenerateCode;
use App\Controllers\BaseController;

class Spesies extends BaseController
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
        // return "hai";
        $spesies = $this->model->getData('spesies');
        $kode = $this->code->id_spesies();
        return view('masterdata/spesies/index', [
            'kode'   => $kode,
            'spesies'   => $spesies,
            'validation' => $this->validator,
        ]);
    }

    public function simpan()
    {
        $valid = $this->validate([
            'deskripsi' => [
                'label' => 'Deskripsi',
                'rules' => 'required|is_unique[spesies.deskripsi]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                    'is_unique' => '{field} sudah terdaftar sebelumnya.',
                ]
            ],
        ]);

        if (!$valid) {
            $spesies = $this->model->getData('spesies');
            $kode = $this->code->id_spesies();
            return view('masterdata/spesies/index', [
                'kode'   => $kode,
                'spesies'   => $spesies,
                'validation' => $this->validator,
            ]);
        } else {
            $id_spesies = $this->request->getVar('id_spesies');
            $deskripsi = $this->request->getVar('deskripsi');
            $data = [
                'id_spesies' => $id_spesies,
                'deskripsi' => $deskripsi,
            ];
            $this->model->insertData($data, 'spesies');

            session()->setFlashdata("success", "Data berhasil disimpan.");

            return redirect()->to(base_url('masterdata/spesies'));
        }
    }

    public function update()
    {
        $id = $this->request->getVar('id');

        $valid = $this->validate([
            'deskripsi_edit' => [
                'label' => 'Deskripsi',
                'rules' => 'required|is_unique[spesies.deskripsi,id_spesies,' . $id . ']',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada sebelumnya',
                ],
            ],
        ]);

        if (!$valid) {
            $spesies = $this->model->getData('spesies');
            $kode = $this->code->id_spesies();
            return view('masterdata/spesies/index', [
                'kode'   => $kode,
                'spesies'   => $spesies,
                'validation' => $this->validator,
            ]);
        } else {
            $deskripsi = $this->request->getVar('deskripsi_edit');
            $data = [
                'deskripsi' => $deskripsi,
            ];
            $this->db->table('spesies')
                ->where('id_spesies', $id)
                ->update($data);

            session()->setFlashdata("success", "Data berhasil diubah.");

            return redirect()->to(base_url('masterdata/spesies'));
        }
    }

    public function hapus($id)
    {
        $this->db->table('spesies')
            ->where('id_spesies', $id)
            ->delete();

        session()->setFlashdata("success", "Data berhasil dihapus.");

        return redirect()->to(base_url('masterdata/spesies'));
    }
}
