<?php
session_start();
include 'config/database.php';

$username = $_POST['username'];
$password = $_POST['password'];



if (isset($_POST['status'])) {
    loginSessin($username, $password, $conn);
} else {
    addNewUser($username, $password, $conn);
}

// method used to register a new user
function addNewUser($username, $password, $conn)
{
    // check if the username already exists
    $sql = "SELECT * FROM user WHERE name = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo 'register.php?error=Benutzername existiert bereits';
        exit();
    }

    // encrypt password
    $pass = md5($password);

    // add a new use into the user table
    $sql = "INSERT INTO user (name, password) VALUES ('$username', '$pass')";
    $result = mysqli_query($conn, $sql);
    echo 'login.php';
}

// method use for handling a loggin session
function loginSessin($username, $password, $conn)
{
    // check if the login data are correct
    // validate form data
    $name = test_input($username);
    $pass = md5(test_input($password));

    $sql = "SELECT * FROM user WHERE name = '$name' AND password = '$pass'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['name'];
        $_SESSION['password'] = $row['password'];
        echo "home.php";
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
