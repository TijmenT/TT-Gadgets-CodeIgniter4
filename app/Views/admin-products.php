<div class="admin-orders">
<div class="search-container">
      <input class="search--input" type="text" placeholder="Product ID" name="search">
      <button id="search--button" onclick="SearchProduct()" type="submit"><i class="fa fa-search"></i></button>
  </div>
    <div class="admin-order--item" style="background: transparent; margin-bottom: 0; margin-top: 0;">
        <p class="cart--productnaam">ID</p>
        <p class="cart--productnaam">Name</p>
        <p class="cart--productnaam">Description</p>
        <p class="cart--productprijs">Price</p>
    </div>

<?php
foreach ($products as $product) {

?>
                    <a href="/admin-product-info/<?php echo $product['product_ID']?>" style="text-decoration: none; color: black" class="admin-order--item">
                        <p class="cart--productnaam"><?php echo $product['product_ID'] ?></p>
                        <p class="cart--productnaam"><?php echo $product['name'] ?></p>
                        <p class="cart--productnaam"><?php echo $product['description'] ?></p>

                        <p class="cart--productprijs">€<?php echo number_format($product['price'], 2, ',', '.'); ?></p>
</a>
                    <?php
                }
                ?>
                </div>