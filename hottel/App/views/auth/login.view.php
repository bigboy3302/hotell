<?php 
require "../App/views/components/head.php";
?>

<main class="auth-main-login">
    <div class="auth-div">
        <h1 class="auth-h1">Log-in</h1>
        <form method="POST" class="auth-form">
            <label class="auth-label">
                Username
                <input class="auth-input" type="username" name="username" value="<?= $_POST["username"] ?? "" ?>"/>
            </label>
            <br><br>
            <label class="auth-label">
                Password
                <input class="auth-input" type="password" name="password" value="<?= $_POST["password"] ?? "" ?>"/>
            </label>
            <button class="auth-button">Submit</button>
        </form>
        <a href="/register">Register</a>
    </div>

    <?php if(isset($_SESSION["flash"])) { ?>
        <p class="flash"> <?=$_SESSION["flash"]?></p>
    <?php } ?>

    <?php if (isset($errors["username"])) { ?>
        <p class="invalid-data"> <?= $errors["username"] ?> </p>
    <?php } ?>
    <?php if (isset($errors["password"])) { ?>
            <p class="invalid-data"> <?= $errors["password"] ?> </p>
    <?php } ?>
</main>

<?php require "../App/views/components/footer.php" ?>

<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .image-container {
        text-align: center;
        margin-top: 20px;
    }

    .login-img {
        height: 200px;
        width: 200px;
        border-radius: 8px;
    }

    .auth-main-login {
        display: flex;
        justify-content: center;
        align-items: center;
  /* Adjusting height to accommodate the image */
        padding: 20px;
        box-sizing: border-box;
    }

    .auth-div {
        max-width: 400px;
        width: 100%;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        box-sizing: border-box;
    }

    .auth-h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .auth-form {
        display: flex;
        flex-direction: column;
    }

    .auth-label {
        margin-bottom: 10px;
    }

    .auth-input {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .auth-button {
        width: 90px;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
        box-sizing: border-box;
    }

    .auth-button:hover {
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    }

    .flash {
        text-align: center;
        margin-top: 20px;
    }

    .invalid-data {
        text-align: center;
        margin-top: 10px;
    }

    .center {
        text-align: center;
        margin-top:200px;
    }

    a {
        display: block;
        text-align: center;
        margin-top: 10px;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }
</style>
