<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id'])) { ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Task Master</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/dashboard.php">
                <img src="../img/logo.png" alt="logo" width="40" height="40" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="#"><?= $_SESSION['username'] ?> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="logout.php">logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="d-flex flex-column justify-content-top align-items-center" style="min-height: 90vh; width: 100%">


        <h1 class=" mt-5 mb-5">Willkommen bei Task Master</h1>
        <div class="container" style="width: 70%">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Fertig</th>
                        <th scope="col">Title</th>
                        <th scope="col">Beschreibung</th>
                        <th scope="col">Startdatum</th>
                        <th scope="col">Enddatum</th>
                        <th scope="col">Priorität</th>
                        <th scope="col">Zustängiger</th>
                        <th scope="col">Ersteller</th>
                        <th scope="col">Bearbeiten</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- get all tasks from the database and display them  in the table -->

                    <?php
                        include 'config/database.php';

                        $username = $_SESSION['username'];
                        $tasks = array();
                        $key =  'tasks';
                        global $redis;
                        $res = $redis->get('isTasksChanged');

                        if (!$redis->get($key) or $res == 'true') {
                            $sql = "SELECT * FROM tasks WHERE status = 'begin' AND (assignedTo = '$username' OR createBy = '$username')  ";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $tasks[] = $row;
                            }
                            $redis->set($key, serialize($tasks));
                            $us = unserialize($redis->get($key));
                            $redis->set('isTasksChanged', 'false');
                        } else {
                            $tasks = unserialize($redis->get($key));
                        }

                        foreach ($tasks as $task) {
                            $style = '';
                            switch ($task['priority']) {
                                case 'Hoch':
                                    $style = 'style="color: red;"';
                                    break;
                                case 'Normal':
                                    $style = 'style="color: green;"';
                                    break;
                                case 'Niedrig':
                                    $style = 'style="color: yellow;"';
                                    break;
                            }
                            echo '
                                <tr>
                        <th scope="row">
                            <input class="form-check-input center" type="checkbox" name="done-boxes" data-id="' . $task['id'] . '">
                        </th>
                        <td>' . $task['title'] . '</td>
                        <td>' . $task['description'] . '</td>
                        <td>' . date('d.m.Y', strtotime($task['startdate'])) . '</td>
                        <td>' . date('d.m.Y', strtotime($task['enddate'])) . '</td>
                        <td ' . $style . '>' . $task['priority'] . '</td>
                        <td>' . $task['assignedTo'] . '</td>
                        <td>' . $task['createBy'] . '</td>
                        <td>
                            <a href="edit_task.php?id=' . $task['id'] . '" class="btn btn-success center">Edit</a>
                        </td>
                    </tr>
                                ';
                        }
                        ?>
                </tbody>
            </table>
        </div>



        <!-- button redirecting to the new_task page -->
        <a href="new_task.php" class="mt-5 btn btn-primary">Add Task</a>

        <script src="session.js"></script>

        <?php include 'components/footer.php'; ?>

        <?php } else {
        header("Location: index.php");
    } ?>