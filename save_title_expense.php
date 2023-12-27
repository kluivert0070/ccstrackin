<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'qrs');

if (isset($_POST['submit'])) {
    $expenseName = mysqli_real_escape_string($db, $_POST['expenseName']);
    $user_id = $_SESSION['user_id'];

    if (!empty($expenseName)) {
        $query = "INSERT INTO expense_title (expenseName, user_id) VALUES ('$expenseName', '$user_id')";

        if (mysqli_query($db, $query)) {
            header('location: ccs_expense.php');
            exit();
        } else {
            echo "Error: " . mysqli_error($db);
        }
    } else {
        echo "Expense name is a required field.";
    }
}
?>
