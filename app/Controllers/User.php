<?php

namespace App\Controllers;

use App\Models\CrudModel;
use App\Models\GenerateCode;
use App\Controllers\BaseController;

class User extends BaseController
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
        $user = $this->model->getData('users');
        return view('masterdata/user/index', [
            // 'kode' => $kode,
            'user' => $user,
            'validation' => $this->validator,
        ]);
    }

    public function simpan()
    {
        $rules = [
            'nama_lengkap' => [
                'label' => 'Nama lengkap',
                'rules' => 'required|min_length[4]|max_length[255]|is_unique[users.nama_lengkap]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 4 karakter',
                    'max_length' => '{field} maksimal 255 karakter',
                    'is_unique' => '{field} sudah ada sebelumnya',
                ],
            ],
            'no_telp' => [
                'label' => 'No telp',
                'rules' => 'required|max_length[15]|is_unique[users.no_telp]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    // 'min_length' => '{field} minimal 4 karakter',
                    'max_length' => '{field} maksimal 15 karakter',
                    'is_unique' => '{field} sudah ada sebelumnya',
                ],
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
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]|max_length[255]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 8 karakter',
                    'max_length' => '{field} maksimal 255 karakter',
                ],
            ],
            'confirm_password'  => [
                'label' => 'Konfirmasi password', 
                'rules' => 'matches[password]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'matches' => '{field} tidak boleh berbeda',
                ],
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required|min_length[4]|max_length[255]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 4 karakter',
                    'max_length' => '{field} maksimal 255 karakter',
                ],
            ],
            'jenis_kelamin' => [
                'label' => 'Jenis kelamin',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'role' => [
                'label' => 'Role',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
        ];

        if ($this->validate($rules)) {
            // kalau valid, simpan data
            $data = $this->request->getVar();
            $id_user = $this->code->createIDUser();
            // insert users
            $users = [
                'id_user' => $id_user,
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                'role_name' => $data['role'],
                'nama_lengkap' => $data['nama_lengkap'],
                'no_telp' => $data['no_telp'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'alamat' => $data['alamat'],
                'is_active' => 1
            ];
            $this->model->insertData($users, 'users');

            session()->setFlashdata("success", "Data berhasil disimpan");
            return redirect()->to(base_url('masterdata/user'));
        } else {
            // kalau gak valid, redirect ke form lagi
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
    }

    public function update()
    {
        $id_user = $this->request->getVar('id_user_edit');
        $rules = [
            'nama_lengkap_edit' => [
                'label' => 'Nama lengkap',
                'rules' => 'required|min_length[4]|max_length[255]|is_unique[users.nama_lengkap,id_user,'.$id_user.']',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 4 karakter',
                    'max_length' => '{field} maksimal 255 karakter',
                    'is_unique' => '{field} sudah ada sebelumnya',
                ],
            ],
            'no_telp_edit' => [
                'label' => 'No telp',
                'rules' => 'required|max_length[15]|is_unique[users.no_telp,id_user,'.$id_user.']',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    // 'min_length' => '{field} minimal 4 karakter',
                    'max_length' => '{field} maksimal 15 karakter',
                    'is_unique' => '{field} sudah ada sebelumnya',
                ],
            ],
            'alamat_edit' => [
                'label' => 'Alamat',
                'rules' => 'required|min_length[4]|max_length[255]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 4 karakter',
                    'max_length' => '{field} maksimal 255 karakter',
                ],
            ],
            'jenis_kelamin_edit' => [
                'label' => 'Jenis kelamin',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'role_edit' => [
                'label' => 'Role',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
        ];

        if ($this->validate($rules)) {
            // kalau valid, simpan data
            $data = $this->request->getVar();
            // update data
            $this->db->table('users')
                ->where('id_user', $id_user)
                ->update([
                    'role_name' => $data['role_edit'],
                    'nama_lengkap' => $data['nama_lengkap_edit'],
                    'no_telp' => $data['no_telp_edit'],
                    'jenis_kelamin' => $data['jenis_kelamin_edit'],
                    'alamat' => $data['alamat_edit']
                ]);

            session()->setFlashdata("success", "Data berhasil diubah");
            return redirect()->to(base_url('masterdata/user'));
        } else {
            // kalau gak valid, redirect ke form lagi
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
    }

    public function hapus($id)
    {
        $this->db->table('users')
            ->where('id_user', $id)
            ->delete();

        return $this->response->setJSON([
            'msg' => 'Data berhasil dihapus'
        ]);

        // session()->setFlashdata("success", "Data berhasil dihapus.");

        // return redirect()->to(base_url('masterdata/user'));
    }

    public function is_active($id)
    {
        $this->db->table('users')
            ->where('id_user', $id)
            ->update([
                'is_active' => 1
            ]);

        session()->setFlashdata("success", "Status user berhasil diubah");

        return redirect()->to(base_url('masterdata/user')); 
    }

    public function getUser()
    {
        $id_user = $this->request->getVar('id_user');
        $data = $this->db->query("select id_user, nama_lengkap, no_telp, jenis_kelamin, alamat, role_name from users where id_user = '$id_user'")->getRow();
        echo json_encode($data);
    }
}
