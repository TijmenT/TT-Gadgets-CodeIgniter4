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
    else
    {
        $status = 'Onbetaald';
    }
?>
<div class="admin-orders">

                    <div class="admin-order--item" style="background: transparent;">
                        <p class="cart--productnaam">Datum: <?php echo $order['date'] ?></p>
                        <p class="cart--productnaam">Order ID: <?php echo $order['order_ID'] ?></p>
                        <p class="cart--productnaam">Customer ID: <?php echo $order['customer_ID'] ?></p>
                        <p class="cart--productnaam">Status: <?php echo $status ?></p>

                        <p class="cart--productprijs">Amount: €<?php echo number_format($order['amount'], 2, ',', '.'); ?></p>
                    </div>
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