<div class="admin-orders">
<div class="search-container">
      <input class="search--input" type="text" placeholder="User ID / Email" name="search">
      <button id="search--button" onclick="SearchUser()" type="submit"><i class="fa fa-search"></i></button>
  </div>
    <div class="admin-order--item" style="background: transparent; margin-bottom: 0; margin-top: 0;">
    <p class="cart--productprijs">ID</p>

        <p class="cart--productnaam">Email</p>
        <p class="cart--productnaam">Firstname</p>
        <p class="cart--productnaam">Lastname</p>
        <p class="cart--productnaam">Status</p>
    </div>

<?php
foreach ($users as $user) {
    $status;
    if($user['active'] == 0){
        $status = 'Actief';
    }
    else
    {
        $status = 'Inactief';
    }
?>
                    <a href="/admin-user-info/<?php echo $user['customer_ID']?>" style="text-decoration: none; color: black" class="admin-order--item">
                        <p class="cart--productprijs"><?php echo $user['customer_ID']?></p>
                        <p class="cart--productnaam"><?php echo $user['email'] ?></p>
                        <p class="cart--productnaam"><?php echo $user['firstname'] ?></p>
                        <p class="cart--productnaam"><?php echo $user['lastname'] ?></p>
                        <p class="cart--productnaam"><?php echo $status ?></p>

</a>
                    <?php
                }
                ?>
                </div>