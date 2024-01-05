<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (isLogin()) return redirect()->to('/');
        if (!$this->request->is('POST')) return view('form_login');

        $form = $this->request->getPost();
        $rules = [
            'email' => [
                'label' => 'Email Address',
                'rules' => 'required|valid_email',
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]|max_length[20]'
            ]
        ];

        if (!$this->validateData($form, $rules)) {
            return redirect()->back()->withInput();
        }

        $model = new UserModel();
        $user = $model->where('email', $form['email'])->first();
        if (!empty($user)) {
            if (password_verify($form['password'], $user->password)) {
                unset($user->password);
                $new_token = bin2hex(random_bytes(16));
                $user->token = $new_token;

                $model->update($user->id, [
                    'token' => $new_token,
                    'ip_address' => $this->request->getIPAddress()
                ]);

                $this->session->set((array)$user);
                return redirect()->to('/');
            } else {
                $this->session->setFlashdata('error', 'Password salah');
                return redirect()->back()->withInput();
            }
        } else {
            $this->session->setFlashdata('error', 'Email salah');
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        if ($this->session->has('id')) {
            (new UserModel)->update($this->session->id, ['token' => null]);
        }
        $this->session->destroy();
        return redirect()->to('login');
    }
}
