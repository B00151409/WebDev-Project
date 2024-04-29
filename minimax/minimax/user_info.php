<?php
session_start();


if (!isset($_SESSION['Username']) || !$_SESSION['Active']) {
    header("Location: login.php");
    exit;
}


require_once 'src/DBconnect.php';


try {
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $connection->prepare($sql);
    $stmt->execute(['username' => $_SESSION['Username']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch(PDOException $error) {
    echo "Error: " . $error->getMessage();
}
?>

<?php include "templates/header.php"; ?>
<br><br>
<div class="container">
    <h2>Account Info</h2>
    <table class="table">
        <tr>
            <th>First Name</th>
            <td><?php echo $user['firstname']; ?></td>
        </tr>
        <tr>
            <th>Last Name</th>
            <td><?php echo $user['lastname']; ?></td>
        </tr>
        <tr>
            <th>Age</th>
            <td><?php echo $user['age']; ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo $user['email']; ?></td>
        </tr>


        <tr>
            <th>Location</th>
            <td><?php echo $user['location']; ?></td>
        </tr>
        <tr>
            <th>Address</th>
            <td><?php echo $user['address']; ?></td>
        </tr>
    </table>
</div>

<?php include "templates/footer.php"; ?>
