

<section class="product--products1">
        <?php foreach ($users as $user): ?>
                <div class="product--card1">
                    <h1 class="product--header"><?php echo $user['email'] ?></h1>
                </div>
        <?php endforeach; ?>
    </section>