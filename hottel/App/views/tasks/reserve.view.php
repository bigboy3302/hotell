<?php require "../App/views/components/head.php"; ?>
<?php require "../App/views/components/navbar.php"; ?>

<div class="container">
    <h1 class="center">Reserved apartments</h1>

    <?php if ($error): ?>
        <p style="color:red; text-align: center;" class="error"><?= $error ?></p>
    <?php endif; ?>

    <div class="apartment-container">
        <?php if (!empty($reservations)): ?>
            <?php foreach ($reservations as $reservation): ?>
                <div class="apartment-box">
                    <h2><?= htmlspecialchars($reservation['name']) ?></h2>
                    <p>Price: $<?= number_format($reservation['price'], 2) ?> / Month</p>
                    <p style="color:orange;">Status: Reserved</p>
                    <p>Date: <?= date('F j, Y', strtotime($reservation['date'])) ?></p>
                    <div class="stars">
                        <p>Rating: <?= str_repeat('⭐', $reservation['stars']) ?></p>
                    </div>
                    <form action="/reserve" method="POST">
                        <input type="hidden" name="reserve_id" value="<?= htmlspecialchars($reservation['reserve_id']) ?>">
                        <button type="submit" name="cancel">Cancel reservation</button>
                    </form>
                    <form action="/write-review" method="POST">
                        <input type="hidden" name="apartment" value="<?= htmlspecialchars($reservation['name']) ?>">
                        <input type="hidden" name="reserve_id" value="<?= htmlspecialchars($reservation['reserve_id']) ?>">
                        <input type="hidden" name="finished" value="1">
                        <button type="submit">Finished my stay</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No apartments are currently reserved.</p>
        <?php endif; ?>
        
    </div>
</div>

<?php require "../App/views/components/footer.php"; ?>

