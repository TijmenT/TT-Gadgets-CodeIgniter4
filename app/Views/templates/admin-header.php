<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TT Gadgets</title>
    <link rel="stylesheet" href="/assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/admin.js"></script>


</head>
<body>
<nav class="nav--container">
    <h1 class="nav--bigtext">TT Gadgets</h1>
    <?php if  (session()->has('admin_id')) { ?>
    <div class="nav--list">
        <a href="/admin-dashboard" class="nav--item">Dashboard</a>
        <a href="/admin-users" class="nav--item">Gebruikers</a>
        <a href="/admin-orders" class="nav--item">Bestellingen</a>
        <a href="/admin-products" class="nav--item">Producten</a>
        <a href="/admin-coupons" class="nav--item">Kortingscodes</a>

    </div>
    <div class="nav--list2">
            <a href="/logout" class="nav--item">Uitloggen</a>

    </div>
    <?php } ?>
    <div class="nav--mobile">
      <a href="#home" class="active"></a>
      <a href="javascript:void(0);" id="nav--mobile--icon--open" onclick="OpenBurger()">
        <i class="fa fa-bars"></i>
      </a>
    </div>
</nav>
<div id="nav--mobile--links">
  <a href="javascript:void(0);" id="nav--mobile--icon--close" onclick="CloseBurger()">
    <span>&#10005;</span>

  </a>

  <?php if(session()->has('admin_id')) { ?>
    <a href="/admin-dashboard" class="nav--mobile--item">Dashboard</a>
    <a href="/admin-users" class="nav--mobile--item">Gebruikers</a>
    <a href="/admin-orders" class="nav--mobile--item">Bestellingen</a>
    <a href="/logout" class="nav--mobile--item">Uitloggen</a>
<?php } ?>
</div>
<div id="cart-popup" class="popup">
</div>
  </div>