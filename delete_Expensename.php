<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'qrs'); // Connect to the "qrs" database

if (isset($_GET['delete_expenseName'])) {
    $exp_title_id = $_GET['delete_expenseName'];

    $query = "DELETE FROM expense_title WHERE exp_title_id=$exp_title_id";

    if (mysqli_query($db, $query)) {
        header('location: ccs_expense.php'); 
    } else {
        echo "Error: " . mysqli_error($db);
    }
}
?>
