<div class="register--outer">
    <section class="register--container">
        <form class="register--form" action="/register" method="post">
            <h2 class="register--header">Registreer</h2>

            <p class="register--firstname">Voornaam:</p>
            <input class="register--firstname--input" required type="text" name="firstname" id="">
            <p class="register--lastname">Achternaam:</p>
            <input class="register--lastname--input" required type="text" name="lastname" id="">
            <p class="register--email">Email:</p>
            <input class="register--email--input" required type="email" name="email" id="">
            <p class="register--password">Wachtwoord:</p>
            <input class="register--password--input" required type="password" name="password" id="">
            <p class="register--password">Herhaal Wachtwoord:</p>
            <input class="register--password--input" required type="password" name="password_confirm" id="">
            <p class="register--street">Straat + Huisnummer:</p>
            <input class="register--street--input" required type="text" name="street" id="">
            <p class="register--zipcode">Postcode:</p>
            <input class="register--zipcode--input" required type="text" name="zipcode" id="">
            <p class="register--city">Stad:</p>
            <input class="register--city--input" required type="text" name="city" id="">
            <br>
            <a href="login.php" class="register--noaccount">Al een account? Klik hier.</a>
            <br>
            <button type="submit" class="register--confirm">Registreer</button>
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