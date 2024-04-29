<?php



$cartCount = 0;


if (isset($_SESSION['cart'])) {

    $cartCount = count($_SESSION['cart']);
}


$loginText = "SIGN-UP/LOGIN";
if (isset($_SESSION['Username']) && $_SESSION['Active']) {
    $loginText = "<a href='account.php' class='smoothScroll'>Account</a>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>




    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <title><?php echo isset($pageTitle) ? $pageTitle : "Default Title"; ?></title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/nivo-lightbox.css">
    <link rel="stylesheet" href="../css/nivo_themes/default/default.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/store.css">

    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,600,700' rel='stylesheet' type='../text/css'>

</head>
<body data-spy="scroll" data-target=".navbar-collapse">

<!-- navigation -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
            </button>
            <a href="index.php"><img src="../images/logo.jpeg" class="logo-image"></a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="index.php" class="smoothScroll">HOME</a></li>
                <li><a href="store.php" class="smoothScroll">Store</a></li>
                <li><a href="about.php" class="smoothScroll">ABOUT</a></li>
                <li><a href="contact.php" class="smoothScroll">CONTACT</a></li>
                <li><a href="<?php echo isset($_SESSION['Username']) && $_SESSION['Active'] ? 'account.php' : 'login.php'; ?>" class="smoothScroll"><?php echo $loginText; ?></a></li>
                <li>
                    <a href="cart.php" class="smoothScroll">
                        <span>CART</span>
                        <span class="badge badge-pill badge-dark cart-counter"><?php echo $cartCount; ?></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
