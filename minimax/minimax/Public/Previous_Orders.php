<?php
session_start();
require_once "../src/config.php";
require_once "../src/products.php";
require_once "../src/Users.php";


if (!isset($_SESSION['Username']) || !$_SESSION['Active']) {
    header("Location: login.php");
    exit;
}


require_once '../src/DBconnect.php';


try {
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $connection->prepare($sql);
    $stmt->execute(['username' => $_SESSION['Username']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch(PDOException $error) {
    echo "Error: " . $error->getMessage();
}


try {
    $sql = "SELECT * FROM orders WHERE user_id = :user_id ORDER BY order_date DESC";
    $stmt = $connection->prepare($sql);
    $stmt->execute(['username' => $user['id']]);
    $previous_orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $error) {
    echo "Error: " . $error->getMessage();
}
?>

<?php include "../templates/header.php"; ?>

<br><br><br>
<div class="container">
    <h2>Welcome, <?php echo $_SESSION['Username']; ?>!</h2>
<div class="container">
    <div class="row">

        <div class="col-md-3">
            <div class="list-group">
                <a href="Previous_Orders.php" class="list-group-item list-group-item-action active">Previous Orders</a>
                <a href=account.php class="list-group-item list-group-item-action">Account Info</a>
                <a href="Sub.php" class="list-group-item list-group-item-action">Subscriptions</a>
            </div>
        </div>

        <div class="col-md-9">

            <div id="account" class="container tab-pane active">
                <h3>Previous Orders</h3>
                <table class="table">
                    <tr>
                        <th>Order Refrence </th>
                        <td></td>
                        <td style="font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <th>Item</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Quantity</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Total Amount</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Time</th>
                        <td></td>
                    </tr>
                </table>

            </div>
        </div>
    </div>


<?php include "../templates/footer.php"; ?>
