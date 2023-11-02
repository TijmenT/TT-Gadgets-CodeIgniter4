<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel; // Import the ProductModel
use App\Models\UserModel;

class Home extends BaseController
{
    public function index()
    {
        $data = [];
        helper(['form']);

        $productModel = new ProductModel();
        $data['products'] = $productModel->findAll();

        echo view('templates/header', $data);
        echo view('home', $data);
        echo view('templates/footer');
    }

    public function offline()
    {

        echo view('templates/header');
        echo view('offline');
        echo view('templates/footer');
    }
    public function about()
    {

        echo view('templates/header');
        echo view('about');
        echo view('templates/footer');
    }
    public function contact()
    {

        echo view('templates/header');
        echo view('contact');
        echo view('templates/footer');
    }
    public function dashboard()
    {
        $session = \Config\Services::session();

        $user_id = $_SESSION['user_id'];
        $model = new UserModel();
        $user = $model->where('customer_id', $user_id)->first();
        $data = [];
        $data['user'] = $user;
        echo view('templates/header');
        echo view('dashboard', $data);
        echo view('templates/footer');
    }
}
