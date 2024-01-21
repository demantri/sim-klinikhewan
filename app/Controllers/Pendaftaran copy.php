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
        $pendaftaran = $this->model->getDataPendaftaran();
        $data = [
            'pendaftaran' => $pendaftaran
        ];
        return view('pendaftaran/index', $data);
    }

    public function form_add()
    {
        $kode = $this->code->createIDPendaftaran();
        $spesies = $this->model->getData('spesies');
        $ras = $this->model->getData('ras');
        // $pemilik = $this->model->getDataAkun('customer');
        $pemilik = $this->model->getDataIsRegister('customer');
        $data = [
            'kode' => $kode,
            'spesies' => $spesies,
            'ras' => $ras,
            'pemilik' => $pemilik,
        ];
        return view('pendaftaran/add', $data);
    }

    public function form_edit($id)
    {
        $spesies = $this->model->getData('spesies');
        $ras = $this->model->getData('ras');
        // $pemilik = $this->model->getDataAkun('customer');
        $pemilik = $this->model->getDataIsRegister('customer');
        $pendaftaran = $this->model->getPeliharaanByID($id);
        $data = [
            'spesies' => $spesies,
            'ras' => $ras,
            'pemilik' => $pemilik,
            'pendaftaran' => $pendaftaran,
        ];
        return view('pendaftaran/update', $data);
    }

    public function simpan()
    {
        // $data = $this->request->getVar();
        // print_r($data);
        // exit;
        $valid = $this->validate([
            'id_pendaftaran' => [
                'label' => 'ID pendaftaran',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'pemilik' => [
                'label' => 'Pemilik',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'nama_peliharaan' => [
                'label' => 'Nama peliharaan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'tgl_lahir' => [
                'label' => 'Tgl lahir',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'jenis_kelamin' => [
                'label' => 'Jenis kelamin',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'spesies' => [
                'label' => 'Spesies',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'ras' => [
                'label' => 'Ras',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'warna_rambut' => [
                'label' => 'Warna rambut',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'postur_tubuh' => [
                'label' => 'Postur tubuh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
        ]);

        if (!$valid) {
            $kode = $this->code->createIDPendaftaran();
            $spesies = $this->model->getData('spesies');
            $ras = $this->model->getData('ras');
            // $pemilik = $this->model->getDataAkun('customer');
            $pemilik = $this->model->getDataIsRegister('customer');
            $data = [
                'kode' => $kode,
                'spesies' => $spesies,
                'ras' => $ras,
                'pemilik' => $pemilik,
            ];
            $data['validation'] = $this->validator;
            return view('pendaftaran/add', $data);
        } else {
            $id_pendaftaran = $this->request->getVar('id_pendaftaran');
            $pemilik = $this->request->getVar('pemilik');
            $nama_peliharaan = $this->request->getVar('nama_peliharaan');
            $tgl_lahir = $this->request->getVar('tgl_lahir');
            $jenis_kelamin = $this->request->getVar('jenis_kelamin');
            $spesies = $this->request->getVar('spesies');
            $ras = $this->request->getVar('ras');
            $warna_rambut = $this->request->getVar('warna_rambut');
            $postur_tubuh = $this->request->getVar('postur_tubuh');

            $data = [
                'id_pendaftaran' => $id_pendaftaran,
                'nama_peliharaan' => $nama_peliharaan,
                'tgl_lahir' => $tgl_lahir,
                'jenis_kelamin' => $jenis_kelamin,
                'id_spesies' => $spesies,
                'id_ras' => $ras,
                'warna' => $warna_rambut,
                'postur' => $postur_tubuh,
                'id_pemilik' => $pemilik,
            ];

            $this->model->insertData($data, 'pendaftaran');

            session()->setFlashdata("success", "Data berhasil disimpan.");

            return redirect()->to(base_url('pendaftaran'));
        }
    }

    public function update()
    {
        $valid = $this->validate([
            'id_pendaftaran' => [
                'label' => 'ID pendaftaran',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'pemilik' => [
                'label' => 'Pemilik',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'nama_peliharaan' => [
                'label' => 'Nama peliharaan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'tgl_lahir' => [
                'label' => 'Tgl lahir',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'jenis_kelamin' => [
                'label' => 'Jenis kelamin',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'spesies' => [
                'label' => 'Spesies',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'ras' => [
                'label' => 'Ras',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
        ]);

        if (!$valid) {
            $spesies = $this->model->getData('spesies');
            $ras = $this->model->getData('ras');
            // $pemilik = $this->model->getDataAkun('customer');
            $pemilik = $this->model->getDataIsRegister('customer');
            $pendaftaran = $this->model->getPeliharaanByID($id);
            $data = [
                'spesies' => $spesies,
                'ras' => $ras,
                'pemilik' => $pemilik,
                'pendaftaran' => $pendaftaran,
            ];
            $data['validation'] = $this->validator;
            return view('pendaftaran/update', $data);
        } else {
            $id_pendaftaran = $this->request->getVar('id_pendaftaran');
            $pemilik = $this->request->getVar('pemilik');
            $nama_peliharaan = $this->request->getVar('nama_peliharaan');
            $tgl_lahir = $this->request->getVar('tgl_lahir');
            $jenis_kelamin = $this->request->getVar('jenis_kelamin');
            $spesies = $this->request->getVar('spesies');
            $ras = $this->request->getVar('ras');
            $warna_rambut = $this->request->getVar('warna_rambut');
            $postur_tubuh = $this->request->getVar('postur_tubuh');

            $data = [
                // 'id_pendaftaran' => $id_pendaftaran,
                'nama_peliharaan' => $nama_peliharaan,
                'tgl_lahir' => $tgl_lahir,
                'jenis_kelamin' => $jenis_kelamin,
                'id_spesies' => $spesies,
                'id_ras' => $ras,
                'warna' => $warna_rambut,
                'postur' => $postur_tubuh,
                'id_pemilik' => $pemilik,
            ];

            $this->model->updateData('pendaftaran', $id_pendaftaran, $data);

            session()->setFlashdata("success", "Data berhasil diubah.");

            return redirect()->to(base_url('pendaftaran'));
        }
    }

    public function hapus($id)
    {
        $this->db->table('pendaftaran')
            ->where('id_pendaftaran', $id)
            ->delete();

        session()->setFlashdata("success", "Data berhasil diubah.");

        return redirect()->to(base_url('pendaftaran'));
    }
}
