<?php
isAdmin();

$title = "Change room amount";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate the input
    $new_amount = isset($_POST['room_amount']) ? intval($_POST['room_amount']) : null;
    $room_id = isset($_POST['room_id']) ? intval($_POST['room_id']) : null;
    
    if ($new_amount > 0 && $room_id > 0) {
        try {
            // Load database configuration from config.php
            $config = require "../App/config.php";

            // Include the Task model
            require_once "../App/models/Task.php";

            // Update the room amount using the model function
            if (Task::updateRoomAmount($config, $room_id, $new_amount)) {
                $message = "Room amount updated successfully.";
                header("Location: /"); // Redirect to home or another relevant page
                exit(); // Ensure no further code is executed
            } else {
                $message = "Failed to update room amount.";
            }
        } catch (Exception $e) {
            $message = "An error occurred: " . $e->getMessage();
        }
    } else {
        $message = "Invalid room amount or room ID.";
    }
}

// Include the view
require "../App/views/tasks/change-amount.view.php";
?>
