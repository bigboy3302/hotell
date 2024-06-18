<?php require "../App/views/components/head.php"; ?>

<h1 id="review-title">Write us a review about your experience</h1>
<br>
<div id="form-container">
    <form action="" method="POST" id="review-form">
        <label for="apartment">Name of apartment:</label>
        <input type="text" name="apartment_display" id="apartment-display" value="<?= htmlspecialchars($selectedApartment) ?>" readonly>
        <input type="hidden" name="apartment" value="<?= htmlspecialchars($selectedApartment) ?>">
        <br><br>
        <label>Your name:</label>
        <br>
        <input type="text" name="name" id="user-name" value="<?= htmlspecialchars($_SESSION['username']) ?>" readonly><br><br>
        <label>Your experience:</label>
        <input type="text" name="experience" id="experience" value="<?= htmlspecialchars($_POST['experience'] ?? '') ?>">
        <?php if (!empty($errors['experience'])): ?>
            <p class="error"><?= htmlspecialchars($errors['experience']) ?></p>
        <?php endif; ?>
        <br><br>
        <label for="stars">Stars:</label><br>
        <select id="stars" name="stars">
            <option value="1" <?= (isset($_POST['stars']) && $_POST['stars'] == 1) ? 'selected' : '' ?>>⭐</option>
            <option value="2" <?= (isset($_POST['stars']) && $_POST['stars'] == 2) ? 'selected' : '' ?>>⭐⭐</option>
            <option value="3" <?= (isset($_POST['stars']) && $_POST['stars'] == 3) ? 'selected' : '' ?>>⭐⭐⭐</option>
            <option value="4" <?= (isset($_POST['stars']) && $_POST['stars'] == 4) ? 'selected' : '' ?>>⭐⭐⭐⭐</option>
            <option value="5" <?= (isset($_POST['stars']) && $_POST['stars'] == 5) ? 'selected' : '' ?>>⭐⭐⭐⭐⭐</option>
        </select>
        <?php if (!empty($errors['stars'])): ?>
            <p class="error"><?= htmlspecialchars($errors['stars']) ?></p>
        <?php endif; ?>
        <br><br>
        <div class="button-container">
            <button type="submit" id="submit-button">Submit</button>
        </div>
    </form>
    <form action="/">
        <div class="button-container">
            <button id="cancel-button">I don't want to leave a review</button>
        </div>
    </form>
</div>

<?php require "../App/views/components/footer.php"; ?>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #EAE0D5;
        color: #0A0908;
        margin: 0;
        padding: 20px;
    }

    #review-title {
        text-align: center;
        color: #0A0908;
        margin-bottom: 20px;
    }

    #form-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }

    #review-form {
        background-color: #EAE0D5;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        text-align: center;
    }

    #review-form label {
        font-weight: bold;
        margin-bottom: 10px;
        color: #22333B;
        font-size: 18px;
    }

    #apartment-display,
    #user-name,
    #experience {
        width: 70%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #C6AC8F;
        border-radius: 4px;
        background-color: #fff;
        color: #0A0908;
        text-align: center;
        font-size: 16px; /* Increase font size */
    }

    #stars {
        width: 50%; /* Reduce width */
        height: 40px; /* Increase height */
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #C6AC8F;
        border-radius: 4px;
        background-color: #fff;
        color: #0A0908;
        text-align: center;
        font-size: 16px; /* Increase font size */
    }

    .button-container {
        text-align: center;
    }

    #submit-button,
    #cancel-button {
        background-color: #5E503F;
        color: #EAE0D5;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 4px;
        font-size: 16px;
    }

    #submit-button:hover,
    #cancel-button:hover {
        background-color: #C6AC8F;
    }

    #cancel-button {
        background-color: #22333B;
    }

    #cancel-button:hover {
        background-color: #5E503F;
    }

    .error {
        color: red;
        font-size: 14px;
        margin-top: -10px;
        margin-bottom: 10px;
    }
</style>
