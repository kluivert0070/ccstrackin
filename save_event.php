<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'qrs'); 

if (isset($_POST['submit'])) {
    $event = mysqli_real_escape_string($db, $_POST['event']);
    $date = mysqli_real_escape_string($db, $_POST['date']);
    $user_id = $_SESSION['user_id'];

    if (!empty($event) && !empty($date)) {
        $query = "INSERT INTO event (event, date, user_id) VALUES ('$event', '$date', '$user_id')";
        
        if (mysqli_query($db, $query)) {
            header('location: event.php'); 
        } else {
            echo "Error: " . mysqli_error($db);
        }
    } else {
        echo "Event name and date are required fields.";
    }
}
?>
