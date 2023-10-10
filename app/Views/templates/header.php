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
    <script src="/assets/js/cart.js"></script>
    <script src="/assets/js/slideshow.js"></script>

</head>
<body>
<nav class="nav--container">
    <h1 class="nav--bigtext">TT Gadgets</h1>
    <div class="nav--list">
        <a href="/" class="nav--item">Home</a>
        <a href="/products" class="nav--item">Assortiment</a>
        <a href="/about" class="nav--item">Over ons</a>
        <a href="/contact" class="nav--item">Contact</a>
    </div>
    <div class="nav--list2">
        <a href="/cart" class="nav--item">Winkelwagen</a>
        <?php if(session()->has('user_id')) { ?>
    <a href="/ordered" class="nav--item">Bestellingen</a>
    <a href="/logout" class="nav--item">Uitloggen</a>
<?php } else { ?>
    <a href="/login" class="nav--item">Login</a>
<?php } ?>

    </div>

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
  <a href="index.php" class="nav--mobile--item">Home</a>
  <a href="products.php" class="nav--mobile--item">Assortiment</a>
  <a href="about.php" class="nav--mobile--item">Over ons</a>
  <a href="contact.php" class="nav--mobile--item">Contact</a>
  <a href="cart.php" class="nav--mobile--item">Winkelwagen</a>

  <?php if(session()->has('user_id')) { ?>
    <a href="/ordered" class="nav--mobile--item">Bestellingen</a>
    <a href="/logout" class="nav--mobile--item">Uitloggen</a>
<?php } else { ?>
    <a href="/login" class="nav--mobile--item">Login</a>
<?php } ?>
</div>
<div id="cart-popup" class="popup">
</div>
  </div>