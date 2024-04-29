<?php
require "../templates/adminHeader.php";
require "../src/common.php";

if (isset($_POST['submit'])) {
    try {
        require_once '../src/DBconnect.php';
        $user = [
            "id" => $_POST['id'],
            "username" => $_POST['username'],
            "firstname" => $_POST['firstname'],
            "lastname" => $_POST['lastname'],
            "email" => $_POST['email'],
            "password" => $_POST['password'],
            "age" => $_POST['age'],
            "location" => $_POST['location'],
        ];

        $sql = "UPDATE users
                SET username = :username,
                    firstname = :firstname,
                    lastname = :lastname,
                    email = :email,
                    password = :password,
                    age = :age,
                    location = :location
                WHERE id = :id";

        $statement = $connection->prepare($sql);
        $statement->execute($user);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

if (isset($_GET['id'])) {
    try {
        require_once '../src/DBconnect.php';
        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php if (isset($_POST['submit']) && $statement) : ?>
    <?php echo escape($_POST['firstname']); ?> successfully updated.
<?php endif; ?>
<h2>Edit a user</h2>
<form method="post">
    <?php foreach ($user as $key => $value) : ?>
        <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
        <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>"
               value="<?php echo escape($value); ?>"
            <?php echo ($key === 'id' ? 'readonly' : null); ?>>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>
<a href="../Public/index.php">Back to home</a>
