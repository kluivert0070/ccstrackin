<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'qrs'); // Connect to the "qrs" database

if (isset($_GET['delete_event'])) {
    $eventID = $_GET['delete_event'];

    $query = "DELETE FROM event WHERE eventID=$eventID";

    if (mysqli_query($db, $query)) {
        header('location: event.php'); 
    } else {
        echo "Error: " . mysqli_error($db);
    }
}
?>
