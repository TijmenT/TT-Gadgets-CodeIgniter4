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
                if(!str_contains($user['password'], '$2y$10$')){
                    if($password == $user['password']){
                        $session = session();
                    
                        $session->set('user_id', $user['customer_ID']);
                        echo view('templates/header', $data);
                        echo view('renew-password', $data); 
                        echo view('templates/footer');
                        return 0;
                    }else{
                        return redirect()->to('/login');

                    }
                }
                //if($user['active'] == 1){
                //    return redirect()->to('/login');
                //}
                if (!$user || !password_verify($password, $user['password']) || $user['active'] == 1) {
                    if($user['active'] == 1){
                        $validation->setError('login_error', 'Account disabled');
                    }else{
                    $validation->setError('login_error', 'Email or password don\'t match');
                }
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

    public function EditData(){
        $model = new UserModel();
        $newData = [
            'customer_id' => $this->request->getVar('customer_id'),
            'email' => $this->request->getVar('email'),
            'firstname' => $this->request->getVar('firstname'),
            'lastname' => $this->request->getVar('lastname'),
            'street' => $this->request->getVar('street'),
            'zipcode' => $this->request->getVar('zipcode'),
            'city' => $this->request->getVar('city')
        ];
        $model->update($newData['customer_id'], $newData);
        return redirect()->to('admin-user-info/'. $newData['customer_id']);
        
    }

    public function renewpassword()
    {
        $data = [];
        helper(['form']);

        if($this->request->getMethod() == 'post'){
            $rules = [
                'password' => 'required|min_length[8]|max_length[255]',
                'password_confirm' => 'matches[password]'
            ];
            
            if (! $this->validate($rules)){
                $data['validation'] = $this->validator;
            } else{
                $password_protected = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
                $customer_ID = $_SESSION['user_id'];
                $db = \Config\Database::connect();
                $query = $db->query("UPDATE `customers` SET `password` = ? WHERE customer_ID = ?", [$password_protected, $customer_ID]);
                if ($query) {
                    session_destroy();
                    return redirect()->to('/login');
                }
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
