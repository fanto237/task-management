<?php
session_start();
include 'config/database.php';

if (isset($_SESSION['username']) && isset($_SESSION['id'])) { ?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <title>Task Master</title>
    </head>

    <body>
        <nav class="navbar navbar-expand-sm navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="/dashboard.php">
                    <img src="../img/logo.png" alt="logo" width="40" height="40" class="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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

        <!-- Begin of the page content -->

        <div class="d-flex flex-column justify-content-top align-items-center" style="min-height: 90vh; width: 100%">
            <h1 class=" mt-5 mb-5 underline">Task bearbeiten</h1>
            <?php
            include 'config/database.php';
            $id = $_GET['id'];
            $sql = "SELECT * FROM tasks WHERE id = '$id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $prio = $row['priority'];
            $desc = $row['description'];
            $start = date('Y-m-d', strtotime($row['startdate']));
            $end = date('Y-m-d', strtotime($row['enddate']));

            ?>
            <div style="width: 50%;">
                <div class="mb-3">
                    <label for="task-name" class="form-label">Titel :</label>
                    <input type="text" name="title-input" class="form-control" id="<?= $row['id'] ?>" value="<?= $row['title'] ?>" require>
                </div>
                <div class="mb-3">
                    <label for="task-desc" class="form-label">Beschreibung :</label>
                    <textarea class="form-control" id="add-desc" rows="3" cols="50" require"><?php echo $desc ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="task-for" class="form-label">Zuweisen an:</label>
                    <select class="form-select" aria-label="Default select example" id="add-for">
                        <option selected> <?php echo $row['assignedTo'] ?> </option>
                        <?php
                        include 'config/database.php';
                        $users = array();
                        $key = 'users';
                        $res = $redis->get('isUsersChanged');
                        if (!$redis->get($key) or $res == 'true') {
                            $sql = "SELECT name FROM users";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $users[] = $row;
                            }
                            $redis->set($key, serialize($users));
                            $redis->set('isUsersChanged', 'false');
                        } else {
                            $users = unserialize($redis->get($key));
                        }

                        foreach ($users as $user) {
                            echo "<option>" . $user['name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="task-priority" class="form-label">Priorität :</label>
                    <select class="form-select" aria-label="Default select example" id="add-priority">
                        <option selected> <?php echo $prio ?> </option>
                        <option>Hoch</option>
                        <option>Normal</option>
                        <option>Niedrig</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="task-name" class="form-label">Startdatum :</label>
                    <input type="date" class="form-control" id="add-start" value="<?= $start ?>" require>
                </div>
                <div class="mb-3">
                    <label for="task-name" class="form-label">Enddatum :</label>
                    <input type="date" class="form-control" id="add-end" value="<?= $end ?>" require>
                </div>
            </div>
            <div>
                <button class="btn btn-primary m-3 ml-3" id="edit-task">Speichern</button>
                <a href="dashboard.php" class="btn btn-danger m-3 mr-3">Abbrechen</a>
            </div>
            <!-- link to redirect to the dashboard page after saving the new task in the database -->
        </div>

        <!-- add session.js js scipt here -->
        <script src="session.js"></script>
        <?php include 'components/footer.php'; ?>

    <?php } else {
    header("Location: index.php");
} ?>