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
        $data['products'] = $productModel->where('on_hold', 0)->findAll();
        $data['categories'] = $categorieModel->findAll();
        echo view('templates/header', $data);
        echo view('products', $data);
        echo view('templates/footer');
    }
    public function EditProduct(){
        $model = new ProductModel();
        $newData = [
            'product_id' => $this->request->getVar('product_id'),
            'name' => $this->request->getVar('name'),
            'image' => $this->request->getVar('image'),
            'description' => $this->request->getVar('description'),
            'price' => $this->request->getVar('price')
        ];
        $model->update($newData['product_id'], $newData);
        return redirect()->to('admin-product-info/'. $newData['product_id']);
        
    }

}
