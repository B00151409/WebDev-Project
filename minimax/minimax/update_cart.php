<?php
session_start();
require "src/config.php";
require "src/products.php";


if (isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["idProduct"])) {
    $idProducts = $_GET["idProduct"];

    foreach ($_SESSION["cart"] as $keys => $product_id) {
        if ($product_id == $idProducts) {
            // If quantity is more than one, decrement quantity
            if ($_SESSION['cart'][$keys]['quantity'] > 1) {
                $_SESSION['cart'][$keys]['quantity']--;
            } else {
                unset($_SESSION["cart"][$keys]);
            }
            break;
        }
    }
}

// Redirect back to cart.php
header("Location: cart.php");
exit;
?>
