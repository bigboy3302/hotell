<?php require "../App/views/components/head.php" ?>

<div class="center">


<main class="auth-main-reg">
    <div class="auth-div">
        <h1 class="auth-h1">Register</h1>
        <form method="POST" class="auth-form">
            <label class="auth-label">
                Username
                <input class="auth-input" name="username" value="<?= $_POST["username"] ?? "" ?>"/>
            </label>
            <label class="auth-label">
                Email
                <input class="auth-input" type="email" name="email" value="<?= $_POST["email"] ?? "" ?>"/>
            </label>
            <label class="auth-label">
                Password <span>(8 chars: 1 uppercase, 1 number, 1 symbol)</span>
                <input class="auth-input" type="password" name="password" value="<?= $_POST["password"] ?? "" ?>"/>
            </label>
            <button class="auth-button">Submit</button>
        </form>
        <a href="/login">Log-in</a>
    </div>

    <?php if (isset($errors["username"])) { ?>
        <p class="invalid-data"> <?= $errors["username"] ?> </p>
    <?php } ?>
    <?php if (isset($errors["email"])) { ?>
        <p class="invalid-data"> <?= $errors["email"] ?> </p>
    <?php } ?>
    <?php if (isset($errors["password"])) { ?>
        <p class="invalid-data"> <?= $errors["password"] ?> </p>
    <?php } ?>
</main>
    </div>

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

    .auth-main-reg {
        display: flex;
        justify-content: center;
        align-items: center;
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
        align-items: center; /* Center the form elements */
    }

    .auth-label {
        margin-bottom: 10px;
        width: 100%; /* Ensure labels and inputs take full width */
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
        display: flex;
        justify-content: center;
        align-items: center;
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
