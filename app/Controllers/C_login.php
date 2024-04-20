<?php

namespace App\Controllers;

use \App\Models\UserModel;

class C_login extends BaseController
{
    protected $UserModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        if (session('id_user')) {
            return redirect()->to('/Pages');
        }
        $data = [
            'title' => 'Login | Wedding Planner'
        ];

        return view('Login', $data);
    }


    public function login()
    {
        $session = session();
        $model = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $model->where('username', $username)->first();
        if ($data) {
            $pass = $data->password;
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'id_user'   => $data->id_user,
                    'nama_user' => $data->nama_user,
                    'username'  => $data->username,
                    'Level'     => $data->Level,
                    'logged_in'  => TRUE
                ];
                $session->set($ses_data);
                if ($data->Level == 'Admin') {
                    return redirect()->to('/C_admin');
                } else if ($data->Level == 'Klien') {
                    return redirect()->to('/Pages');
                }
            } else {
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('/C_login');
            }
        } else {
            $session->setFlashdata('msg', 'Email not Found');
            return redirect()->to('/C_login');
        }
    }

    public function logout()
    {
        $session = session();
        $remove = ['id_user', 'nama_user', 'username', 'Level', 'logged_in'];
        $session->remove($remove); // Hapus semua session
        return redirect()->to('/Pages'); // Redirect ke halaman login
    }

    public function logout_member()
    {
        $session = session();
        $remove = ['id_user', 'nama_user', 'username', 'Level', 'logged_in'];
        $session->remove($remove); // Hapus semua session
        return redirect()->to('/Pages'); // Redirect ke halaman index Pages

    }

    public function register()
    {
        return view('Register');
    }

    public function add_user()
    {
        $session = session();
        $rules = [
            'nama'          => 'required|min_length[3]|max_length[20]',
            'username'      => 'required|min_length[6]|max_length[30]|valid_email|is_unique[user.username]',
            'password'      => 'required|min_length[6]|max_length[200]',
            'confpassword'  => 'matches[password]',
            'level'         => 'required|min_length[2]|max_length[10]'
        ];

        if ($this->validate($rules)) {
            $model = new UserModel();
            $data = [
                'nama_user'      => $this->request->getVar('nama'),
                'username'  => $this->request->getVar('username'),
                'password'  => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'Level'     => $this->request->getVar('level')
            ];
            $model->save($data);
            $session->setFlashdata('msg', '<div class="alert alert-success"
            <h4>Success</h4>
            <p>Berhasil menyimpan data</p>
            </div>');
            return redirect()->to('/C_login/register');
        } else {
            $data['validation'] = $this->validator;
            echo view('register', $data);
        }
    }
}
