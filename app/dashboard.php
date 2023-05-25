<?php
session_start();
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

        <div class="d-flex flex-column justify-content-top align-items-center" style="min-height: 90vh; width: 100%">


            <h1 class=" mt-5 mb-5">Willkommen bei Task Master</h1>
            <div class="container" style="width: 70%">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Fertig</th>
                            <th scope="col">Title</th>
                            <th scope="col">Beschreibung</th>
                            <th scope="col">Datum</th>
                            <th scope="col">Priorität</th>
                            <th scope="col">Zuständig</th>
                            <th scope="col">Bearbeiten</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">
                                <input class="form-check-input center" type="checkbox" value="" id="flexCheckDefault">
                            </th>
                            <td>Infrastruktur abgeben</td>
                            <td>Ich muss schnell wie möglich mein Infrastruktur Abgage machen</td>
                            <td>28.05.2023</td>
                            <td>High</td>
                            <td>Lucien</td>
                            <td>
                                <button class="btn btn-success center">Edit</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- button redirecting to the new_task page -->
            <a href="new_task.php" class="mt-5 btn btn-primary">Add Task</a>

            <!-- get all tasks from the database and display them  in the table -->




            <?php include 'components/footer.php'; ?>

        <?php } else {
        header("Location: index.php");
    } ?>