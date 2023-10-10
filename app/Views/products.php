<?php foreach ($categories as $categorie): ?>
    <center><h1 class="product--cats"><?php echo $categorie['name'] ?></h1></center>
    <section class="product--products1">
        <?php foreach ($products as $product): ?>
            <?php if ($product['categorie_ID'] == $categorie['catergorie_ID']): ?>
                <div class="product--card1">
                    <img class="product--img" src="assets/img/<?php echo $product['image'] ?>" />
                    <h1 class="product--header"><?php echo $product['name'] ?></h1>
                    <p1 class="product--price">€<?php echo number_format($product['price'], 2, ',', '.'); ?></p1>
                    <button onclick="AddToCart(<?php echo $product['product_ID'] ?>)" class="product--buy">In Winkelwagen</button>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </section>
<?php endforeach; ?>
