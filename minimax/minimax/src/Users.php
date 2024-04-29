<?php
    include "User.php";
// Define a class for User
class RegularUser extends User {
    // Properties
    public $firstname;
    public $lastname;
    public $email;
    public $username;
    public $password;
    public $age;
    public $location;
    public $address;

    // Constructor
    public function __construct($firstname, $lastname, $email, $username, $password, $age, $location, $address) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->age = $age;
        $this->location = $location;
        $this->address = $address;
    }
}


// Define a class for User Database Operations
class RegularUserDatabase
{
    // Database connection
    private $connection;

    // Constructor
    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    // Method to check if a username already exists
    public function isUsernameExists($username)
    {
        $sql = "SELECT COUNT(*) FROM users WHERE username = :username";
        $statement = $this->connection->prepare($sql);
        $statement->execute(['username' => $username]);
        $count = $statement->fetchColumn();
        return $count > 0;
    }

    // Method to add a new user
    public function addRegularUser($user)
    {
        if ($this->isUsernameExists($user->username)) {
            echo "<script>alert('Username already exists. Please choose a different username.');</script>";

            return false;
        }

        $sql = "INSERT INTO users (firstname, lastname, email, username, password, age, location, address) 
                VALUES (:firstname, :lastname, :email, :username, :password, :age, :location, :address)";
        $statement = $this->connection->prepare($sql);
        return $statement->execute([
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'email' => $user->email,
            'username' => $user->username,
            'password' => $user->password,
            'age' => $user->age,
            'location' => $user->location,
            'address' => $user->address
        ]);
    }
}

if (isset($_POST['submit'])) {
    require "../src\common.php";
    try {
        require_once '../src\DBconnect.php';

        // Create a new User object
        $new_user = new RegularUser(
            escape($_POST['firstname']),
            escape($_POST['lastname']),
            escape($_POST['email']),
            escape($_POST['username']),
            escape($_POST['password']),
            escape($_POST['age']),
            escape($_POST['location']),
            escape($_POST['address'])
        );

        // Create a new UserDatabase instance
        $userDb = new RegularUserDatabase($connection);

        // Add the user to the database
        if ($userDb->addRegularUser($new_user)) {
            echo "You have successfully registered an Account ";
            header("Location: login.php");
            exit;
        } else {

        }
    } catch(PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}
?>