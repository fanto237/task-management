<?php
session_start();
include 'config/database.php';


$username = $_POST['username'];
$password = $_POST['password'];
$title = $_POST['title'];
$description = $_POST['description'];
$assignTo = $_POST['assignTo'];
$priority = $_POST['priority'];
$start =  $_POST['start'];
$end =  $_POST['end'];

$action = $_POST['action'];

switch ($action) {
    case 'login':
        loginSession($username, $password, $conn);
        break;
    case 'register':
        addNewUser($username, $password, $conn);
        break;
    case 'edit':
        editTask($title, $description, $assignTo, $priority, $start, $end, $conn,);
        break;
    case 'create':
        addNewTask($title, $description, $assignTo, $priority, $start, $end, $conn,);
        break;
    case 'delete':
        deleteTask($conn);
        break;
}



// method used to register a new user
function addNewUser($username, $password, $conn)
{


    // check if the username already exists
    $sql = "SELECT * FROM users WHERE name = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo 'register.php?error=Benutzername existiert bereits';
        exit();
    }

    global $redis;
    $redis->set('isUsersChanged', 'true');

    // encrypt password
    $pass = md5($password);

    // add a new use into the user table
    $sql = "INSERT INTO users (name, password) VALUES ('$username', '$pass')";
    $result = mysqli_query($conn, $sql);
    echo 'index.php';
}

// method use for handling a loggin session
function loginSession($username, $password, $conn)
{
    // check if the login data are correct
    // validate form data
    $name = test_input($username);
    $pass = md5(test_input($password));

    $sql = "SELECT * FROM users WHERE name = '$name' AND password = '$pass'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['name'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['id'] = $row['id'];
        global $redis;
        $redis->set('isTasksChanged', 'true');
        echo "dashboard.php";
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function addNewTask($title, $description, $assignTo, $priority, $start, $end, $conn)
{
    $createBy = $_SESSION['username'];
    $sql = "INSERT INTO tasks (title, description, assignedTo, startdate, enddate, priority, createBy, status) VALUES ('$title', '$description', '$assignTo', '$start', '$end', '$priority', '$createBy', 'begin')";
    $result = mysqli_query($conn, $sql);

    //  update the redis cache for notifying a database change
    global $redis;
    $redis->set('isTasksChanged', 'true');
    if ($result)
        echo 'success';
};

function editTask($title, $description, $assignTo, $priority, $start, $end, $conn)
{
    $id = $_POST['id'];
    $sql = "UPDATE tasks SET title = '$title', description = '$description', assignedTo = '$assignTo', startdate = '$start', enddate = '$end', priority = '$priority' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    //  update the redis cache for notifying a database change
    global $redis;
    $redis->set('isTasksChanged', 'true');
    if ($result)
        echo 'success';
}


function deleteTask($conn)
{
    $id = $_POST['id'];
    $sql = "UPDATE tasks SET status = 'done' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    global $redis;
    $redis->set('isTasksChanged', 'true');
    if ($result)
        echo 'success';
}
