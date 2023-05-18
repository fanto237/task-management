<?php include 'components/header.php'; ?>


<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <form id="register-form" class="border shadow p-3 rounded" style="width: 400px;">
        <h3 class="text-center">Registrieren</h3>
        <?php
        if (isset($_GET['error'])) {
            echo '<div class="alert alert-danger text-center" role="alert">' . $_GET['error'] . '</div>';
        }
        ?>
        <div class="mb-3">
            <label for="username" class="form-label">Benutzername</label>
            <input type="text" class="form-control" id="username" name="username">
            <p class="error-message" id="username-feedback"></p>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Passwort</label>
            <input type="password" class="form-control" id="password" name="password">
            <p class="error-message" id="password-feedback"></p>
        </div>
        <button type="submit" class="btn btn-primary">Registrieren</button>
    </form>
</div>
<script src="client.js"></script>

<?php include 'components/footer.php'; ?>