<?php
function findProductByID($productid, $orderproducts){
foreach ($orderproducts as $product) {
        if ($product['product_ID'] == $productid) {
            return $product;
        }
    }
    return false;
}
?>
<p class="cart--noitems">OrderID: <?php echo $order_ID?></p>
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