<?php
$session = \Config\Services::session();
$cart = $session->get('cart');
$discount = $session->get('discount');



?>


<h1 class="cart--header">Winkelwagen</h1>
<div class="cart">
    <br>
    <br>
    <section class="cart--container">
        <div class="cart--item--labels">
            <img id="cart--image" src="" alt="">
            <p class="cart--productnaam">Product</p>
            <p id="cart--aantalkiezen--label">Aantal</p>
            <p class="cart--productprijs">Prijs</p>
        </div>
        <?php
        $totalPrice = 0;

        if (empty($cart) || !is_array($cart)) {
            ?>
            <h1 class="cart--noitems">Uw winkelwagen is leeg.</h1>
            <?php
        } else {
            foreach ($products as $product) {
                if (in_array($product['product_ID'], $cart)) {
                    $quantity = array_count_values($cart)[$product['product_ID']];
                    $productPrice = $product['price'] * $quantity;
                    $totalPrice += $productPrice;
                    ?>
                    <div class="cart--item">
                        <img id="cart--image" src="assets/img/<?php echo $product['image']?>" alt="product image">
                        <p class="cart--productnaam"><?php echo $product['name'] ?></p>
                        <input onchange="(UpdateCart(<?php echo $product['product_ID']?>, this.value))"
                               maxlength="10"
                               value="<?php echo $quantity; ?>"
                               type="number"
                               id="cart--aantalkiezen"
                               name="points"
                               step="1">
                               <?php
    if (!isset($discount)) {
      $totalPrice;
  } else {
    $totalPrice / 100 * (100 - $discount);
  }
    ?>  
                        <p class="cart--productprijs">€<?php echo number_format($productPrice, 2, ',', '.'); ?></p>
                    </div>
                    <?php
                }
            }
        }
        ?>
</section>
<section class="cart--totalcontainer">
    <h1 class="cart--bezorging">Bezorging</h1>
    <select name="shipping" class="cart--bezorgingkeuze" id="shippingSelect">
        <option value="standaard">Standaard</option>
        <option value="fast">Express (+ €4,95)</option>
    </select>
    <h1 class="cart--korting">Kortingscode</h1>
    <input type="text" name="korting" id="" class="cart--kortinginput">
    <button type="submit" onclick="ApplyCoupon()" class="cart--kortingbutton">Toepassen</button>

    <p class="cart--discounttext"><?php if(isset($discount)){echo "€" . number_format($totalPrice, 2);}?></p>
    <button class="cart--removediscountbutton" onclick="RemoveDiscount()"><?php if(isset($discount)){echo "Korting verwijderen (" . number_format($discount, 2) . "%)";}?></button>
    <?php
    if (isset($discount)) {
      $totalPrice  = $totalPrice / 100 * (100 - $discount);
    }
    ?>  
    <h1 class="cart--total">Totaal: €<span id="totalPrice"><?php number_format($totalPrice, 2, ',', '.'); ?></span></h1> 
    <?php
      if(session()->has('user_id')) {
      ?>
      <button onclick="ProcessOrder()" class="cart--pay">Betalen</button>
      <?php
      }
      else {
        ?>
        <button onclick="NeedsLogin()" class="cart--pay">Betalen</button>
      <?php
      }
      ?>
</section>
</div>

<div class="cart--mobile">
    <?php
    $totalPriceMobile = 0;

    if (empty($cart) || !is_array($cart)) {
        ?>
        <h1 class="cart--noitems">Uw winkelwagen is leeg.</h1>
        <?php
    } else {
        foreach ($products as $product) {
            if (in_array($product['product_ID'], $cart)) {
                $quantity = array_count_values($cart)[$product['product_ID']];
                $productPrice = $product['price'] * $quantity;
                $totalPriceMobile += $productPrice;
                ?>
                <div class="cart--item--mobile">
                    <h1 class="cart--productname--mobile"><?php echo $product['name'] ?></h1>
                    <input onchange="(UpdateCart(<?php echo $product['product_ID']?>, this.value))"
                           placeholder="<?php echo $quantity; ?>"
                           value="<?php echo $quantity; ?>"
                           type="number"
                           id="cart--aantalkiezen--mobile"
                           name="points"
                           step="1">
                    <p class="cart--productprijs--mobile">€<?php echo number_format($productPrice, 2, ',', '.'); ?></p>
                </div>
                <?php
            }
        }
    }
    ?>

    
  <div class="cart--totalcontainer--mobile">
    <h1 class="cart--bezorging--mobile">Bezorging</h1>
      <select name="" class="cart--bezorgingkeuze--mobile">
        <option value="standaard">Standaard</option>
        <option value="fast">Express (+ €4,95)</option>
      </select>
      <h1 class="cart--korting--mobile">Kortingscode</h1>
      <input type="text" name="korting" id="" class="cart--kortinginput--mobile">
      <br>
      <button type="submit" onclick="ApplyCoupon()" class="cart--kortingbutton--mobile">Toepassen</button>
      <p class="cart--discounttext"><?php if(isset($discount)){echo "€" . number_format($totalPriceMobile, 2);}?></p>
    <button class="cart--removediscountbutton" onclick="RemoveDiscount()"><?php if(isset($discount)){echo "Korting verwijderen (" . number_format($discount, 2) . "%)";}?></button>
    <?php
    if (isset($discount)) {
      $totalPriceMobile = $totalPriceMobile / 100 * (100 - $discount);
    }
    ?>  
      <h1 class="cart--total--mobile">Totaal: €<span id="totalPriceee"><?php echo number_format($totalPriceMobile, 2, ',', '.'); ?></span></h1> 
      <?php
      if(session()->has('user_id')) {
      ?>
      <button onclick="ProcessOrder()" class="cart--pay--mobile">Betalen</button>
      <?php
      }
      else {
        ?>
        <button onclick="NeedsLogin()" class="cart--pay--mobile">Betalen</button>
      <?php
      }
      ?>
  </div>
  </div>
  
    <footer class="footer--container">
        <p class="footer--text">Contact</p>
        <p class="footer--text">FAQ</p>
        <p class="footer--text">TOS</p>
    </footer>
    <script>
 const shippingSelect = document.getElementById('shippingSelect');
 const totalPriceSpan = document.getElementById('totalPrice');
 const initialTotalPrice = <?php echo $totalPrice; ?>;

 function updateTotalPrice() {
   const selectedOption = shippingSelect.value;
   let total = initialTotalPrice;

   if (selectedOption === 'fast') {
     total += 4.95;
   }

   totalPriceSpan.textContent = total.toFixed(2);
 }

 shippingSelect.addEventListener('change', updateTotalPrice);
 updateTotalPrice();
</script>
