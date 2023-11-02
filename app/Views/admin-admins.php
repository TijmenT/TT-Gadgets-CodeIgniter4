<div class="admin-orders">
<div class="search-container">
  </div>
    <div class="admin-order--item" style="background: transparent; margin-bottom: 0; margin-top: 0;">
    <p class="cart--productprijs">ID</p>

        <p class="cart--productnaam">Username</p>
        <p class="cart--productnaam">Email</p>
        <p class="cart--productnaam">Lvl</p>
    </div>

<?php
foreach ($users as $user) {

?>
                    <a href="/admin-admins-info/<?php echo $user['admin_ID']?>" style="text-decoration: none; color: black" class="admin-order--item">
                    <p class="cart--productprijs"><?php echo $user['admin_ID']?></p>
                        <p class="cart--productnaam"><?php echo $user['username']?></p>
                        <p class="cart--productnaam"><?php echo $user['email'] ?></p>
                        <p class="cart--productnaam"><?php echo $user['level'] ?></p>

</a>
                    <?php
                }
                ?>
                </div>