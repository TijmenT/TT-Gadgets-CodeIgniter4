<div class="admin-orders">
<div class="search-container">
      <input class="search--input" type="text" placeholder="Coupon ID" name="search">
      <button id="search--button" onclick="SearchCoupon()" type="submit"><i class="fa fa-search"></i></button>
  </div>
    <div class="admin-order--item" style="background: transparent; margin-bottom: 0; margin-top: 0;">
        <p class="cart--productnaam">ID</p>
        <p class="cart--productnaam">Code</p>
        <p class="cart--productnaam">Discount</p>
        <p class="cart--productnaam">Status</p>
    </div>

<?php
foreach ($coupons as $coupon) {
    $status;
    if($coupon['active'] == 0){
        $status = 'Inactief';
    }
    elseif($coupon['active'] == 1){
        $status = 'Actief';
    }
?>
                    <a href="/admin-coupon-info/<?php echo $coupon['coupon_ID']?>" style="text-decoration: none; color: black" class="admin-order--item">
                        <p class="cart--productnaam"><?php echo  $coupon['coupon_ID'] ?></p>
                        <p class="cart--productnaam"><?php echo  $coupon['code'] ?></p>
                        <p class="cart--productnaam"><?php echo $coupon['discount'] ?>%</p>
                        <p class="cart--productnaam"><?php echo $status ?></p>
</a>
                    <?php
                }
                ?>
                </div>