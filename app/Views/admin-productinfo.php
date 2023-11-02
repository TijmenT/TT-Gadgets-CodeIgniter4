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
    if($product['on_hold'] == 0){
        $status = 'Actief';
    }
    else
    {
        $status = 'Inactief';
    }
?>

<div class="user-details">
    <form action="/edit-product-data" method="post">
    <div class="field">
        <label for="productID">Product ID:</label>
        <input  type="text" id="productID" name="product_id" value="<?php echo $product['product_ID'] ?>" readonly>
    </div>
    <div class="field">
        <label for="name">Name:</label>
        <input class="changeable" type="text" id="name" name="name" value="<?php echo $product['name'] ?>" readonly>
    </div>
    <div class="field">
        <label for="image">Img:</label>
        <input class="changeable" type="text" id="image" name="image" value="<?php echo $product['image'] ?>" readonly>
    </div>
    <div class="field">
        <label for="description">Beschrijving:</label>
        <input class="changeable" type="text" id="description" name="description" value="<?php echo $product['description'] ?>" readonly>
    </div>
    <div class="field">
        <label for="price">Prijs (EURO):</label>
        <input class="changeable" type="text" id="price" name="price" value="<?php echo $product['price'] ?>" readonly>
    </div>
    <div class="field">
        <label for="cate">Categorie:</label>
        <input type="text" id="cate" name="cate" value="<?php echo $catergorie ?>" readonly>
    </div>
    <div class="field">
        <label for="status">Status:</label>
        <h1><?php echo $status ?></h1>
    </div>
    <div class="buttons">
        <button type="button" id="editBtn">Bewerken</button>
    </div>
</div>
<div class="action-buttons" style="display:none;">    <?php
    if($product['on_hold'] == 0){
    ?>
    <button type="button" onclick="DisableProduct(<?php echo $product['product_ID'] ?>)" id="disableBtn">Product Uitschakelen</button>
    <?php
    }else{
    ?>
    <button type="button" onclick="EnableProduct(<?php echo $product['product_ID'] ?>)" id="disableBtn">Product Inschakelen</button>
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


