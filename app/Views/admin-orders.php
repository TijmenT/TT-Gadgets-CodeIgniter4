<div class="admin-orders">
<div class="search-container">
      <input class="search--input" type="text" placeholder="Order ID" name="search">
      <button id="search--button" onclick="SearchOrder()" type="submit"><i class="fa fa-search"></i></button>
  </div>
    <div class="admin-order--item" style="background: transparent; margin-bottom: 0; margin-top: 0;">
        <p class="cart--productnaam">Datum</p>
        <p class="cart--productnaam">Order ID</p>
        <p class="cart--productnaam">Customer ID</p>
        <p class="cart--productnaam">Status</p>
        <p class="cart--productprijs">Amount</p>
    </div>

<?php
foreach ($orders as $order) {
    $status;
    if($order['paid'] == 1){
        $status = 'Betaald';
    }
    elseif($order['paid'] == 2){
        $status = 'Geannuleerd';
    }
    else
    {
        $status = 'Onbetaald';
    }
?>
                    <a href="/admin-order-info/<?php echo $order['order_ID']?>" style="text-decoration: none; color: black" class="admin-order--item">
                        <p class="cart--productnaam"><?php echo $order['date'] ?></p>
                        <p class="cart--productnaam"><?php echo $order['order_ID'] ?></p>
                        <p class="cart--productnaam"><?php echo $order['customer_ID'] ?></p>
                        <p class="cart--productnaam"><?php echo $status ?></p>

                        <p class="cart--productprijs">€<?php echo number_format($order['amount'], 2, ',', '.'); ?></p>
</a>
                    <?php
                }
                ?>
                </div>