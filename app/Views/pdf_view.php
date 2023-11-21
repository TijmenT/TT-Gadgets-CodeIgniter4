<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Codeigniter 4 PDF Example - positronx.io</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<style>
        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 60%; 
            margin-bottom: 4rem;
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
            border: 1px solid #007bff; 
        }

        @media (max-width: 600px) {
            table {
                font-size: 12px; 
                margin-bottom: 4rem;
            }

            th, td {
                padding: 5px;
            }

            td.editable input, td.editable select {
                padding: 3px;
            }
        }
    </style>

  <div class="container mt-5">
    <h2>Producten</h2>
    <div class="d-flex flex-row-reverse bd-highlight">
    </div>
    <table>

<tr>
    <th>ID</th>
    <th>Naam</th>
    <th>Categorie</th>
    <th>Description</th>
    <th>Prijs (EUR)</th>
</tr>
<?php foreach ($products as $product) { ?>
<tr>
    <td><?php echo $product['product_ID'] ?></td>
    <td class="editable"><?php echo $product['name'] ?></td>
    <td class="editable">
    <?php echo $categories[$product['categorie_ID'] - 1]['name']?>
    </td>
    <td class="editable"><?php echo $product['description'] ?></td>
    <td class="editable"><?php echo $product['price']; ?></td>
</tr>
<?php } ?>
</table>

  </div>
</body>
</html>