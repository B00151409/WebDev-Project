<?php
require "../templates/adminHeader.php";
 if (isset($_POST['logout'])) {

     session_unset();

//admin page
     session_destroy();


     header("Location: index.php");
     exit;
 }
?>
<div class="container">
    <div class="row">

<a href="Add.php" class="smoothScroll">Add Product</a>
<br>
<a href="update.php" class="smoothScroll">Products List</a>
<br>
<a href="read.php" class="smoothScroll">User List</a>
<br>
<a href ="update_user.php" class="smoothScroll">Update Users</a>
<br><br>
<a href="../Public/index.php" id= "logout" class="smoothScroll">Back to Home</a>
    </div>
