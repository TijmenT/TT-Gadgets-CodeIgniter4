<?php

use CodeIgniter\Router\RouteCollection;
/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');
$routes->get('/login', 'Users::index');
$routes->get('/logout', 'Users::logout');
$routes->post('/login', 'Users::index');
$routes->get('/register', 'Users::register');
$routes->post('/register', 'Users::register');
$routes->get('/products', 'Product::index');
$routes->get('/cart', 'CartController::index');
$routes->get('/add-to-cart/(:num)', 'CartController::addToCart/$1');
$routes->get('/update-cart/(:num)/(:num)', 'CartController::updateCart/$1/$2');
$routes->get('/apply-coupon/(:any)', 'CartController::applyCoupon/$1');
$routes->get('/remove-discount', 'CartController::removeDiscount');
$routes->get('/checkout-order/(:any)', 'OrderController::ProcessOrder/$1');
$routes->get('/payment/(:any)/(:any)', 'OrderController::payment/$1/$2');
$routes->get('/order-paid/(:num)', 'OrderController::PaidOrder/$1');
$routes->get('/order', 'OrderController::OrderConfirmed');
$routes->get('/ordered', "OrderController::GetMyOrders");
$routes->get('/orderinfo/(:num)', "OrderController::GetProductsFromOrderID/$1");