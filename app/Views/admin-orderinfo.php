<?php

function findProductByID($productid, $orderproducts){
foreach ($orderproducts as $product) {
        if ($product['product_ID'] == $productid) {
            return $product;
        }
    }
    return false;
}
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

<style>
  .order-container {
    width: 80%;
    margin: 0 auto;
    background-color: rgb(237, 237, 237);
    border-radius: 1rem;
    text-align: center;
    padding: 20px;
    margin-top: 2rem !important;
  }

  .order-container p {
    margin: 10px 0;
    font-size: 18px;
  }

  .order-container p.amount {
    font-weight: bold;
    font-size: 20px;
    color: #333;
  }

  .order-container button {
    margin: 10px;
    padding: 10px 20px;
    font-size: 16px;
    background-color: #749BC2;
    border-radius: 1rem;
    color: #fff;
    border: none;
    cursor: pointer;
  }
</style>

<div class="order-container">
  <p>Datum: <?php echo $order['date'] ?></p>
  <p>Order ID: <?php echo $order['order_ID'] ?></p>
  <p>Customer ID: <?php echo $order['customer_ID'] ?></p>
  <p>Status: <?php echo $status ?></p>
  <p>Amount: €<?php echo number_format($order['amount'], 2, ',', '.'); ?></p>
  <?php if($order['paid'] == 0){?>
  <button onclick="MarkAsPaid(<?php echo $order['order_ID']?>)" id="mark-as-paid">Markeer als betaald</button>
  <?php
  }
  if ($order['paid'] != 2){
    ?>
  <button onclick="CancelOrder(<?php echo $order['order_ID']?>)" id="cancel-order">Annuleer Order</button>
  <?php
  }
  ?>
</div>



<section class="product--products2">
    <?php
    $orderQuantities = array_count_values(array_column($orderproducts, 'product_ID')); 
    if(empty($orderQuantities)){
        echo '<h1 class="cart--noitems">Empty.</h1>';
    } else {
        foreach ($orderQuantities as $productid => $quantity) {
            $product = findProductByID($productid, $orderproducts);

    ?>
            <div class="product--card1">
                <img class="product--img" src="/assets/img/<?php echo $product['image']?>" />
                <h1 class="product--header"><?php echo $product['name']?></h1>
                <p1 class="product--price">Amount: <?php echo $quantity?></p1>
                <br>
                <br>
                <center><p1 style="font-size: 1.3rem;"><?php echo $product['description']?></p1></center>
            </div>
    <?php
        }
    }
    ?>
</section>