<?php
session_start();

$con = mysqli_connect('localhost', 'root', '', 'qrs');
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from POST request
    $expense_id = isset($_POST['expense_id']) ? $_POST['expense_id'] : '';
    $student_name = isset($_POST['student_name']) ? $_POST['student_name'] : '';
    $ccs_days = isset($_POST['ccs_days']) ? $_POST['ccs_days'] : '';
    $membership = isset($_POST['membership']) ? $_POST['membership'] : '';
    $ac_party = isset($_POST['ac_party']) ? $_POST['ac_party'] : ''; // Fixed variable name
    $palaro = isset($_POST['palaro']) ? $_POST['palaro'] : '';
    $community_extension = isset($_POST['community_extension']) ? $_POST['community_extension'] : '';
    $penalty = isset($_POST['penalty']) ? $_POST['penalty'] : '';

    $updateQuery = "UPDATE expenses SET student_name = '$student_name', ccs_days = '$ccs_days', 
                    membership = '$membership', ac_party = '$ac_party', palaro = '$palaro', 
                    community_extension = '$community_extension', penalty = '$penalty' 
                    WHERE expense_id = '$expense_id'";

    if (mysqli_query($con, $updateQuery)) {
        echo "Expense updated successfully";
    } else {
        echo "Error updating expense: " . mysqli_error($con);
    }
} else {
    echo "Invalid request method";
}

mysqli_close($con);
?>
