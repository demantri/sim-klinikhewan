<?php

namespace App\Controllers;

use App\Models\CrudModel;
use App\Models\GenerateCode;
use App\Controllers\BaseController;

class Dokter extends BaseController
{
    public function __construct() {
        $this->model = new CrudModel();
        $this->code = new GenerateCode;
        helper('form');
        $this->db = db_connect();
    }

    public function index()
    {
        $dokter = $this->model->getData('dokter');
        $id_user = $this->code->createIDUser();
        $kode = $this->code->createIDDokter();
        return view('masterdata/dokter/index', [
            'id_user'   => $id_user,
            'dokter'   => $dokter,
            'kode'   => $kode,
            'validation' => $this->validator,
        ]);
    }

    public function simpan()
    {

        $valid = $this->validate([
            'nama_lengkap' => [
                'label' => 'Nama lengkap',
                'rules' => 'required|min_length[4]|max_length[255]|is_unique[pemilik.nama_lengkap]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 4 karakter',
                    'max_length' => '{field} maksimal 255 karakter',
                    'is_unique' => '{field} sudah ada sebelumnya',
                ],
            ],
            'no_telp' => [
                'label' => 'No telp',
                'rules' => 'required|max_length[15]|is_unique[pemilik.no_telp]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    // 'min_length' => '{field} minimal 4 karakter',
                    'max_length' => '{field} maksimal 15 karakter',
                    'is_unique' => '{field} sudah ada sebelumnya',
                ],
            ],
            'jenis_kelamin' => [
                'label' => 'Jenis kelamin',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                ]
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                ]
            ],
            'username' => [
                'label' => 'Username',
                'rules' => 'required|min_length[4]|max_length[255]|is_unique[users.username]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 4 karakter',
                    'max_length' => '{field} maksimal 255 karakter',
                    'is_unique' => '{field} sudah ada sebelumnya',
                ],
            ],
        ]);

        if (!$valid) {
            $dokter = $this->model->getData('dokter');
            $kode = $this->code->createIDDokter();
            return view('masterdata/dokter/index', [
                'dokter'   => $dokter,
                'kode'   => $kode,
                'validation' => $this->validator,
            ]);
        } else {
            $id_user = $this->request->getVar('id_user');
            $id_dokter = $this->request->getVar('id_dokter');
            $nama_lengkap = $this->request->getVar('nama_lengkap');
            $no_telp = $this->request->getVar('no_telp');
            $jenis_kelamin = $this->request->getVar('jenis_kelamin');
            $alamat = $this->request->getVar('alamat');
    
            // insert ke table dokter
            $data = [
                'id_dokter' => $id_dokter,
                'nama_lengkap' => $nama_lengkap,
                'no_telp' => $no_telp,
                'jenis_kelamin' => $jenis_kelamin,
                'alamat' => $alamat,
            ];
            $this->model->insertData($data, 'dokter');

            // insert ke table users
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $role_name = $this->request->getVar('role_name');
            $users = [
                'id_user' => $id_user,
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role_name' => $role_name,
            ];
            $this->model->insertData($users, 'users');
            
            session()->setFlashdata("success", "Data berhasil disimpan.");
    
            return redirect()->to(base_url('masterdata/dokter'));
        }
    }
    
    public function update()
    {
        $id = $this->request->getVar('id');
        $valid = $this->validate([
            'nama_lengkap_edit' => [
                'label' => 'Nama lengkap',
                'rules' => 'required|min_length[4]|max_length[255]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 4 karakter',
                    'max_length' => '{field} maksimal 255 karakter',
                    // 'is_unique' => '{field} sudah ada sebelumnya',
                ],
            ],
            'no_telp_edit' => [
                'label' => 'No telp',
                'rules' => 'required|max_length[15]|is_unique[dokter.no_telp,id,'.$id.']',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    // 'min_length' => '{field} minimal 4 karakter',
                    'max_length' => '{field} maksimal 15 karakter',
                    'is_unique' => '{field} sudah ada sebelumnya',
                ],
            ],
            'jenis_kelamin_edit' => [
                'label' => 'Jenis kelamin',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                ]
            ],
            'alamat_edit' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                ]
            ],
        ]);
        if (!$valid) {
            $dokter = $this->model->getData('dokter');
            $id_user = $this->code->createIDUser();
            $kode = $this->code->createIDDokter();
            return view('masterdata/dokter/index', [
                'id_user'   => $id_user,
                'dokter'   => $dokter,
                'kode'   => $kode,
                'validation' => $this->validator,
            ]);
        } else {
            $post = $this->request->getVar();
            $data = [
                'nama_lengkap' => $post['nama_lengkap_edit'],
                'no_telp' => $post['no_telp_edit'],
                'jenis_kelamin' => $post['jenis_kelamin_edit'],
                'alamat' => $post['alamat_edit']
            ];

            $this->db->table('dokter')
                ->where('id_dokter', $post['id_dokter'])
                ->update($data);

            session()->setFlashdata("success", "Data berhasil diubah.");

            return redirect()->to(base_url('masterdata/dokter'));
        }
    }

    public function hapus($id)
    {
        $this->db->table('dokter')
            ->where('id', $id)
            ->delete();

        session()->setFlashdata("success", "Data berhasil dihapus.");

        return redirect()->to(base_url('masterdata/dokter'));
    }
}
