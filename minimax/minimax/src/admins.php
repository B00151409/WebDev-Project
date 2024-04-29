<?php
require "User.php";
require "config.php";
class admins extends User
{
    public $idAdmin;
    public $username;
    public $password;


    public function __construct($idAdmin,$username, $password)
    {
        $this->idAdmin = $idAdmin;
        $this->username = $username;
        $this->password = $password;
    }
}
class adminDatabase
{
    private $conn;

    // Constructor
    public function __construct($host, $username, $password, $database)
    {
        $this->conn = new mysqli($host, $username, $password, $database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    public function addAdmin($username, $password) // Update parameter name
    {
        $username = $this->conn->real_escape_string($username);
        $password = $this->conn->real_escape_string($password);



        //SQL query for inputting admins
        $sql = "INSERT INTO admins (username, password) VALUES ('$username', '$password')"; // Update column name

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
$adminDb = new AdminDatabase($host, $username, $password, $database);
$adminsToAdd = [
    ["Admin1", "AdminPassword1"],
    ["Admin2", "AdminPassword2"],
];
foreach ($adminsToAdd as $admins) {
    $username = $admins[0];
    $password = $admins[1];
    $adminDb->addAdmin($username, $password );
}


?>
