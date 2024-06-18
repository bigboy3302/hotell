<?php require "../App/views/components/head.php"; ?>
<?php require "../App/views/components/navbar.php"; ?>
<div class="container">
    <h1 class="center"><?= $apartment['name'] ?></h1>

    <div class="apartment-container">
        <div style="width:330px;"class="apartment-box">
            <div class="apartment">
                <p>Description: <?= $apartment['description'] ?></p>
                <p>Price: $<?= number_format($apartment['price'], 2) ?> / Month</p>
                <p class="<?= $apartment['amount'] > 0 ? 'available' : 'no-rooms' ?>">Rooms Available: <?= $apartment['amount'] ?></p>
                <p>Added: <?= date('F j, Y', strtotime($apartment['date'])) ?></p>
                <div class="stars">
                    <p>Rating: <?= str_repeat('⭐', $apartment['stars']) ?></p>
                </div>
                <img src="<?= $apartment['image_url'] ?>" alt="<?= $apartment['name'] ?>">
                <?php if ($apartment['amount']): ?>
                            <form action="/reserve" method="POST" onsubmit="disableButton(this)">
                                <input type="hidden" name="apartment_id" value="<?= $apartment['apartment_id'] ?>">
                                <button type="submit" class="reserve-button">Reserve</button>
                            </form>
                        <?php endif; ?>
                <form action="/">
                    <button>Back to Home</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require "../App/views/components/footer.php"; ?>



