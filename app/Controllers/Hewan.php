<?php

namespace App\Controllers;

use App\Models\CrudModel;
use App\Models\GenerateCode;
use App\Controllers\BaseController;

class Hewan extends BaseController
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
        $id_hewan = $this->code->id_hewan();
        $list = $this->model->getData('hewan');
        $data = [
            'kode' => $id_hewan,
            'list' => $list
        ];
        return view('masterdata/hewan/index', $data);
    }

    public function simpan()
    {
        $rules = [
            'nama_peliharaan' => [
                'label' => 'Nama peliharaan',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 3 karakter',
                ],
            ],
            'tanggal_lahir' => [
                'label' => 'Tanggal lahir',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 3 karakter',
                ],
            ],
            'jenis_kelamin' => [
                'label' => 'Jenis kelamin',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 3 karakter',
                ],
            ],
            'warna' => [
                'label' => 'Warna',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 3 karakter',
                ],
            ],
            'postur' => [
                'label' => 'Postur',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 3 karakter',
                ],
            ],
            'spesies' => [
                'label' => 'Spesies',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 3 karakter',
                ],
            ],
            'ras' => [
                'label' => 'Ras',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 3 karakter',
                ],
            ],
        ];

        if ($this->validate($rules)) {
            // kalau valid, simpan data
            $data = $this->request->getVar();
            // insert data
            $hewan = [
                'id_hewan' => $data['id_hewan'],
                'nama' => $data['nama_peliharaan'],
                'warna' => $data['warna'],
                'postur' => $data['postur'],
                'tanggal_lahir' => $data['tanggal_lahir'],
                'spesies' => $data['spesies'],
                'ras' => $data['ras'],
                'jenis_kelamin' => $data['jenis_kelamin'],
            ];
            $this->model->insertData($hewan, 'hewan');

            session()->setFlashdata("success", "Data berhasil disimpan");
            return redirect()->to(base_url('masterdata/hewan'));
        } else {
            // kalau gak valid, redirect ke form lagi
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
    }

    public function update()
    {
        $id_hewan = $this->request->getVar('id_hewan_edit');
        $rules = [
            'nama_peliharaan_edit' => [
                'label' => 'Nama peliharaan',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 3 karakter',
                ],
            ],
            'tanggal_lahir_edit' => [
                'label' => 'Tanggal lahir',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 3 karakter',
                ],
            ],
            'jenis_kelamin_edit' => [
                'label' => 'Jenis kelamin',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 3 karakter',
                ],
            ],
            'warna_edit' => [
                'label' => 'Warna',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 3 karakter',
                ],
            ],
            'postur_edit' => [
                'label' => 'Postur',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 3 karakter',
                ],
            ],
            'spesies_edit' => [
                'label' => 'Spesies',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 3 karakter',
                ],
            ],
            'ras_edit' => [
                'label' => 'Ras',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 3 karakter',
                ],
            ],
        ];

        if ($this->validate($rules)) {
            // kalau valid, simpan data
            $data = $this->request->getVar();
            $this->db->table('hewan')
                ->where('id_hewan', $id_hewan)
                ->update([
                    'nama' => $data['nama_peliharaan_edit'],
                    'warna' => $data['warna_edit'],
                    'postur' => $data['postur_edit'],
                    'tanggal_lahir' => $data['tanggal_lahir_edit'],
                    'spesies' => $data['spesies_edit'],
                    'ras' => $data['ras_edit'],
                    'jenis_kelamin' => $data['jenis_kelamin_edit'],
                ]);
            session()->setFlashdata("success", "Data berhasil diupdate");
            return redirect()->to(base_url('masterdata/hewan'));
        } else {
            // kalau gak valid, redirect ke form lagi
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
    }

    public function hapus($id)
    {
        $this->db->table('hewan')
            ->where('id_hewan', $id)
            ->delete();

        return $this->response->setJSON([
            'msg' => 'Data berhasil dihapus'
        ]);

        // session()->setFlashdata("success", "Data berhasil dihapus.");

        // return redirect()->to(base_url('masterdata/hewan'));
    }

    public function getData()
    {
        $id_hewan = $this->request->getVar('id_hewan');
        $data = $this->db->query("select * from hewan where id_hewan = '$id_hewan'")->getRow();
        return $this->response->setJSON($data);
    }
}
