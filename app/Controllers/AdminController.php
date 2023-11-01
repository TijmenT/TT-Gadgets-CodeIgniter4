<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\OrderModel;
use App\Models\UserModel;
use App\Models\ProductModel;

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

    public function dashboard($timespan = null){
    

        if (!isset($_SESSION['admin_id'])) {         return redirect()->to('/admin-login');        };
        $data = [];

        //Today Data
        if($timespan == null){
        $db = \Config\Database::connect();
        $query = $db->query("
        SELECT p.name AS product_name
        FROM ordered_items oi
        JOIN orders o ON oi.order_ID = o.order_ID
        JOIN products p ON oi.product_ID = p.product_ID
        WHERE DATE(o.date) = CURDATE();
        ");
            if ($query) {
                $products = $query->GetresultArray();
            } else {
                echo "Error: " . $db->error();
            }
            

        $data['todayproducts'] = $products;
        $orderModel = new OrderModel();
        $today = date('Y-m-d');
        $data['orders_one'] = $orderModel->where('date', $today)->findAll();

        $orderModel2 = new OrderModel();
        $yesterday = date('Y-m-d', strtotime("-1 days"));

        $usersamountquery = $db->query("SELECT COUNT(*) FROM customers;");
        $data['usersamount'] = $usersamountquery->GetresultArray()[0]['COUNT(*)'];

        $productsamountquery = $db->query("SELECT COUNT(*) FROM products;");
        $data['productsamount'] = $productsamountquery->GetresultArray()[0]['COUNT(*)'];

        $ordersamountquery = $db->query("SELECT COUNT(*) FROM orders;");
        $data['ordersamount'] = $ordersamountquery->GetresultArray()[0]['COUNT(*)'];

        $couponsamountquery = $db->query("SELECT COUNT(*) FROM coupons;");
        $data['couponsamount'] = $couponsamountquery->GetresultArray()[0]['COUNT(*)'];

        $db->close();

        $data['orders_two'] = $orderModel2->where('date', $yesterday)->findAll();
        } 
        // Month Data
        elseif($timespan == 'maand'){

            $db = \Config\Database::connect();

            $last30Days = date('Y-m-d', strtotime("-30 days"));
            $queryLast30Days = $db->query("
                SELECT p.name AS product_name
                FROM ordered_items oi
                JOIN orders o ON oi.order_ID = o.order_ID
                JOIN products p ON oi.product_ID = p.product_ID
                WHERE DATE(o.date) BETWEEN '$last30Days' AND CURDATE();
            ");

            if ($queryLast30Days) {
                $productsLast30Days = $queryLast30Days->getResultArray();
            } else {
                echo "Error: " . $db->error();
            }
            $data['todayproducts'] = $productsLast30Days;

            // Use OrderModel to get orders for the last 30 days
            $orderModel = new OrderModel();
            $today = date('Y-m-d');
            $data['orders_one'] = $orderModel->where('date >=', $last30Days)
                                                    ->where('date <=', $today)
                                                    ->findAll();

            // For the 30 days before the last 30 days
            $last60Days = date('Y-m-d', strtotime("-60 days"));
            $data['orders_two'] = $orderModel->where('date >=', $last60Days)
                                                    ->where('date <', $last30Days)
                                                    ->findAll();

            

        $usersamountquery = $db->query("SELECT COUNT(*) FROM customers;");
        $data['usersamount'] = $usersamountquery->GetresultArray()[0]['COUNT(*)'];

        $productsamountquery = $db->query("SELECT COUNT(*) FROM products;");
        $data['productsamount'] = $productsamountquery->GetresultArray()[0]['COUNT(*)'];

        $ordersamountquery = $db->query("SELECT COUNT(*) FROM orders;");
        $data['ordersamount'] = $ordersamountquery->GetresultArray()[0]['COUNT(*)'];

        $couponsamountquery = $db->query("SELECT COUNT(*) FROM coupons;");
        $data['couponsamount'] = $couponsamountquery->GetresultArray()[0]['COUNT(*)'];

        $db->close();

        }
        //Week
        elseif($timespan == 'week'){

            $db = \Config\Database::connect();
            $last7Days = date('Y-m-d', strtotime("-7 days"));
            $query = $db->query("
            SELECT p.name AS product_name
            FROM ordered_items oi
            JOIN orders o ON oi.order_ID = o.order_ID
            JOIN products p ON oi.product_ID = p.product_ID
            WHERE DATE(o.date) BETWEEN '$last7Days' AND CURDATE();
            ");
            
            if ($query) {
                $products = $query->getResultArray();
            } else {
                echo "Error: " . $db->error();
            }
            
        $data['todayproducts'] = $products;
            
        $orderModel = new OrderModel();
        $today = date('Y-m-d');
        $data['orders_one'] = $orderModel->where('date >=', $last7Days)
                                                   ->where('date <=', $today)
                                                   ->findAll();
            
        $orderModel2 = new OrderModel();
        $last14Days = date('Y-m-d', strtotime("-14 days"));
        $data['orders_two'] = $orderModel2->where('date >=', $last14Days)
                                                      ->where('date <', $last7Days)
                                                      ->findAll();
            

        $usersamountquery = $db->query("SELECT COUNT(*) FROM customers;");
        $data['usersamount'] = $usersamountquery->GetresultArray()[0]['COUNT(*)'];

        $productsamountquery = $db->query("SELECT COUNT(*) FROM products;");
        $data['productsamount'] = $productsamountquery->GetresultArray()[0]['COUNT(*)'];

        $ordersamountquery = $db->query("SELECT COUNT(*) FROM orders;");
        $data['ordersamount'] = $ordersamountquery->GetresultArray()[0]['COUNT(*)'];

        $couponsamountquery = $db->query("SELECT COUNT(*) FROM coupons;");
        $data['couponsamount'] = $couponsamountquery->GetresultArray()[0]['COUNT(*)'];

        $db->close();

        }

        elseif($timespan == 'altijd'){

            $db = \Config\Database::connect();

            // For All Time
            $queryAllTime = $db->query("
                SELECT p.name AS product_name
                FROM ordered_items oi
                JOIN orders o ON oi.order_ID = o.order_ID
                JOIN products p ON oi.product_ID = p.product_ID;
            ");

            if ($queryAllTime) {
                $productsAllTime = $queryAllTime->getResultArray();
            } else {
                echo "Error: " . $db->error();
            }

            $data = [];
            $data['todayproducts'] = $productsAllTime;

            // Use OrderModel to get orders for All Time
            $orderModel = new OrderModel();
            $data['orders_one'] = $orderModel->findAll();

            // For Previous All Time (either duplicate or empty based on your requirements)
            $data['orders_two'] = $orderModel->findAll();  // Duplicate 'all time' for 'previous all time'

            // Optionally, you can set it to an empty array if that's what you need
            // $data['products_prevAllTime'] = [];
            // $data['orders_prevAllTime'] = [];

            

        $usersamountquery = $db->query("SELECT COUNT(*) FROM customers;");
        $data['usersamount'] = $usersamountquery->GetresultArray()[0]['COUNT(*)'];

        $productsamountquery = $db->query("SELECT COUNT(*) FROM products;");
        $data['productsamount'] = $productsamountquery->GetresultArray()[0]['COUNT(*)'];

        $ordersamountquery = $db->query("SELECT COUNT(*) FROM orders;");
        $data['ordersamount'] = $ordersamountquery->GetresultArray()[0]['COUNT(*)'];

        $couponsamountquery = $db->query("SELECT COUNT(*) FROM coupons;");
        $data['couponsamount'] = $couponsamountquery->GetresultArray()[0]['COUNT(*)'];

        $db->close();

        }


        echo view('templates/admin-header');
        echo view('admin-dashboard', $data);

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

    public function products(){
        if (!isset($_SESSION['admin_id'])) {         return redirect()->to('/admin-login');        };

        $productModel = new ProductModel();
        $data['products'] = $productModel->findAll();
        echo view('templates/admin-header');
        echo view('admin-products', $data); 
    }

    public function coupons(){
        if (!isset($_SESSION['admin_id'])) {         return redirect()->to('/admin-login');        };

        echo view('templates/admin-header');
        echo view('admin-coupons'); 
    }


    

    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to('/admin-login');
    }
}
