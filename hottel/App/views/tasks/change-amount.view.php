<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
</head>
<body>
    <h1><?= $title ?></h1>



    <form action="/admin-change-amount" method="post">
        <label for="room_amount">New Room Amount:</label>
        <input type="number" id="room_amount" name="room_amount" required>
        <br>
        <form action="/">
        <button type="submit">Update</button>
        </form>
    </form>
</body>
</html>