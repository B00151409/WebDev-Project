<?php
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['Username']) || !$_SESSION['Active']) {
    header("Location: login.php");
    exit;
}


if (isset($_POST['logout'])) {

    session_unset();

    session_destroy();

    header("Location: index.php");
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
?>

<?php include "../templates/header.php"; ?>
<br><br><br><br><br>
<div class="container">
    <h2>Welcome, <?php echo $_SESSION['Username']; ?>!</h2>
    <div class="container">
        <div class="row">
            <!-- Side menu -->
            <div class="col-md-3">
                <div class="list-group">
                    <a href="Sub.php" class="list-group-item list-group-item-action active">Subscriptions</a>
                    <a href="account.php" class="list-group-item list-group-item-action ">Account Info</a>
                    <a href="Previous_Orders.php" class="list-group-item list-group-item-action">Previous Orders</a>

                </div>
            </div>

            <div class="col-md-9">

                <div id="account" class="container tab-pane active">
                    <h3>Account Info</h3>
                    <table class="table">
                        <tr>
                            <th>Active Subscription</th>
                            <td style="font-weight: bold;">No</td>
                        </tr>

                    </table>


                    <a href="../user_info.php" class="btn btn-primary btn-lg">View Detailed Information</a>

                </div>

                <form action="" method="post">
                    <input type="submit" name="logout" value="Log Out" class="btn btn-danger btn-lg">
                </form>
            </div>

            <?php include "../templates/footer.php"; ?>
