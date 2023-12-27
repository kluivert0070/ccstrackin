<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'qrs'); // Connect to the "qrs" database

if (isset($_GET['expense_id'], $_GET['exp_title_id'])) {
    $expense_id = $_GET['expense_id'];
    $exp_title_id = $_GET['exp_title_id'];

    $query = "DELETE FROM expenses WHERE expense_id=$expense_id";

    if (mysqli_query($db, $query)) {
        header("location: number_expense.php?exp_title_id={$exp_title_id}");
        exit(); 
    } else {
        echo "Error: " . mysqli_error($db);
    }
}
?>
