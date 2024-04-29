<?php
session_start();
require "../src/config.php";
require "../src/products.php";
$pageTitle = "Cart";
include "../templates/header.php";
?>
<br><br><br><br>
<?php
$total = 0;
if (!empty($_SESSION["cart"])) {
$cart_items = [];
foreach ($_SESSION["cart"] as $product_id) {
    if (isset($cart_items[$product_id])) {
        $cart_items[$product_id]['quantity']++;
    } else {
        $cart_items[$product_id] = ['quantity' => 1, 'product' => $productDb->getProductById($product_id)];
    }
}
?>
<div class="container mt-5">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Item </th>
            <th scope="col">Item Name</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Remove</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($cart_items as $key => $cart_item) : ?>
            <?php $product = $cart_item['product']; ?>
            <?php $quantity = $cart_item['quantity']; ?>
            <tr>
                <td><img src="<?php echo $product->getImage(); ?>"
                         alt="<?php echo $product->getName(); ?>"
                         style="max-width: 100px;"></td>
                <td><?php echo $product->getName(); ?></td>
                <td>$ <?php echo number_format($product->getPrice(), 2); ?></td>
                <td><?php echo $quantity; ?></td>
                <td><a href="cart.php?action=delete&idProducts=<?php echo $product->idProducts; ?>"><span
                                class="text-danger">Remove</span></a></td>
            </tr>
            <?php $total += $product->getPrice() * $quantity; ?>
        <?php endforeach; ?>
        <tr>
            <td colspan="2" align="right">Total</td>
            <td colspan="2" align="right">$ <?php echo number_format($total, 2); ?></td>
        </tr>
        </tbody>
    </table>
</div>

<!-- Checkout Button -->
<div class="container mt-3">
    <?php if (!empty($cart_items)) : ?>
        <a href="checkout.php" class="btn btn-primary bt">Checkout</a>
    <?php endif; ?>
</div>
<?php
} else {
echo '<div class="container mt-5 text-center"><h2>Cart is empty</h2></div>';
}
include "../templates/footer.php";
?>

<?php
if (isset($_POST["checkout"])) {

}

if (isset($_GET["action"])) {
if ($_GET["action"] == "delete") {
    foreach ($_SESSION["cart"] as $keys => $product_id) {
        if ($product_id == $_GET["idProducts"]) {
            unset($_SESSION["cart"][$keys]);
            echo '<script>window.location="cart.php"</script>';
            break; // Stop the loop after removing one item
        }
    }
}
}
?>
