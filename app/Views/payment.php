<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fake Payment Terminal</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        #payment-form {
            background-color: #fff;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        #payment-result {
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php
    ?>
    <h1>Testing Payment Terminal </h1>
    <form id="payment-form">
        <input type="text" style="display: none;" id="order-id" value="<?php echo $orderID?>">
        <label for="card-number">Card Number:</label>
        <input type="text" id="card-number" value="12345678910" placeholder="Card Number" required>

        <label for="exp-date">Expiration Date:</label>
        <input type="text" id="exp-date" value="03/24" placeholder="MM/YY" required>

        <label for="cvv">CVV:</label>
        <input type="text" id="cvv" value="123" placeholder="CVV" required>

            <h2 for="amount">Amount: € <?php echo $amount?></h2>
        <input type="text" id="amount" style="display: none;" placeholder="Amount" value="<?php echo $amount?>" required>

        <button type="button" id="submit-button">Submit Payment</button>
    </form>

    <div id="payment-result"></div>

    <script>


        document.addEventListener("DOMContentLoaded", function () {
            const paymentForm = document    .getElementById("payment-form");
            const submitButton = document.getElementById("submit-button");
            const paymentResult = document.getElementById("payment-result");

            submitButton.addEventListener("click", function () {
                const cardNumber = document.getElementById("card-number").value;
                const expDate = document.getElementById("exp-date").value;
                const cvv = document.getElementById("cvv").value;
                const amount = document.getElementById("amount").value;
                const paymentSuccess = true;
                const orderID = document.getElementById("order-id").value
                if (paymentSuccess) {
                    $.ajax({
                    url: '/order-paid/'+orderID,
                    type: 'GET',
                    success: function (result) {
                        console.log(result)
                        paymentResult.innerHTML = `Payment of €${amount} successfully processed.`;
                    }
                    });
                    setTimeout(function () {
                        window.location.href = "/order  "; 
                    }, 3000);
                } else {
                    paymentResult.innerHTML = `Payment failed. Please check your card information and try again.`;
                }
            });
        });
    </script>
</body>
</html>
