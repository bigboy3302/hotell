<?php require "../App/views/components/head.php"; ?>
<?php require "../App/views/components/navbar.php"; ?>
<div class="container">
    <h1 class="center">Change room amount</h1>

    <?php if ($error): ?>
        <p style="color:red;" class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <div class="apartment-container">
        <?php if (!empty($apartments)): ?>
            <?php foreach ($apartments as $apartment): ?>
                <div class="apartment-box">
                    <div class="apartment">
                        <h2><?= htmlspecialchars($apartment['name']) ?></h2>
                        <img src="<?= htmlspecialchars($apartment['image_url']) ?>" alt="<?= htmlspecialchars($apartment['name']) ?>">
                        <p class="<?= $apartment['amount'] > 0 ? 'available' : 'no-rooms' ?>">Rooms Available: <?= htmlspecialchars($apartment['amount']) ?></p>
                        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                            <button onclick="showChangeAmountForm(<?= $apartment['apartment_id'] ?>)">Change room amount</button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No apartments available.</p>
        <?php endif; ?>
    </div>
</div>

<br>

<div id="changeAmountForm" class="changeAmountForm" style="display:none;">
    <h2>Change Room Amount for Apartment <span id="apartmentId"></span></h2>
    <form action="/admin-add-amount" method="post" onsubmit="return validateForm()">
        <input type="hidden" id="roomId" name="room_id">
        <label for="roomAmount">New Room Amount:</label>
        <input type="number" id="roomAmount" name="room_amount">
        <button type="submit">Update</button>
    </form>
    <p id="error-message" style="color:red;"></p>
</div>

<?php require "../App/views/components/footer.php"; ?>

<script>
function showChangeAmountForm(apartmentId) {
    document.getElementById('apartmentId').innerText = apartmentId;
    document.getElementById('roomId').value = apartmentId;
    document.getElementById('changeAmountForm').style.display = 'flex';
}

function validateForm() {
    var roomAmount = document.getElementById('roomAmount').value.trim();
    var errorMessage = document.getElementById('error-message');

    if (roomAmount === '' || isNaN(roomAmount) || roomAmount < 0) {
        errorMessage.textContent = "Please enter a valid number for room amount.";
        return false;
    }

    errorMessage.textContent = "";
    return true;
}
</script>

<style>
    .input-label {
        width: 100px;
    }

    .apartment-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px; /* Add gap between apartment boxes */
    }

    .apartment-box {
        width: 200px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        background-color: #f9f9f9;
        position: relative;
    }

    .available {
        color: green;
    }

    .no-rooms {
        color: red;
    }

    body {
        margin: 0;
    }

    img {
        width: 100%; /* Ensure images fit within the apartment box */
        height: auto;
        border-radius: 8px;
    }

    .delete-button {
        background-color: red;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 5px;
        margin-top: 5px;
    }
</style>
