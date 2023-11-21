<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products'; 
    protected $primaryKey = 'product_ID'; 

    protected $allowedFields = ['product_ID', 'name', 'image', 'price', 'description', 'on_hold', 'categorie_ID'];




}
