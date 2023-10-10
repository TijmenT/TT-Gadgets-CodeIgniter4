<div class="ordered--history">
  <div class="ordered--item" style="background: transparent; height: 2rem;" >
        <p class="ordered--naam">Order ID</p>
        <p class="ordered--prijs">Status</p>
        <p class="ordered--prijs">Totaal prijs</p>
        <p class="ordered--meerinfo">Meer info</p>
    </div>

    <?php
    $orderscount = 0;

foreach($orderhistory as $order){
    $orderscount += 1;
?>
  <div class="ordered--item">
        <p class="ordered--naam"><?php echo $order['order_ID']?></p>
        <?php
        if($order['paid'] == 1){
        ?>
        <p class="ordered--prijs" style="color: #4aba25" >Betaald</p>
        <?php
        }
        else{
        ?>
       <p class="ordered--prijs" style="color: #eb4034">Onbetaald</p>

        <?php }?>
        <p class="ordered--prijs">€<?php echo number_format($order['amount'], 2, ',', '.'); ?></p>
        
        <?php
        if($order['paid'] == 1){
        ?>
        <a href="orderinfo/<?php echo $order['order_ID'] ?>" class="ordered--meerinfo">Meer Info</a>
        <?php
        }
        else{
        ?>
        <a href="payment/<?php echo $order['order_ID']?>/<?php echo $order['amount']?>" class="ordered--meerinfo">Afrekenen</a>

        <?php }
        ?>
    </div>
<?php
}
        if($orderscount == 0){
        ?>
          <h1 class="cart--noitems">U heeft geen bestellingen.</h1>

        <?php }?>
  </div>