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
        if (!isset($_SESSION['admin_id'])) {         return redirect()->to('/admin-login');        };

         if (session()->has('admin_id')) {}else{ Header("location: /admin-login"); }

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
    
    public function GetInfoFromUserID($user)
    {
        if (!isset($_SESSION['admin_id'])) {         return redirect()->to('/admin-login');        };

        $db = \Config\Database::connect();
        
        $query2 = $db->query('SELECT * FROM customers WHERE customer_ID = ? OR email = ?', [$user, $user]);
        if ($query2) {
            $userinfo = $query2->GetresultArray();
        } else {
            echo "Error: " . $db->error();
        }
        $db->close();

        $data = [];
        $data['user'] = $userinfo[0];
        
        echo view('templates/admin-header');
        echo view('admin-userinfo', $data);
        echo view('templates/footer');
    }   

    public function CheckOrder($orderid)
    {
        if (!isset($_SESSION['admin_id'])) {         return redirect()->to('/admin-login');        };


        $db = \Config\Database::connect();

        $query = $db->query('SELECT * FROM orders WHERE order_ID = ?', [$orderid]);

        if ($query->getNumRows() > 0) {
            echo 'yes';
        } else {
            echo "Invalid order";
        }
    }

    public function ResetPassword($customer_ID)
    {
        if (!isset($_SESSION['admin_id'])) {         return redirect()->to('/admin-login');        };

        $db = \Config\Database::connect();
        $query = $db->query("UPDATE `customers` SET `password` = '123456789' WHERE customer_ID = ?", [$customer_ID]);
        if ($query) {
            echo "success";
        }
    }

    public function DisableUser($customer_ID)
    {
        if (!isset($_SESSION['admin_id'])) {         return redirect()->to('/admin-login');        };

        $db = \Config\Database::connect();
        $query = $db->query("UPDATE `customers` SET `active` = 1 WHERE customer_ID = ?", [$customer_ID]);
        if ($query) {
            echo "success";
        }
    }

    public function MarkPaid($order_ID)
    {
        if (!isset($_SESSION['admin_id'])) {         return redirect()->to('/admin-login');        };

        $db = \Config\Database::connect();
        $query = $db->query("UPDATE `orders` SET `paid` = 1 WHERE order_ID = ?", [$order_ID]);
        if ($query) {
            echo "success";
        }
    }
    public function CancelOrder($order_ID)
    {
        if (!isset($_SESSION['admin_id'])) {         return redirect()->to('/admin-login');        };

        $db = \Config\Database::connect();
        $query = $db->query("UPDATE `orders` SET `paid` = 2 WHERE order_ID = ?", [$order_ID]);
        if ($query) {
            echo "success";
        }
    }

    public function EnableUser($customer_ID)
    {
        if (!isset($_SESSION['admin_id'])) {         return redirect()->to('/admin-login');        };

        $db = \Config\Database::connect();
        $query = $db->query("UPDATE `customers` SET `active` = 0 WHERE customer_ID = ?", [$customer_ID]);
        if ($query) {
            echo "success";
        }
    }

    public function CheckUser($user)
    {
        if (!isset($_SESSION['admin_id'])) {         return redirect()->to('/admin-login');        };


        $db = \Config\Database::connect();

        $query = $db->query('SELECT * FROM customers WHERE customer_ID = ? OR email = ?', [$user, $user]);

        if ($query->getNumRows() > 0) {
            $userinfo = $query->GetresultArray();
            $customerid = $userinfo[0]['customer_ID'];
            echo $customerid;
        } else {
            echo "Invalid user";
        }
    }

    public function dashboard(){
        if (!isset($_SESSION['admin_id'])) {         return redirect()->to('/admin-login');        };
        echo view('templates/admin-header');
        echo view('admin-dashboard'); 
    }

    public function users(){
        if (!isset($_SESSION['admin_id'])) {         return redirect()->to('/admin-login');        };

        $data = [];

        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();
        echo view('templates/admin-header');
        echo view('admin-users', $data); 
    }
    public function orders(){
        if (!isset($_SESSION['admin_id'])) {         return redirect()->to('/admin-login');        };

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
