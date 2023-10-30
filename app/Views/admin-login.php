<?php

//include('db.php');
//include('controllers/cart_controller.php');
//session_start();
//$cart = $_SESSION['cart'];
//$discount = $_SESSION['discount'];

//$error = $_GET['error'];

if(isset($_GET['error'])){
  ?>
  <script>
    var popup = document.getElementById("cart-popup");
                popup.textContent = " Failed to delete discount.";
                popup.style.display = "block";
                setTimeout(function () {
                    popup.style.display = "none";
                }, 2000);
  </script>
<?php
}


?>


<div class="register--outer">
<section class="register--container">
<form class="register--form" action="/admin-login" method="post">
    <h2 class="register--header">Admin Login</h2>
    <p class="register--email">Email:</p>
    <input class="register--email--input" required type="email" name="email" id="">
    <p class="register--password">Wachtwoord:</p>
    <input class="register--password--input" required type="password" name="password" id="">
    <br>
    <br>
    <br>
    <button type="submit" class="register--confirm">Login</button>
    <?php 
        if(isset($validation)){
            ?>
        <?= $validation->listErrors() ?>
        <?php
    }
    ?>
</form>

</section>
</div>

<?php
//$error = $_GET['error'];

if(isset($_GET['error'])){
  ?>
  <script>
    var popup = document.getElementById("cart-popup");
                popup.textContent = "<?php echo $_GET['error']?>";
                popup.style.display = "block";
                setTimeout(function () {
                    popup.style.display = "none";
                }, 5000);
  </script>
<?php
}

?>
