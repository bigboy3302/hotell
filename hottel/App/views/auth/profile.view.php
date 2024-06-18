<?php 
require "../App/views/components/head.php";
require "../App/views/components/navbar.php";
?>
<main class="create-edit-main">
    <div class="container-profile">
        <div class="create-edit-div-wide">
            <div class="profile-logout-box">
            <h1>Hello, <?= htmlspecialchars($_SESSION["username"]) ?> 👋🏼
                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                    <span style="color:purple">(Admin)</span>
                <?php endif; ?>
            </h1>
                </div>
            <div class="profile-div">
                <form method="POST" class="auth-form" onsubmit="return confirm('Are you sure you want to change your username?');">
                    <label class="auth-label">
                        New Username:
                        <input class="auth-input" type="text" name="new_username" value="<?= $_POST["new_username"] ?? "" ?>"/>
                    </label>
                    <button class="auth-button" name="update_username">Update Username</button>
                </form>
                <?php if (isset($errors["new_username"])) { ?>
                    <p class="invalid-data"> <?= $errors["new_username"] ?> </p>
                <?php } ?>
            </div>
            <div class="profile-div">
                <form method="POST" class="auth-form" onsubmit="return confirm('Are you sure you want to change your email address?');">
                    <label class="auth-label">
                        New Email:
                        <input class="auth-input" type="email" name="new_email" value="<?= $_POST["new_email"] ?? "" ?>"/>
                    </label>
                    <button class="auth-button" name="update_email">Update Email</button>
                </form>
                <?php if (isset($errors["new_email"])) { ?>
                    <p class="invalid-data"> <?= $errors["new_email"] ?> </p>
                <?php } ?>
                <form method="POST" class="auth-form" onsubmit="return confirm('Are you sure you want to change your password?');">
                    <label class="auth-label">
                        New Password:
                        <input class="auth-input" type="password" name="new_password"/>
                    </label>
                    <button class="auth-button" name="update_password">Update Password</button>
                </form>
                <?php if (isset($errors["new_password"])) { ?>
                    <p class="invalid-data"> <?= $errors["new_password"] ?> </p>
                <?php } ?>
            </div>
            <br>
            <div class="profile-logout-box">
            <h2> Log out? </h2>
            <form action="/logout" method="POST">
                <button class="shadow_logout__btn">Logout</button>
            </form>
            </div>
            <br>
        </div>
    </div>
</main>

<?php
require "../App/views/components/footer.php";  
?>

