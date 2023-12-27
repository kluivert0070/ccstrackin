<?php
$q = $_REQUEST["q"];
$event_id = $_REQUEST["event_id"];

if (empty($q) || empty($event_id)) {
    echo "No student name or event ID provided.";
    exit();
}

// Check students 
if (isset($_COOKIE["studentName"])) {
    $studentName = $_COOKIE["studentName"];
} else {
    $studentName = "";
}

// Connect to the database
$con = mysqli_connect('localhost', 'root', '', 'qrs');

// Check connection kung naa error or wala
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
if ($q != "" && $event_id != "") {
    $stmt = $con->prepare("SELECT * FROM logs WHERE name = ? AND event_id = ?");
    $stmt->bind_param("si", $q, $event_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        $stmt = $con->prepare("INSERT INTO logs (name, sign_in_time, event_id) VALUES (?, NOW(), ?)");
        $stmt->bind_param("si", $q, $event_id);
        if ($stmt->execute()) {
            // Set student name
            setcookie("studentName", $q, time() + 3600, "/"); // expire duration
            echo '<div class="alert alert-success"><strong>Success!</strong> Student successfully registered</div>';
            echo 'Student Name: ' . $q;
        } else {
            echo '<div class="alert alert-danger"><strong>Error!</strong> Student registration failed: ' . mysqli_error($con) . '</div>';
        }
    } else {
        echo 'Student Name: ' . $q;
        echo '<div class="alert alert-warning"><strong>Warning!</strong> Student is already registered</div>';
    }
}
?>
