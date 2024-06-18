<?php require "../App/views/components/head.php" ?>
<?php require "../App/views/components/navbar.php" ?>

<h1 class="center">Create Apartment</h1>
<div class="container form-container">

    <form action="/create-ap" method="POST" class="form">
        <label for="name" class="form-label label-name">Apartment Name:</label>
        <input type="text" id="name" name="name" class="form-input input-name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
        <?php if (!empty($errors['name'])): ?>
            <p class="form-error error-name"><?= htmlspecialchars($errors['name']) ?></p>
        <?php endif; ?>

        <label for="price" class="form-label label-price">Price:</label>
        <input type="number" id="price" name="price" class="form-input input-price" step="0.01" value="<?= htmlspecialchars($_POST['price'] ?? '') ?>">
        <?php if (!empty($errors['price'])): ?>
            <p class="form-error error-price"><?= htmlspecialchars($errors['price']) ?></p>
        <?php endif; ?>

        <label for="amount" class="form-label label-amount">Amount:</label>
        <input type="number" id="amount" name="amount" class="form-input input-amount" value="<?= htmlspecialchars($_POST['amount'] ?? '') ?>">
        <?php if (!empty($errors['amount'])): ?>
            <p class="form-error error-amount"><?= htmlspecialchars($errors['amount']) ?></p>
        <?php endif; ?>

        <label for="stars" class="form-label label-stars">Stars:</label>
        <select id="stars" name="stars" class="form-select select-stars">
            <option value="1" <?= (isset($_POST['stars']) && $_POST['stars'] == 1) ? 'selected' : '' ?>>⭐</option>
            <option value="2" <?= (isset($_POST['stars']) && $_POST['stars'] == 2) ? 'selected' : '' ?>>⭐⭐</option>
            <option value="3" <?= (isset($_POST['stars']) && $_POST['stars'] == 3) ? 'selected' : '' ?>>⭐⭐⭐</option>
            <option value="4" <?= (isset($_POST['stars']) && $_POST['stars'] == 4) ? 'selected' : '' ?>>⭐⭐⭐⭐</option>
            <option value="5" <?= (isset($_POST['stars']) && $_POST['stars'] == 5) ? 'selected' : '' ?>>⭐⭐⭐⭐⭐</option>
        </select>
        <?php if (!empty($errors['stars'])): ?>
            <p class="form-error error-stars"><?= htmlspecialchars($errors['stars']) ?></p>
        <?php endif; ?>
        <br>
        <label for="image_url" class="form-label label-image_url">Image URL (Copy image address):</label>
        <input type="text" id="image_url" name="image_url" class="form-input input-image_url" value="<?= htmlspecialchars($_POST['image_url'] ?? '') ?>">
        <?php if (!empty($errors['image_url'])): ?>
            <p class="form-error error-image_url"><?= htmlspecialchars($errors['image_url']) ?></p>
        <?php endif; ?>

        <label for="description" class="form-label label-description">Description:</label>
        <textarea id="description" name="description" class="form-textarea textarea-description"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
        <?php if (!empty($errors['description'])): ?>
            <p class="form-error error-description"><?= htmlspecialchars($errors['description']) ?></p>
        <?php endif; ?>

        <label for="date" class="form-label label-date">Date:</label>
        <input type="date" id="date" name="date" class="form-input input-date" value="<?= htmlspecialchars($_POST['date'] ?? '') ?>">
        <?php if (!empty($errors['date'])): ?>
            <p class="form-error error-date"><?= htmlspecialchars($errors['date']) ?></p>
        <?php endif; ?>

        <button type="submit" class="form-button button-submit">Create Apartment</button>
    </form>
</div>

<?php require "../App/views/components/footer.php" ?>