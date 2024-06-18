<?php require "../App/views/components/head.php"; ?>
<?php require "../App/views/components/navbar.php"; ?>
<br>
<h1 class="center">Our Customer Reviews ⭐</h1>
<br>
<div class="form-container">
    <form method="GET" class="search-form">
        <input type="text" name="search" placeholder="Search apartments..." value="<?= htmlspecialchars($search ?? '') ?>">
        <select name="sort">
            <option value="">----</option>
            <option value="stars_high_low" <?= $sort === 'stars_high_low' ? 'selected' : '' ?>>Stars: High to Low</option>
            <option value="stars_low_high" <?= $sort === 'stars_low_high' ? 'selected' : '' ?>>Stars: Low to High</option>
        </select>
        <button type="submit">Sort</button>
    </form>
</div>
<br>
<div class="reviews-container">
    <?php if (!empty($reviews)): ?>
        <?php foreach ($reviews as $review): ?>
            <div class="review-box">
                <h2>Apartment: <?= htmlspecialchars($review['apartment'] ?? '') ?></h2><br>
                <h3>Name: <?= htmlspecialchars($review['name'] ?? '') ?></h3><br>
                <p>Experience: <?= htmlspecialchars($review['experience'] ?? '') ?></p><br>
                <p>Rating: <?= str_repeat('⭐', $review['stars'] ?? 0) ?></p>
                <?php if ($is_admin): ?>
                    <form action="/delete-review" method="POST">
                        <input type="hidden" name="review_id" value="<?= htmlspecialchars($review['id'] ?? '') ?>">
                        <button type="submit" class="delete-button">Delete</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>There are no reviews currently.</p>
    <?php endif; ?>
</div>

<?php require "../App/views/components/footer.php"; ?>

<style>
    * {
        margin: 0;
    }
    .center {
        text-align: center;
    }

    .reviews-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .review-box {
        width: 80%;
        max-width: 600px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        background-color: #f9f9f9;
        position: relative;
    }

    .delete-button {
        background-color: red;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 5px;
        margin-top: 10px;
    }

    body {
        margin: 0;
    }
</style>
