<?php
require "../templates/adminHeader.php";
require "../src/User.php";
if (isset($_POST['submit'])) {
    try {
        require "../src\common.php";
        require_once '../src\DBconnect.php';
        $sql = "SELECT *
 FROM users
 WHERE location = :location";
        // read user fromdatabse
        $location = $_POST['location'];
        $statement = $connection->prepare($sql);
        $statement->bindParam(':location', $location, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll();
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

if (isset($_POST['submit'])) {
    if ($result && $statement->rowCount() > 0) {
        ?>
        <br><br><br><br>
        <h2>Results</h2>
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Email Address</th>
                <th>Username</th>
                <TH>Password</TH>
                <th>Age</th>
                <th>Location</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($result as $row) {
                $user = new User(
                    $row['firstname'],
                    $row['lastname'],
                    $row['email'],
                    $row['username'],
                    $row['password'],
                    $row['age'],
                    $row['location'],
                    $row['address']
                );
                ?>
                <tr>
                    <td><?php echo escape($row["id"]); ?></td>
                    <td><?php echo escape($user->getFullName()); ?></td>
                    <td><?php echo escape($user->getEmail()); ?></td>
                    <td><?php echo escape($user->getUsername()); ?></td>
                    <td><?php echo escape($user->getPassword()); ?></td>
                    <td><?php echo escape($user->getAge()); ?></td>
                    <td><?php echo escape($user->getAddress()); ?></td>
                    <td><?php echo escape($row["date"]); ?> </td>
                </tr>
            <?php } ?>
            </tbody>/
        </table>
    <?php } else { ?>
        > No results found for <?php echo escape($_POST['location']); ?>.
    <?php }
} ?>
<h2>Find user based on location</h2>
<form method="post">
    <label for="location">Location</label>
    <input type="text" id="location" name="location">
    <input type="submit" name="submit" value="View Results">
</form>
<a href="../Admin/admin.php">Back to home</a>
