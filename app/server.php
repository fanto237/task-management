<?php

include 'config/database.php';

$username = $_POST['username'];
$password = $_POST['password'];
$status = 'offline';



if (isset($_POST['status'])) {
    echo 'status is set';
    $status = $_POST['status'];
    loginSessin($username, $password, $status, $conn);
} else {
    echo 'status is not set';
    addNewUser($username, $password, $status, $conn);
}

// method used to register a new user
function addNewUser($username, $password, $status, $conn)
{
    // check if the username already exists
    $sql = "SELECT * FROM user WHERE name = '$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo 'username already exists';
        return;
    }

    echo 'username not  exists';
    // encrypt password
    $pass = md5($password);

    // add a new use into the user table
    $sql = "INSERT INTO user (name, password, status) VALUES ('$username', '$pass', '$status')";
    $result = mysqli_query($conn, $sql);

    // TODO not forget to delete this part
    if ($result)
        echo 'It worked just fine';
    else
        echo 'the problem is' . mysqli_error($conn);
}

// method use for handling a loggin session
function loginSessin($username, $password, $status, $conn)
{
    // check if the login data are correct

    $pass = md5($password);
    echo "the password is: " . $pass;
    $sql = "SELECT * FROM user WHERE name = '$username' AND password = '$pass' AND status = '$status'";
    $result = mysqli_query($conn, $sql);
    // if ($result)
    if (mysqli_num_rows($result) > 0)
        echo 'the login data are correct';
    else
        echo 'the login data are not correct';
}
