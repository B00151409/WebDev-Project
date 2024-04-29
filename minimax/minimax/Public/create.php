<?php
require "../src\Users.php";
include '../src\CountyData.php';

$countyDataProvider = new CountyData();
$counties = $countyDataProvider->getCounties();

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $location = $_POST['location'];

    // Create new user
    $user = new User($username, $password, $firstname, $lastname, $email, $age, $address, $location);


}
?>
<br><br><br><br><br>
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet"
      id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


<form class="form-horizontal" action='' method="POST">
    <fieldset>
        <div id="legend">
            <legend class="">Register</legend>
        </div>
        <div class="control-group">
            <label class="control-label" for="username">Username</label>
            <div class="controls">
                <input type="text" id="username" name="username" placeholder="" class="input-xlarge" required>
                <p class="help-block">Username can contain any letters or numbers, without spaces</p>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="password">Password</label>
            <div class="controls">
                <input type="password" id="password" name="password" placeholder="" class="input-xlarge" required>
                <p class="help-block">Password should be at least 4 characters</p>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="firstname">First Name</label>
            <div class="controls">
                <input type="text" id="firstname" name="firstname" placeholder="" class="input-xlarge" required>
                <p class="help-block">Please provide your first name</p>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="email">Last Name</label>
            <div class="controls">
                <input type="text" id="lastname" name="lastname" placeholder="" class="input-xlarge" required>
                <p class="help-block">Please provide your surname</p>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="email">E-mail</label>
            <div class="controls">
                <input type="email" id="email" name="email" placeholder="" class="input-xlarge" required>
                <p class="help-block">Please provide your E-mail</p>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="age">Age</label>
            <div class="controls">
                <input type="number" id="age" name="age" placeholder="" class="input-xlarge" required>
                <p class="help-block">Please provide your Age</p>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="email">Address</label>
            <div class="controls">
                <input type="text" id="address" name="address" placeholder="" class="input-xlarge" required>
                <p class="help-block">Please provide your Address</p>
            </div>
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



        <div class="control-group">

            <div class="controls">
                <input type="submit" name="submit" value="Submit" class="btn-success" required>
            </div>
        </div>
    </fieldset>
</form>
<a href="index.php">Back to home</a>
<?php include "../templates/footer.php"; ?>
