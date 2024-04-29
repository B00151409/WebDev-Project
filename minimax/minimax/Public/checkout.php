<?php
session_start();
require "../src/config.php";
require "../src/products.php";
include "../templates/header.php";
include '../src/CountyData.php';

$countyDataProvider = new CountyData();
$counties = $countyDataProvider->getCounties();



if (isset($_POST["submit"])) {
    // Check if all required fields are filled
    if (!empty($_POST["card_number"]) && !empty($_POST["expiry_month"]) && !empty($_POST["expiry_year"]) && !empty($_POST["cvv"])) {
        $card_number = $_POST["card_number"];
        $expiry_month = $_POST["expiry_month"];
        $expiry_year = $_POST["expiry_year"];
        $cvv = $_POST["cvv"];

        if (strlen($card_number) == 16 && strlen($cvv) == 3) {

            $current_year = date("Y");
            $current_month = date("m");
            if ($expiry_year > $current_year || ($expiry_year == $current_year && $expiry_month >= $current_month)) {
                // Payment successful
                echo '<script>alert("Order purchased successfully. You should receive an email shortly. Thank you!")</script>';
                // Clear the cart
                unset($_SESSION["cart"]);
                // Redirect back to cart page
                echo '<script>window.location="index.php"</script>';
                exit;
            } else {
                echo '<script>alert("Card expiry date is invalid. Please enter a valid expiry date.")</script>';
            }
        } else {
            echo '<script>alert("Invalid card number or CVV. Please try again.")</script>';
        }
    } else {
        echo '<script>alert("Please fill in all the required fields.")</script>';
    }
}
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Checkout</title>
    </head>
    <body>
    <br>
    <h1>Checkout</h1>
    <br>
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

        foreach ($cart_items as $key => $cart_item) {
            $product = $cart_item['product'];
            $quantity = $cart_item['quantity'];
            if ($product) {
                $total += $product->getPrice() * $quantity;
            }
        }
    }
    ?>

    <br><br>
    <form method="post">
        <form method="post">
            <div>
                <label for="Name">Name:</label>
                <input type="text" id="Name" name="Name" required>
            </div>
            <div>
                <label for="Address">Address Line 1:</label>
                <input type="text" id="Address" name="Address" required>
            </div>
            <div>
                <label for="Address">Address Line 2:</label>
                <input type="text" id="Address" name="Address" required>
            </div>
            <div>
                <label for="Eircode">Eircode:</label>
                <input type="text" id="Eircode" name="Eircode" required>
            </div>

            <div class="control-group">
                <label class="control-label" for="location">City/Town</label>
                <div class="controls">
                    <select id="location" name="location" class="input-xlarge" required>
                        <?php foreach ($counties as $county): ?>
                            <option value="<?php echo $county; ?>"><?php echo $county; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <p class="help-block">Please select your County</p>
                </div>
            </div>
            <br>
            <div>
                <label for="card_number">Card Number (16 digits):</label>
                <input type="text" id="card_number" name="card_number" pattern="[0-9]{16}" required>
            </div>
            <div>
                <label for="expiry_month">Expiry Month:</label>
                <input type="text" id="expiry_month" name="expiry_month" pattern="(0[1-9]|1[0-2])" placeholder="MM"
                       required>
            </div>
            <div>
                <label for="expiry_year">Expiry Year:</label>
                <input type="text" id="expiry_year" name="expiry_year" pattern="[2][0-9]{3}" placeholder="YYYY"
                       required>
            </div>
            <div>
                <label for="cvv">CVV (3 digits):</label>
                <input type="text" id="cvv" name="cvv" pattern="[0-9]{3}" required>
            </div>
            <button type="submit" name="submit">Submit Payment</button>
            <tr>
                <td colspan="2" align="right">Total</td>
                <td colspan="2" align="middle">$ <?php echo number_format($total, 2); ?></td>
            </tr>
        </form>
    </body>
    </html>

<?php include "../templates/footer.php"; ?>