<?php
/**
 * Edit a product
 */
require "../src\common.php";
require "../templates/adminHeader.php";
require_once '../src/DBconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    try {
        $id = $_GET['id'];
        $sql = "SELECT * FROM Products WHERE idProducts = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $product = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            echo "Product not found!";
            exit();
        }
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    echo "Product not found!";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update'])) {
        try {
            $id = isset($_GET['id']) ? $_GET['id'] : (isset($_POST['id']) ? $_POST['id'] : null);
            $productName = $_POST['productName'];
            $price = $_POST['price'];
            $imgSRC = $_POST['imgSRC'];

            $sql = "UPDATE Products 
                    SET productName = :productName,
                     price = :price,
                     imgSRC = :imgSRC
                    WHERE idProduct = :id";

            $statement = $connection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->bindValue(':productName', $productName);
            $statement->bindValue(':price', $price);
            $statement->bindValue(':imgSRC', $imgSRC);
            if($statement->execute()) {
                header("Location: index.php");
                exit();
            } else {
                echo "Update failed!";
            }
        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }
}
?>

<h2>Edit Product</h2>
<form method="post" action=update.php>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <label for="productName">Product Name</label><br>
    <input type="text" name="productName" id="productName" value="<?php echo isset($product['productName']) ? $product['productName'] : ''; ?>"><br>
    <label for="price">Price</label><br>
    <input type="text" name="price" id="price" value="<?php echo isset($product['price']) ? $product['price'] : ''; ?>"><br>
    <label for="imgSRC">Image</label><br>
    <input type="text" name="imgSRC" id="imgSRC" value="<?php echo isset($product['imgSRC']) ? $product['imgSRC'] : ''; ?>"><br>
    <input type="submit" name="update" value="Update">
</form>
<a href="index.php">Cancel</a>