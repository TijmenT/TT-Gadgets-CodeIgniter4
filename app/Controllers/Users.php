<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $data = [];
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            $validation = \Config\Services::validation();

            $rules = [
                'email' => 'required|min_length[5]|max_length[50]|valid_email',
                'password' => 'required|min_length[8]|max_length[255]'
            ];

            if (!$this->validate($rules)) {
                $validation->setError('login_error', 'Email or password don\'t match');
                $data['validation'] = $validation;
            } else {
                $model = new UserModel();
                $email = $this->request->getVar('email');
                $password = $this->request->getVar('password');
                $user = $model->where('email', $email)->first();

                if (!$user || !password_verify($password, $user['password'])) {
                    $validation->setError('login_error', 'Email or password don\'t match');
                    $data['validation'] = $validation;
                } else {
                    $session = session();
                    
                    $session->set('user_id', $user['customer_ID']);
                    $session->setFlashdata('success', 'Login successful');
                    return redirect()->to('/');
                }
            }
        }

        echo view('templates/header', $data);
        echo view('login', $data); 
        echo view('templates/footer');
    }

    public function register()
    {
        $data = [];
        helper(['form']);

        if($this->request->getMethod() == 'post'){
            $rules = [
                'email' => 'required|min_length[5]|max_length[50]|valid_email|is_unique[customers.email]',
                'password' => 'required|min_length[8]|max_length[255]',
                'password_confirm' => 'matches[password]',
                'firstname' => 'required|min_length[3]|max_length[20]',
                'lastname' => 'required|min_length[3]|max_length[20]',
                'street' => 'required|min_length[3]|max_length[50]',
                'zipcode' => 'required|min_length[3]|max_length[25]',
                'city' => 'required|min_length[3]|max_length[25]'
            ];
            
            if (! $this->validate($rules)){
                $data['validation'] = $this->validator;
            } else{
                $model = new UserModel();
                $newData = [
                    'email' => $this->request->getVar('email'),
                    'password' => $this->request->getVar('password'),
                    'firstname' => $this->request->getVar('firstname'),
                    'lastname' => $this->request->getVar('lastname'),
                    'street' => $this->request->getVar('street'),
                    'zipcode' => $this->request->getVar('zipcode'),
                    'city' => $this->request->getVar('city')
                ];
                $model->insert($newData);
                $session = session();
                $session->setFlashdata('success', "Successful Registration");
                return redirect()->to('/login');
            }
        }
        echo view('templates/header', $data);
        echo view('register');
        echo view('templates/footer');

        
    }
    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
