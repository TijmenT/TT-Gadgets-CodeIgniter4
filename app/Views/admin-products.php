<style>
    #search--button{
        font-size: 1.5rem;
        border: 1px black;
        padding: 1rem;
        text-decoration: none;
        color: black;
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

<div class="admin-orders">

<section class="search-container">
            <input class="search--input" type="text" placeholder="Product ID" name="search">
            <button id="search--button" onclick="SearchProduct()" type="button"><i class="fa fa-search"></i></button>
            <a id="search--button" href="/export-products" type="button">Export in Excel</a>
            <a href="<?php echo base_url('PdfController/htmlToPDF') ?>" id="search--button">
                Download PDF
            </a>
    </section>
        <form action="/save-product-changes" method="post">


        <button id="search--button" type="submit">Opslaan</button>


        <button type="button" id="search--button" onclick="AddRow()">Toevoegen</button>


        <table class="table--container">
            <tr>
                <th>ID</th>
                <th>Naam</th>
                <th>Categorie</th>
                <th>Description</th>
                <th>Prijs (EUR)</th>
            </tr>
            <tr id="new-row-template" style="display:none">
    <td><input type="text" name="id_1[]" style="border:none;" readonly></td>
    <td class="editable"><input type="text" name="name_1[]"></td>
    <td class="editable">
      <select name="categorie_ID_1[]">
        <?php foreach ($categories as $cat) { ?>
        <option value="<?php echo $cat['catergorie_ID']?>"><?php echo $cat['name']?></option>
        <?php } ?>
      </select>
    </td>
    <td class="editable"><input type="text" name="description_1[]"></td>
    <td class="editable"><input type="text" name="amount_1[]"></td>
  </tr>
            

            <?php foreach ($products as $product) { ?>
            <tr>
                <td><input type="text" name="id[]" value="<?php echo $product['product_ID'] ?>" style="border:none;" readonly></td>
                <td class="editable"><input type="text" name="name[]" value="<?php echo $product['name'] ?>"></td>
                <td class="editable">
                    <select name="categorie_ID[]">
                        <option value="<?php echo $categories[$product['categorie_ID'] - 1]['catergorie_ID']?>">
                            <?php echo $categories[$product['categorie_ID'] - 1]['name']?>
                        </option>
                        <?php foreach($categories as $cat) {
                            if($cat['name'] != $categories[$product['categorie_ID'] - 1]['name']) { ?>
                        <option value="<?php echo $cat['catergorie_ID']?>"><?php echo $cat['name']?></option>
                        <?php
                            }
                        } ?>
                    </select>
                </td>
                <td class="editable"><input type="text" name="description[]" value="<?php echo $product['description'] ?>"></td>
                <td class="editable"><input type="text" name="amount[]" value="<?php echo $product['price']; ?>"></td>
            </tr>
            <?php } ?>
        </table>



    </form>
        </div>


<script>

    function AddRow(){
  var templateRow = document.getElementById("new-row-template");
  var clonedRow = templateRow.cloneNode(true);

  var newRowId = "new-row-" + Math.floor(Math.random() * 1000);
  clonedRow.id = newRowId;

  clonedRow.style.display = "";

  var table = document.querySelector("table");
  var tbody = table.querySelector("tbody");

  tbody.insertBefore(clonedRow, tbody.children[1]);
    };
</script>