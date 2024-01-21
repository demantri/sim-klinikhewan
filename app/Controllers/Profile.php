<?php

namespace App\Controllers;

use App\Models\CrudModel;
use App\Models\GenerateCode;
use App\Controllers\BaseController;

class Profile extends BaseController
{
    public function __construct() {
        $this->model = new CrudModel;
        $this->code = new GenerateCode;
        helper('form');
        $this->db = db_connect();
    }
    
    public function index()
    {
        $username = session()->get('username');
        $id_user = session()->get('id_user');
        $role = session()->get('role_name');
        $query = "select * from users where id_user = '$id_user'";
        $profile = $this->db->query($query)->getRow();
        $data = [
            'profile' => $profile
        ];

        return view('setting/profile/index', $data);
    }

    public function update()
    {
        $data = $this->request->getVar();
        $foto = $this->request->getFile('foto');
        if (!$foto->getError() == 4) {
            // kalau update foto, update ke pemilik
            $file_name = $foto->getRandomName();
            $ext = $foto->guessExtension();
            
            $this->db->table('users')
                ->where('id_user', $data['id_user'])
                ->update([
                    'foto_profil' => $file_name
                ]);

            $foto->move('uploads/image/', $file_name);
        }

        // yang baru langsung update ke user 
        $this->db->table('users')
            ->where('id_user', $data['id_user'])
            ->update([
                'username' => $data['username'],
                'email' => $data['email'],
                'nama_lengkap' => $data['nama_lengkap'],
                'no_telp' => $data['no_telp'],
                'alamat' => $data['alamat'],
            ]);

        session()->setFlashdata('success', 'Data berhasil diupdate');
        // session()->destroy();
        return redirect()->to(base_url('setting/profile'));
    }

    public function delete_image($id) 
    {
        $users = $this->db->query("select * from users where id_user = '$id'")->getRow();
        
        $file_name = $users->foto_profil;
        
        // hapus yg ada difolder uploads/image
        $path_to_file = 'uploads/image/';

        unlink(FCPATH.$path_to_file.$file_name);

        $this->db->table('users')
            ->where('id_user', $id)
            ->update([
                'foto_profil' => null
            ]);

        session()->setFlashdata('success', 'Foto profile berhasil dihapus');
        // session()->destroy();
        return redirect()->to(base_url('setting/profile'));
    }

    public function check_password()
    {
        $id_user = $this->request->getVar('id_user');
        $password_lama = $this->request->getVar('password_lama');
        // get password lama
        $users = $this->db->query("select password from users where id_user = '$id_user'")->getRow();
        if ($users) {
            $password_user = $users->password;
            $verify_pass = password_verify($password_lama, $password_user);
            if ($verify_pass) {
                $data = [
                    'msg' => 'Berhasil',
                    'status' => true
                ];
                return $this->response->setJSON($data);
            } else {
                $data = [
                    'msg' => 'Password tidak sama',
                    'status' => false
                ];
                return $this->response->setJSON($data);
            }
        }
    }

    public function reset_password()
    {
        $data = $this->request->getVar();
        $id_user = $data['id_user_reset'];
        $password = $data['password_baru'];

        $this->db->table('users')
            ->where('id_user', $id_user)
            ->update([
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ]);

        $data = [
            'msg' => 'Password berhasil diubah',
            'status' => true
        ];
        return $this->response->setJSON($data);
    }
}
