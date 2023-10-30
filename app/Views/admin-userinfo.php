<style>
.user-details {
    
    max-width: 300px;
    margin: 0 auto;
    margin-top: 5rem !important;
}

.field {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
    font-size: 18px;
}

input {
    width: 100%;
    padding: 10px;
    font-size: 18px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.buttons {
    margin-top: 20px;
}

button {
    padding: 10px 20px;
    font-size: 18px;
    background-color: #749BC2;
    color: #fff;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    margin-right: 10px;
}

button:hover {
    padding: 10px 25px;
    transition: 0.5s;
}

.action-buttons {
    margin-top: 20px;
    text-align: center;
}

</style>
<?php


$status;
    if($user['active'] == 0){
        $status = 'Actief';
    }
    else
    {
        $status = 'Inactief';
    }
?>

<div class="user-details">
    <form action="/edit-user-data" method="post">
    <div class="field">
        <label for="customerID">Klantnummer:</label>
        <input  type="text" id="customerID" name="customer_id" value="<?php echo $user['customer_ID'] ?>" readonly>
    </div>
    <div class="field">
        <label for="email">E-mail:</label>
        <input type="text" id="email" name="email" value="<?php echo $user['email'] ?>" readonly>
    </div>
    <div class="field">
        <label for="firstname">Voornaam:</label>
        <input class="changeable" type="text" id="firstname" name="firstname" value="<?php echo $user['firstname'] ?>" readonly>
    </div>
    <div class="field">
        <label for="lastname">Achternaam:</label>
        <input class="changeable" type="text" id="lastname" name="lastname" value="<?php echo $user['lastname'] ?>" readonly>
    </div>
    <div class="field">
        <label for="street">Straat:</label>
        <input class="changeable" type="text" id="street" name="street" value="<?php echo $user['street'] ?>" readonly>
    </div>
    <div class="field">
        <label for="zipcode">Postcode:</label>
        <input class="changeable" type="text" id="zipcode" name="zipcode" value="<?php echo $user['zipcode'] ?>" readonly>
    </div>
    <div class="field">
        <label for="city">Plaats:</label>
        <input class="changeable" type="text" id="city" name="city" value="<?php echo $user['city'] ?>" readonly>
    </div>
    <div class="field">
        <label for="status">Status:</label>
        <h1><?php echo $status ?></h1>
    </div>
    <div class="buttons">
        <button type="button" id="editBtn">Bewerken</button>
    </div>
</div>
<div class="action-buttons" style="display:none;">
    <button type="button" onclick="ResetPassword(<?php echo $user['customer_ID'] ?>)" id="resetBtn">Wachtwoord Resetten</button>
    <?php
    if($user['active'] == 0){
    ?>
    <button type="button" onclick="DisableUser(<?php echo $user['customer_ID'] ?>)" id="disableBtn">Gebruiker Uitschakelen</button>
    <?php
    }else{
    ?>
    <button type="button" onclick="EnableUser(<?php echo $user['customer_ID'] ?>)" id="disableBtn">Gebruiker Inschakelen</button>
    <?php
    }
    ?>
    <button id="finishEditBtn" type="submit" style="display:none;">Opslaan</button>
</form>
</div>



<script>
    const editBtn = document.getElementById('editBtn');
    const finishEditBtn = document.getElementById('finishEditBtn');
    const resetBtn = document.getElementById('resetBtn');
    const disableBtn = document.getElementById('disableBtn');
    const actionButtons = document.querySelector('.action-buttons');
    const inputs = document.querySelectorAll('input[readonly].changeable');

    editBtn.addEventListener('click', function () {
        const confirmation = confirm("Bent u zeker dat u wilt bewerken?");
        if (confirmation) {
            inputs.forEach(input => {
                input.removeAttribute('readonly');
            });
            actionButtons.style.display = 'block';
            finishEditBtn.style.display = 'inline-block';
            editBtn.style.display = 'none';
        }
    });

    finishEditBtn.addEventListener('click', function () {
        inputs.forEach(input => {
            input.setAttribute('readonly', 'readonly');
        });
        actionButtons.style.display = 'none';
        finishEditBtn.style.display = 'none';
        editBtn.style.display = 'inline-block';
    });
</script>


