<?php
    // saveexpense.php

    $con = mysqli_connect('localhost', 'root', '', 'qrs');
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = isset($_POST['name']) ? mysqli_real_escape_string($con, $_POST['name']) : '';
        $eventID = isset($_POST['event_id']) ? mysqli_real_escape_string($con, $_POST['event_id']) : '';
        $penalty = isset($_POST['penalty']) ? mysqli_real_escape_string($con, $_POST['penalty']) : '';
        $contribution = isset($_POST['contribution']) ? mysqli_real_escape_string($con, $_POST['contribution']) : '';

        // Update the database with the expense data
        $updateQuery = "UPDATE logs SET penalty = '$penalty', contribution = '$contribution' WHERE name = '$name' AND event_id = '$eventID'";
        $updateResult = mysqli_query($con, $updateQuery);

        if ($updateResult) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'error' => 'Failed to update expense data']);
        }
    } else {
        echo json_encode(['status' => 'error', 'error' => 'Invalid request method']);
    }
?>
