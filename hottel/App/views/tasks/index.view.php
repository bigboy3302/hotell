<?php require "../App/views/components/head.php"; ?>
<?php require "../App/views/components/navbar.php"; ?>
<div class="container">
    <h1 class="center">Home page</h1>

    <div class="form-container"> <!-- Add this wrapper div -->
        <form action="/" method="GET" class="search-form">
            <input type="text" name="search" placeholder="Search apartments...">
            <select name="sort">
                <option value="">----</option>
                <option value="price_high_low">Price high to low</option>
                <option value="price_low_high">Price low to high</option>
                <option value="date_new_old">Newest</option>
                <option value="date_old_new">Oldest</option>
            </select>
            <button type="submit">Search</button>
        </form>
    </div>

    <br>    
    <br>
    <div class="apartment-container">
        <?php if (!empty($apartments)): ?>
            <?php foreach ($apartments as $apartment): ?>
                <div class="apartment-box">
                    <div class="apartment">
                        <h2 style="color: 5e503f"><?= htmlspecialchars($apartment['name']) ?></h2>
                        <p>Price: $<?= number_format($apartment['price'], 2) ?> / Month</p>
                        <img src="<?= htmlspecialchars($apartment['image_url']) ?>" alt="<?= htmlspecialchars($apartment['name']) ?>">
                        <p class="<?= $apartment['amount'] > 0 ? 'available' : 'no-rooms' ?>">Rooms Available: <?= htmlspecialchars($apartment['amount']) ?></p>
                        <div class="stars">
                            <p>Rating: <?= str_repeat('⭐', $apartment['stars']) ?></p>
                        </div>
                        <form action="/show" method="POST">
                            <input type="hidden" name="apartment_id" value="<?= htmlspecialchars($apartment['apartment_id']) ?>">
                            <button type="submit">Information</button>
                        </form>
                        <?php if ($apartment['amount']): ?>
                            <form action="/reserve" method="POST" onsubmit="disableButton(this)">
                                <input type="hidden" name="apartment_id" value="<?= htmlspecialchars($apartment['apartment_id']) ?>">
                                <button type="submit" class="reserve-button">Reserve</button>
                            </form>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                            <form action="" method="POST" style="display:inline;">
                                <input type="hidden" name="apartment_id" value="<?= htmlspecialchars($apartment['apartment_id']) ?>">
                                <button type="submit" name="delete" class="delete-button">Delete</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No apartments available.</p>
        <?php endif; ?>
    </div>
</div>

<?php require "../App/views/components/footer.php"; ?>

<script>
function disableButton(form) {
    var buttons = document.getElementsByClassName('reserve-button');
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].disabled = true;
    }
}
</script>
