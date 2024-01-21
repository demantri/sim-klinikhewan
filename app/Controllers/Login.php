<?php

namespace App\Controllers;

use App\Models\LoginModel;
use App\Controllers\BaseController;
use App\Models\CrudModel;
use App\Models\GenerateCode;

class Login extends BaseController
{
    public function __construct() {
        $this->login_model = new LoginModel;
        $this->code = new GenerateCode;
        $this->model = new CrudModel;
        $this->db = db_connect();
        $this->uri = service('uri');
    }
    
    public function index()
    {
        // return view('auth/index');
        return view('auth/new_login');
    }

    public function doLogin()
    {
        $session = session();

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        // cek user di database
        $data = $this->login_model->getUser($username);
        // print_r($username);die;

        if($data){
            $pass = $data->password;
            $verify_pass = password_verify($password, $pass);
            if($verify_pass){
                if ($data->is_active != 1) {
                    $session->setFlashdata('warning', 'Akun sudah tidak aktif.');
                    return redirect()->to(base_url('login'));
                }
                $ses_data = [
                    // 'id' => $data->id,
                    'id_user' => $data->id_user,
                    'role_name' => $data->role_name,
                    'username' => $data->username,
                    // 'nama_lengkap' => $data->nama_lengkap,
                    // 'img' => $data->img,
                    // 'is_register' => $data->is_register,
                    // 'url' => $data
                    'logged_in' => TRUE
                ];
                $session->set($ses_data);

                // remember me 
                if (!empty($this->request->getVar('remember'))) {
                    setcookie('loginId', $username, time() + (10 * 365 * 24 * 60 * 60));
                    setcookie('loginPass', $password, time() + (10 * 365 * 24 * 60 * 60));
                } else {
                    setcookie('loginId', '');
                    setcookie('loginPass', '');
                }
                
                $session->setFlashdata('success', 'Berhasil login. Selamat datang, ' . ucwords(session('username')));
                return redirect()->to(base_url('dashboard'));
            } else {
                $session->setFlashdata('warning', 'Password salah. Silahkan ulangi kembali.');
                return redirect()->to(base_url('login'));
            }
        } else {
            $session->setFlashdata('warning', 'Username atau Email tidak ditemukan.');
            return redirect()->to(base_url('login'));
        }

        return $username;
    }

    public function form_forgot_password()
    {
        return view('auth/forgot_password');
    }

    public function forgot_password()
    {
        $rules = [
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]|max_length[255]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 8 karakter',
                    'max_length' => '{field} maksimal 255 karakter',
                ],
            ],
            // 'confirm_password'  => [
            //     'label' => 'Konfirmasi password', 
            //     'rules' => 'matches[password]',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'matches' => '{field} tidak boleh berbeda',
            //     ],
            // ],
        ];

        if ($this->validate($rules)) {
            // kalau valid, simpan data
            $data = $this->request->getVar();
            $email = $data['email'];
            $password = $data['password'];
            $link = $data['link'];

            $this->db->table('users')
                ->where('email', $email)
                ->update([
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'last_reset_password' => date('Y-m-d H:i:s')
                ]);

            $this->db->table('reset_password')
                ->where('link', $link)
                ->update([
                    'status' => 1
                ]);

            return $this->response->setJSON([
                'msg' => 'Password berhasil diubah. Silahkan login kembali.'
            ]);
        } else {
            // dd('eror');
            // kalau gak valid, redirect ke form lagi
            $data['validation'] = $this->validator;
            return view('auth/forgot_password', $data);
        }
    }

    public function find_username()
    {
        $username = $this->request->getVar('username');
        
        $data = $this->db->table('users')
                    ->where('username', $username)
                    ->get()
                    ->getRow();
        
        if (!$data) {
            return $this->response->setJSON([
                'data' => null,
                'msg' => 'Username tidak ditemukan!'
            ]);
        }

        return $this->response->setJSON([
            'data'  => $data,
            'msg'   => 'Get data success'
        ], 200);
    }

    public function form_register()
    {
        return view('auth/register');
    }

    public function register()
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
        ];

        if ($this->validate($rules)) {
            // kalau valid, simpan data
            $data = $this->request->getVar();
            $id_user = $this->code->createIDUser();
            // insert users
            $users = [
                'id_user' => $id_user,
                'username' => $data['username'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                'role_name' => 'customer',
                'nama_lengkap' => $data['nama_lengkap'],
                'no_telp' => $data['no_telp'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'alamat' => $data['alamat'],
            ];
            $this->model->insertData($users, 'users');

            session()->setFlashdata("success", "Berhasil, silahkan login menggunakan username yang sudah terdaftar");
    
            return redirect()->to(base_url('/'));
        } else {
            // kalau gak valid, redirect ke form lagi
            $data['validation'] = $this->validator;
            return view('auth/register', $data);
        }
    }

    public function logout()
    {
        $session = session();
        
        $session->setFlashdata('logout', 'Berhasil logout');
    
        $session->destroy();

        return redirect()->to(base_url('login'));
    }

    public function reset($hash)
    {
        $date_time_now = date('Y-m-d H:i:s');
        $link = base_url() . 'reset/' . $hash;
        $reset = $this->db->query("SELECT time_start, time_expired, status FROM reset_password WHERE link = '$link'")->getRow();

        // check, jika belum expired, bisa ganti password, else tidak bisa
        if ($date_time_now > $reset->time_expired || $reset->status == 1) {
            // die('sudah lewat');
            return view('not_found');
        } else {
            $base64 = base64_decode($hash);
            $string_decrypt = base64_decode($base64);
            $explode = explode('/=', $string_decrypt);
            $email_decrypt = $explode[1];
            $user = $this->db->query("select * from users where email = '$email_decrypt' and is_active = 1")->getRow();
            $data = [
                'user' => $user,
                'link' => $link
            ];
            return view('auth/forgot_password2', $data);
        }
    }
}
