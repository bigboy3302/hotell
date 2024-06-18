<?php require "../App/views/components/head.php"; ?>
<?php require "../App/views/components/navbar.php"; ?>
<div class="container">
    <h1 class="center">Edit Apartment</h1>

    <form action="/" method="POST">
        <input type="hidden" name="apartment_id" value="<?= $apartment['apartment_id'] ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?= $apartment['name'] ?>">
        <label for="price">Price:</label>
        <input type="text" id="price" name="price" value="<?= $apartment['price'] ?>">
        <label for="amount">Amount:</label>
        <input type="text" id="amount" name="amount" value="<?= $apartment['amount'] ?>">
        <label for="stars">Stars:</label>
        <input type="text" id="stars" name="stars" value="<?= $apartment['stars'] ?>">
        <button type="submit">Update</button>
    </form>
</div>
<?php require "../App/views/components/footer.php"; ?>
