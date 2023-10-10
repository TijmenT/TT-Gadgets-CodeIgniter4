<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProductModel;
use CodeIgniter\Filters\MyFilter;
class CartController extends Controller
{

    public function index()
    {
        log_message('error', 'Added to cart');
        $data = [];
        $productModel = new ProductModel();
        $data['products'] = $productModel->findAll();

        echo view('templates/header', $data);
        echo view('cart', $data);
        echo view('templates/footer');
    }

    public function addToCart($productID)
    {
                
        $session = \Config\Services::session();

        $cart = $session->get('cart');

        if (!is_array($cart)) {
            $cart = [];
        }

        $cart[] = $productID;

        $session->set('cart', $cart);

        echo "Toegevoegd aan winkelwagen!";
    }


    public function updateCart($productID, $newAmount)
    {
        $session = \Config\Services::session();
        $cart = $session->get('cart');

        if (isset($cart)) {
            $cart = $session->get('cart');
            $updatedCart = array();

            foreach ($cart as $item) {
                if ($item == $productID && $newAmount > 0) {
                    $updatedCart[] = $productID;
                    $newAmount--;
                } elseif ($item != $productID) {
                    $updatedCart[] = $item;
                }
            }

            while ($newAmount > 0) {
                $updatedCart[] = $productID;
                $newAmount--;
            }

            $session->set('cart', $updatedCart);
        }

        echo "Aangepast!";
    }


    public function applyCoupon($coupon)
    {
        $session = \Config\Services::session();

        $db = \Config\Database::connect();

        $query = $db->query('SELECT * FROM coupons WHERE code = ?', [$coupon]);

        if ($query->getNumRows() > 0) {
            $couponData = $query->getRow();
            $discount = $couponData->discount;

            $session->set('discount', $discount);

            echo $discount;
        } else {
            echo "Invalid coupon or coupon is inactive.";
        }
    }

    public function removeDiscount()
    {
        $session = \Config\Services::session();
        $session->set('discount', null);
        echo "removed";
    }

    public function loggedIn()
    {
        session_start();
        if (isset($_SESSION['id'])) {
            echo "active";
        }
    }
}