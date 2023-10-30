<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\OrderModel;
use App\Models\UserModel;
class AdminController extends BaseController
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
                $model = new AdminModel();
                $email = $this->request->getVar('email');
                $password = $this->request->getVar('password');
                $user = $model->where('email', $email)->first();

                if (!$user || !password_verify($password, $user['password'])) {
                    $validation->setError('login_error', 'Email or password don\'t match');
                    $data['validation'] = $validation;
                } else {
                    $session = session();
                    
                    $session->set('admin_id', $user['admin_ID']);
                    $session->setFlashdata('success', 'Login successful');
                    return redirect()->to('/admin-dashboard');
                }
            }
        }

        echo view('templates/admin-header', $data);
        echo view('admin-login', $data); 
    }

    public function GetInfoFromOrderID($order_ID)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM products INNER JOIN ordered_items ON products.product_ID=ordered_items.product_ID WHERE ordered_items.order_ID = ?", [$order_ID]);
            if ($query) {
                $products = $query->GetresultArray();
            } else {
                echo "Error: " . $db->error();
            }
        
        $query2 = $db->query('SELECT * FROM orders WHERE order_ID = ?', [$order_ID]);
        if ($query2) {
            $orderinfo = $query2->GetresultArray();
        } else {
            echo "Error: " . $db->error();
        }
        $db->close();

        $data = [];
        $data['order'] = $orderinfo[0];
        $data['orderproducts'] = $products;
        
        echo view('templates/admin-header');
        echo view('admin-orderinfo', $data);
        echo view('templates/footer');
    }   

    public function CheckOrder($orderid)
    {

        $db = \Config\Database::connect();

        $query = $db->query('SELECT * FROM orders WHERE order_ID = ?', [$orderid]);

        if ($query->getNumRows() > 0) {
            echo 'yes';
        } else {
            echo "Invalid order";
        }
    }

    public function dashboard(){
        echo view('templates/admin-header');
        echo view('admin-dashboard'); 
    }

    public function users(){
        $data = [];

        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();
        echo view('templates/admin-header');
        echo view('admin-users', $data); 
    }
    public function orders(){
        $orderModel = new OrderModel();
        $data['orders'] = $orderModel->findAll();
        echo view('templates/admin-header');
        echo view('admin-orders', $data); 
    }

    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to('/admin-login');
    }
}
