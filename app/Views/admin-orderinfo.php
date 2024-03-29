<?php

function findProductByID($productid, $orderproducts){
foreach ($orderproducts as $product) {
        if ($product['product_ID'] == $productid) {
            return $product;
        }
    }
    return false;
}
$status;
    if($order['paid'] == 1){
        $status = 'Betaald';
    }
    elseif($order['paid'] == 2){
        $status = 'Geannuleerd';
    }
    else
    {
        $status = 'Onbetaald';
    }
?>

<style>
  .order-container {
    width: 80%;
    margin: 0 auto;
    background-color: rgb(237, 237, 237);
    border-radius: 1rem;
    text-align: center;
    padding: 20px;
    margin-top: 2rem !important;
  }

  .product-container {
    margin-top: 5rem !important;
    margin: 0 auto;

  
  }

  .order-container p {
    margin: 10px 0;
    font-size: 18px;
  }

  .order-container p.amount {
    font-weight: bold;
    font-size: 20px;
    color: #333;
  }

  .order-container button {
    margin: 10px;
    padding: 10px 20px;
    font-size: 16px;
    background-color: #749BC2;
    border-radius: 1rem;
    color: #fff;
    border: none;
    cursor: pointer;
  }
</style>

<div class="order-container">
  <p>Datum: <?php echo $order['date'] ?></p>
  <p>Order ID: <?php echo $order['order_ID'] ?></p>
  <p>Customer ID: <?php echo $order['customer_ID'] ?></p>
  <p>Status: <?php echo $status ?></p>
  <p>Amount: €<?php echo number_format($order['amount'], 2, ',', '.'); ?></p>
  <?php if($order['paid'] == 0){?>
  <button onclick="MarkAsPaid(<?php echo $order['order_ID']?>)" id="mark-as-paid">Markeer als betaald</button>
  <?php
  }
  if ($order['paid'] != 2){
    ?>
  <button onclick="CancelOrder(<?php echo $order['order_ID']?>)" id="cancel-order">Annuleer Order</button>
  <?php
  }
  ?>
</div>


    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 60%; /* Set maximum width to 60% of the screen width */
            font-size: 1.5rem;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        td.editable {
            position: relative;
        }

        td.editable input, td.editable select {
            width: 100%;
            border: none;
            padding: 5px;
            box-sizing: border-box;
        }

        td.editable input:focus, td.editable select:focus {
            outline: none;
            border: 1px solid #007bff; /* Highlight when in edit mode */
        }

        @media (max-width: 600px) {
            /* Adjust the table layout for smaller screens */
            table {
                font-size: 12px; /* Decrease font size */
            }

            th, td {
                padding: 5px;
            }

            td.editable input, td.editable select {
                padding: 3px;
            }
        }
    </style>

    <table class="product-container">
        <tr>
            <th>ID</th>
            <th>Naam</th>
            <th>Aantal</th>
            <th>Description</th>
        </tr>



        <?php
    $orderQuantities = array_count_values(array_column($orderproducts, 'product_ID')); 
   
    if(empty($orderQuantities)){
        echo '<h1 class="cart--noitems">Empty.</h1>';
    } else {
      foreach ($orderQuantities as $productid => $quantity) {
        $product = findProductByID($productid, $orderproducts);
?>
            <tr>
            <td><?php echo $product['product_ID']?></td>
            <td class="editable"><input type="text" value="<?php echo $product['name']?>"></td>
            <td class="editable"><input type="text" value="<?php echo $quantity?>"></td>
            <td class="editable"><input type="text" value="<?php echo $product['description']?>"></td>
        </tr>
    <?php
        }
    }
    ?>


    </table>
</body>
</html>



</div>

