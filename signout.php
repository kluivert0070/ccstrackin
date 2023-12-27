<?php
$name = $_REQUEST["name"];
$eventID = $_REQUEST["event_id"];

if (empty($name) || empty($eventID)) {
    $response = ['error' => 'No student name or event ID provided.'];
} else {
    // Connect to the database
    $con = mysqli_connect('localhost', 'root', '', 'qrs');

    if (mysqli_connect_errno()) {
        $response = ['error' => 'Failed to connect to MySQL: ' . mysqli_connect_error()];
    } else {
        $stmt = $con->prepare("UPDATE logs SET status = 'signed out', sign_out_time = NOW() WHERE name = ? AND event_id = ?");
        $stmt->bind_param("si", $name, $eventID);

        if ($stmt->execute()) {
            $response = ['status' => 'signed out', 'name' => $name, 'sign_out_time' => date("g:i A")];
        } else {
            $response = ['error' => 'Sign out failed'];
        }

        $stmt->close();
        mysqli_close($con);
    }
}

echo json_encode($response);
?>
