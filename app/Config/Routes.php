<?php

use CodeIgniter\Router\RouteCollection;
/**
 * @var RouteCollection $routes
 */

//Webshop

//Pages
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');
$routes->get('/offline', 'Home::offline');
$routes->get('/login', 'Users::index');
$routes->get('/logout', 'Users::logout');
$routes->post('/login', 'Users::index');
$routes->get('/register', 'Users::register');
$routes->post('/register', 'Users::register');
$routes->get('/dashboard', 'Home::dashboard');
$routes->get('/products', 'Product::index');
$routes->get('/cart', 'CartController::index');

//Api / Ajax
$routes->get('/add-to-cart/(:num)', 'CartController::addToCart/$1');
$routes->get('/update-cart/(:num)/(:num)', 'CartController::updateCart/$1/$2');
$routes->get('/apply-coupon/(:any)', 'CartController::applyCoupon/$1');
$routes->get('/remove-discount', 'CartController::removeDiscount');
$routes->get('/checkout-order/(:any)', 'OrderController::ProcessOrder/$1');
$routes->get('/payment/(:any)/(:any)', 'OrderController::payment/$1/$2');
$routes->get('/order-paid/(:num)', 'OrderController::PaidOrder/$1');
$routes->get('/order', 'OrderController::OrderConfirmed');

//Orders
$routes->get('/ordered', "OrderController::GetMyOrders");
$routes->get('/orderinfo/(:num)', "OrderController::GetProductsFromOrderID/$1");

//Admin

//Pages
$routes->get('/admin', 'AdminController::dashboard');
$routes->get('/admin-dashboard', 'AdminController::dashboard');
$routes->get('/admin-dashboard/(:any)', 'AdminController::dashboard/$1');
$routes->get('/admin-users', 'AdminController::users');
$routes->get('/admin-orders', 'AdminController::orders');
$routes->get('/admin-products', 'AdminController::products');
$routes->get('/admin-coupons', 'AdminController::coupons');
$routes->get('/admin-admins', 'AdminController::admins');

//Login
$routes->get('/admin-login', 'AdminController::index');
$routes->post('/admin-login', 'AdminController::index');

//Info Pages
$routes->get('/admin-order-info/(:num)', "AdminController::GetInfoFromOrderID/$1");
$routes->get('/admin-user-info/(:any)', "AdminController::GetInfoFromUserID/$1");
$routes->get('/admin-admins-info/(:any)', "AdminController::GetInfoFromAdminID/$1");
$routes->get('/admin-product-info/(:any)', "AdminController::GetInfoFromProductID/$1");
$routes->get('/admin-coupon-info/(:any)', "AdminController::GetInfoFromCouponID/$1");

//Api / Ajax
$routes->get('/admin-disablewebshop', 'AdminController::DisableWebshop');
$routes->get('/admin-enablewebshop', 'AdminController::EnableWebshop');

$routes->get('/does-order-exist/(:num)', 'AdminController::CheckOrder/$1');
$routes->get('/does-user-exist/(:any)', 'AdminController::CheckUser/$1');
$routes->get('/does-product-exist/(:any)', 'AdminController::CheckProduct/$1');
$routes->get('/does-coupon-exist/(:any)', 'AdminController::CheckCoupon/$1');
$routes->post('/edit-product-data', "Product::EditProduct");
$routes->get('/reset-password/(:num)', "AdminController::ResetPassword/$1");
$routes->get('/disable-user/(:num)', "AdminController::DisableUser/$1");
$routes->get('/enable-user/(:num)', "AdminController::EnableUser/$1");
$routes->get('/disable-product/(:num)', "AdminController::DisableProduct/$1");
$routes->get('/enable-product/(:num)', "AdminController::EnableProduct/$1");
$routes->get('/disable-coupon/(:num)', "AdminController::DisableCoupon/$1");
$routes->get('/enable-coupon/(:num)', "AdminController::EnableCoupon/$1");
$routes->post('/renew-password', "Users::RenewPassword");
$routes->post('/edit-user-data', "Users::EditData");
$routes->post('/edit-admin-data', "AdminController::EditAdmin");
$routes->get('/mark-paid/(:num)', "AdminController::MarkPaid/$1");
$routes->get('/cancel-order/(:num)', "AdminController::CancelOrder/$1");



