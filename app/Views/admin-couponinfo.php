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
if($coupon['active'] == 1){
    $status = 'Actief';
}
else
{
    $status = 'Inactief';
}
?>

<div class="user-details">
    <form action="/edit-coupon-data" method="post">
    <div class="field">
        <label for="couponID">Coupon ID:</label>
        <input  type="text" id="couponID" name="coupon_ID" value="<?php echo $coupon['coupon_ID'] ?>" readonly>
    </div>
    <div class="field">
        <label for="code">Code:</label>
        <input class="changeable" type="text" id="code" name="code" value="<?php echo $coupon['code'] ?>" readonly>
    </div>
    <div class="field">
        <label for="discount">Discount:</label>
        <input class="changeable" type="text" id="discount" name="discount" value="<?php echo $coupon['discount'] ?>" readonly>
    </div>
    <div class="field">
        <label for="status">Status:</label>
        <input type="text" id="status" name="status" value="<?php echo $status ?>" readonly>
    </div>
    <div class="buttons">
        <button type="button" id="editBtn">Bewerken</button>
    </div>
</div>
<div class="action-buttons" style="display:none;">
    <?php
    if($coupon['active'] == 1){
        ?>
        <button type="button" onclick="DisableCoupon(<?php echo $coupon['coupon_ID'] ?>)" id="disableBtn">Coupon Uitschakelen</button>
        <?php
        }else{
        ?>
        <button type="button" onclick="EnableCoupon(<?php echo $coupon['coupon_ID'] ?>)" id="disableBtn">Coupon Inschakelen</button>
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


