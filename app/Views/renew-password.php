<div class="register--outer">
    <section class="register--container">
        <form class="register--form" action="/renew-password" method="post">
            <h2 class="register--header">Nieuw wachtwoord</h2>

            <p class="register--password">Wachtwoord:</p>
            <input class="register--password--input" required type="password" name="password" id="">
            <p class="register--password">Herhaal Wachtwoord:</p>
            <input class="register--password--input" required type="password" name="password_confirm" id="">
            <br>
            <br>
            <button type="submit" class="register--confirm">Bevestigen</button>
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