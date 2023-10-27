<?php

//include("db.php");
//include("controllers/product_controller.php");
//$products = GetProducts($mysqli);
//session_start();
?>
<script src="/assets/js/cards.js"></script>

      <div class="slideshow">
        <div id="image1" class="fade">
          <img src="/assets/img/background.jpg" class="background--container" width="100%" alt="background">
        </div>
        <div id="image2" class="fade">
          <img src="assets/img/rD1eOT.jpeg" class="background--container" width="100%" alt="background">
        </div>
        <div id="image3" class="fade">
          <img src="assets/img/turtle-beach-stealth-pro-preorder-blogroll-1679582803054_vcah.jpeg" class="background--container" width="100%" alt="background">
        </div>
      </div>
      <section class="product--products">
        <?php
     foreach ($products as $product) {
      ?>
      <div class="product--card1">
        <img class="product--img" src="assets/img/<?php echo $product['image']?>" />
        <h1 class="product--header"><?php echo $product['name']?></h1>
        <p1 class="product--price">€<?php echo number_format($product['price'], 2, ',', '.'); ?></p1>
        <button onclick="AddToCart(<?php echo $product['product_ID']?>)"class="product--buy">In Winkelwagen</button>
      </div>
<?php 
}
?>
    </section>
    <section class="randominfo">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam ea aliquam tenetur libero deserunt fugiat accusantium? Corrupti nihil dolorem, maiores autem explicabo.</p>
    </section>
  