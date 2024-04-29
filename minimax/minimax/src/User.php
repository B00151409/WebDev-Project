<?php

// Define a base class for User
class User {
    // Properties
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $username;
    protected $password;
    protected $age;
    protected $location;
    protected $address;

    // Constructor
    public function __construct($firstname, $lastname, $email, $username, $password, $age, $location,$address) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->age = $age;
        $this->location = $location;
        $this->address = $address;
    }

    // Getter methods

    public function getFirstName(){
        return $this->firstname;
    }

    public function getLastName(){
        return $this->lastname;
    }
    public function getFullName() {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getAge() {
        return $this->age;
    }

    public function getLocation() {
        return $this->location;
    }
    public function getAddress() {
        return $this->address;
    }
}
?>
