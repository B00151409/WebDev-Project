<?php
require "../src/common.php";
require_once '../src/DBconnect.php';
require "../templates/adminHeader.php";


try {

    require "../src/products.php";
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["removeProduct"]) && isset($_POST["idProduct"])) {
        try {
            $id = $_POST["idProduct"];
            $sql = "DELETE FROM Products WHERE idProducts = :id";
            $statement = $connection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();

            header("Location: update.php");
            exit();
        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }
}
?>

<h2>Update Product</h2>
<table>
    <thead>
    <tr>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Product Price</th>
        <th>Image</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $product) : ?>
        <tr>
            <td><?php echo escape($product->getId()); ?></td>
            <td><?php echo escape($product->getName()); ?></td>
            <td><?php echo escape($product->getPrice()); ?></td>
            <td><?php echo escape($product->getImage()); ?></td>
            <td>
                <a href="edit.php?id=<?php echo escape($product->getId()); ?>">Edit</a>

                <form method="post" style="display: inline-block;">
                    <input type="hidden" name="idProduct" value="<?php echo escape($product->getId()); ?>">
                    <input type="submit" name="removeProduct" value="Remove">
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<a href="../Admin/admin.php">Back to home</a>
