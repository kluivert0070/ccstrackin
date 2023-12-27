<?php
$con = mysqli_connect('localhost', 'root', '', 'qrs');
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $studentName = mysqli_real_escape_string($con, $_POST['studentName']);
    $membership = mysqli_real_escape_string($con, $_POST['membership']);
    $ccsDays = mysqli_real_escape_string($con, $_POST['ccsDays']);
    $acParty = mysqli_real_escape_string($con, $_POST['acParty']);
    $palaro = mysqli_real_escape_string($con, $_POST['palaro']);
    $communityExtension = mysqli_real_escape_string($con, $_POST['communityExtension']);
    $penalty = mysqli_real_escape_string($con, $_POST['penalty']);

    // Check if an expense ID is provided 
    $expenseId = isset($_POST['expenseId']) ? mysqli_real_escape_string($con, $_POST['expenseId']) : 0;

    if ($expenseId > 0) {
        // Update existing expense
        $updateQuery = "UPDATE expenses SET student_name = '$studentName', membership = '$membership', ccs_days = '$ccsDays', ac_party = '$acParty', 
                        palaro = '$palaro', community_extension = '$communityExtension', penalty = '$penalty' WHERE expense_id = '$expenseId'";

        if (mysqli_query($con, $updateQuery)) {
            echo "Expense updated successfully!";
        } else {
            echo "Error updating expense: " . mysqli_error($con);
        }
    } else {
        // Insert new expense
        $exp_title_id = isset($_POST['expense_fk_id']) ? mysqli_real_escape_string($con, $_POST['expense_fk_id']) : 0;
        $insertQuery = "INSERT INTO expenses (student_name, membership, ccs_days, ac_party, palaro, community_extension, penalty, expense_fk_id) 
                        VALUES ('$studentName', '$membership', '$ccsDays', '$acParty', '$palaro', '$communityExtension', '$penalty', '$exp_title_id')";
                        
        if (mysqli_query($con, $insertQuery)) {
            echo "Expense saved successfully!";
        } else {
            echo "Error saving expense: " . mysqli_error($con);
        }
    }
}

mysqli_close($con);
?>
