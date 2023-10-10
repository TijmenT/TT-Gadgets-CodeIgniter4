<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel; // Import the ProductModel

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
}
