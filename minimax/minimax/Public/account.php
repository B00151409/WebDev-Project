<?php
session_start();
include "../src/User.php";
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

// Database connection
require_once '../src/DBconnect.php';


try {
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $connection->prepare($sql);
    $stmt->execute(['username' => $_SESSION['Username']]);
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    $user = new User(
        $userData['firstname'],
        $userData['lastname'],
        $userData['email'],
        $userData['username'],
        $userData['password'],
        $userData['age'],
        $userData['location'],
        $userData['address']
    );
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

            <div class="col-md-3">
                <div class="list-group">
                    <a href="#account" class="list-group-item list-group-item-action active">Account Info</a>
                    <a href="Previous_Orders.php" class="list-group-item list-group-item-action">Previous Orders</a>
                    <a href="Sub.php" class="list-group-item list-group-item-action">Subscriptions</a>
                </div>
            </div>
            <div class="col-md-9">

                <div id="account" class="container tab-pane active">
                    <h3>Account Info</h3>
                    <table class="table">
                        <tr>
                            <th>Full Name</th>
                            <td style="font-weight: bold;"><?php echo $user->getFullName(); ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td style="font-weight: bold;"><?php echo $user->getEmail() ; ?></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td style="font-weight: bold;"><?php echo $user->getAddress(); ?></td>
                        </tr>
                        <tr>
                            <th>Location</th>
                            <td style="font-weight: bold;"><?php echo $user->getLocation(); ?></td>
                        </tr>
                    </table>

                    <!-- Link to view detailed user information -->
                    <a href="../user_info.php" class="btn btn-primary btn-lg">View Detailed Information</a>

</div>

    <form action="" method="post">
        <input type="submit" name="logout" value="Log Out" class="btn btn-danger btn-lg">
    </form>
</div>

<?php include "../templates/footer.php"; ?>
