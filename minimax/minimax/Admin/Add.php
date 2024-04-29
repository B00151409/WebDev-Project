<?php
require "../src/products.php";
require "../src/config.php";
require "../templates/adminHeader.php";
if(isset($_POST['submit'])){
    $idProduct = $_POST['idProduct'];
    $productName = $_POST['productName'];
    $price = $_POST['price'];
    $imgSRC = $_POST['imgSRC'];

//This makes new product added to Databse
    $product = new Product($idProduct, $productName, $price, $imgSRC);
    $productDb = new ProductDatabase($connection);
    $productDb->addProduct($productName, $price, $imgSRC);
}
?>
<form class="form-horizontal" action='' method="POST">
    <fieldset>
        <div id="legend">
            <legend class="">Add Products</legend>
            <br>
        </div>
        <div class="control-group">
            <label class="control-label" for="idProduct">Product ID</label>
            <div class="controls">
                <input type="number" id="idProduct" name="idProduct" placeholder="" class="input-xlarge" required>
            </div>
        </div>
        <br>
        <div class="control-group">
            <label class="control-label" for="productName">Product Name</label>
            <div class="controls">
                <input type="text" id="productName" name="productName" placeholder="" class="input-xlarge" required>
                <p class="help-block"></p>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="price">Price</label>
            <div class="controls">
                <input type="number" id="price" name="price" placeholder="" class="input-xlarge" required>
                <p class="help-block"></p>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="imgSRC">Image Source</label>
            <div class="controls">
                <input type="text" id="imgSRC" name="imgSRC" placeholder="" class="input-xlarge" required>
                <p class="help-block"></p>
            </div>
        </div>
        <div class="control-group">

            <div class="controls">
                <input type="submit" name="submit" value="Submit" class="btn-success" required>
            </div>
        </div>
    </fieldset>
</form>
<br>
<a href="../Admin/admin.php">Back to home</a>