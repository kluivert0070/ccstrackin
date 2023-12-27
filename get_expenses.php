<?php
$con = mysqli_connect('localhost', 'root', '', 'qrs');
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

$exp_title_id = isset($_GET['expense_title_id']) ? mysqli_real_escape_string($con, $_GET['expense_title_id']) : 0;

if ($exp_title_id == 0) {
    echo "expense_title_id is not provided.";
    exit();
}

// Retrieve user_id from the session
session_start();
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

if ($user_id == 0) {
    echo "User ID not found.";
    exit();
}

// Fetch expenses for the given exp_title_id and user_id
$selectQuery = "SELECT * FROM expenses WHERE expense_fk_id = '$exp_title_id' AND user_id = '$user_id'";
$result = mysqli_query($con, $selectQuery);

if (!$result) {
    die('Query Error: ' . mysqli_error($con));
}

$expenses = array();

while ($row = mysqli_fetch_assoc($result)) {
    $expenses[] = $row;
}

// Send as json ni
header('Content-Type: application/json');
echo json_encode($expenses);

mysqli_close($con);
?>
