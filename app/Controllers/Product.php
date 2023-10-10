<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategorieModel;
use App\Models\ProductModel;
class Product extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $categorieModel = new CategorieModel();
        $data['products'] = $productModel->findAll();
        $data['categories'] = $categorieModel->findAll();
        echo view('templates/header', $data);
        echo view('products', $data);
        echo view('templates/footer');
    }

}
