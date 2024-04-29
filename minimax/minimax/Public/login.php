<?php
session_start();

// Database connection
$host = "localhost";
$username = "root";
$password = "rootpassword12";
$database = "loi_merchandise_db";

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
// User Logins
if(isset($_POST['Submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user) {
        if($password === $user['password']) {
            $_SESSION['Username'] = $user['username'];
            $_SESSION['Active'] = true;
            header("location: index.php");
            exit;
        } else {
            echo 'Incorrect Password';
        }
    } else {
        echo 'User does not exist';
    }
}
// Admin Logins
if(isset($_POST['Submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admins WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user) {
        if($password === $user['password']) {
            $_SESSION['Username'] = $user['username'];
            $_SESSION['Active'] = true;
            header("location: ../Admin/admin.php");
            exit;
        } else {
            echo 'Incorrect Password';
        }
    } else {
        echo 'User does not exist';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
<div class="wrapper fadeInDown">
    <div id="formContent">

        <div class="fadeIn first">
            <img src="../images\logo.jpeg" id="icon" alt="User Icon" />
        </div>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="text" id="login" class="fadeIn second" name="username" placeholder="Username">
            <input type="text" id="password" class="fadeIn third" name="password" placeholder="Password">
            <input type="submit" class="fadeIn fourth" name="Submit" value="Log In">
        </form>

        <div id="formFooter">
            <p> Don't have an account?</p>
            <a class="underlineHover" href="create.php">Sign Up</a><br>
            <a class="underlineHover" href="index.php">Back</a>
        </div>
    </div>
</div>
</body>
</html>
