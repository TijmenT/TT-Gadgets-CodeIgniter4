<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class OrderController extends BaseController
{


    public function LoadCoupon($price)
    {

        if (!isset($_SESSION['discount'])) {
            return $price;
        } else {
            return $price / 100 * (100 - $_SESSION['discount']);
        }

    }
    public function ProcessOrder($fastshipping)
    {

        $totalPrice = 0;
        $productModel = new ProductModel();
        $products = $productModel->findAll();
        $session = \Config\Services::session();
        $customer_ID = $session->get('user_id');
        $cart = $session->get('cart');

        //logToFile(debug_backtrace());
        if (!isset($cart)) {
            return header("Location: ../cart.php");
        }
        if (count($cart) == 0) {
            return header("Location: ../cart.php");
        }
        foreach ($products as $product) {
            if (in_array($product['product_ID'], $cart)) {
                $quantity = array_count_values($cart)[$product['product_ID']];
                $productPrice = $product['price'] * $quantity;
                $totalPrice += $productPrice;
            }
        }
        if ($fastshipping == "true") {
            $totalPriceDiscounted = $this->LoadCoupon($totalPrice) + 4.95;
        } else {
            $totalPriceDiscounted = $this->LoadCoupon($totalPrice);
        }
        $datee = date("Y-m-d");
        $timee = date("H:i");
        $db = \Config\Database::connect();
        $query = $db->query('INSERT INTO `orders`(`customer_ID`, `amount`, `date`, `time`, `fastshipping`) VALUES (?, ?, ?, ?, ?)', [$customer_ID, $totalPriceDiscounted, $datee, $timee, $fastshipping]);
        if ($query) {
            $order_ID = $db->insertID();
            $ordereditems = $session->get('cart');
            $session->set('cart', null);
            $session->set('discount', null);
            foreach ($ordereditems as $item) {
                $query = $db->query("INSERT INTO `ordered_items`(`order_ID`, `product_ID`) VALUES (?, ?)", [$order_ID, $item]);
                if ($query) {
                    //
                } else {
                    echo "Error: " . $db->error();
                }
                $db->close();
            }
            echo "/payment/$order_ID/$totalPriceDiscounted";

        }
    }

    public function payment($order_ID, $amount)
    {
        $data = [];
        $data['orderID'] = $order_ID;
        $data['amount'] = $amount;
        return view("payment", $data);
    }

    public function PaidOrder($order_ID)
    {
        $db = \Config\Database::connect();
        $query = $db->query("UPDATE `orders` SET `paid` = 1 WHERE order_ID = ?", [$order_ID]);
        if ($query) {
            echo "success";
        }
    }

    public function OrderConfirmed()
    {
        echo view('templates/header');
        echo view('order');
        echo view('templates/footer');
    }
    public function GetMyOrders()
    {
        $db = \Config\Database::connect();
        $session = \Config\Services::session();
        $customer_ID = $session->get('user_id');
        $query = $db->query("SELECT * FROM orders WHERE customer_ID = ?", [$customer_ID]);
        $orders = $query->GetresultArray();
        $data = [];
        $data['orderhistory'] = $orders;

        if ($query) {
            $db->close();
            echo view('templates/header');
            echo view('ordered', $data);
            echo view('templates/footer');
        }
    }


    public function GetProductsFromOrderID($order_ID)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM products INNER JOIN ordered_items ON products.product_ID=ordered_items.product_ID WHERE ordered_items.order_ID = ?", [$order_ID]);
            if ($query) {
                $products = $query->GetresultArray();
            } else {
                echo "Error: " . $db->error();
            }
            $db->close();
        $data = [];
        $data['order_ID'] = $order_ID;
        $data['orderproducts'] = $products;
        
        echo view('templates/header');
        echo view('orderinfo', $data);
        echo view('templates/footer');
    }

}