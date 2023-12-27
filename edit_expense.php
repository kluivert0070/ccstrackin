<?php
session_start();

$con = mysqli_connect('localhost', 'root', '', 'qrs');
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Retrieve user_id from the session
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    // Redirect case where user_id is not set or redirect to login.php if not logged in
    header('Location: login.php');
    exit();
}

if (isset($_GET['delete_expense'])) {
    $expense_id = $_GET['delete_expense'];
    mysqli_query($con, "DELETE FROM expenses WHERE expense_id=$expense_id");
    header('location: number_expense.php');
}

$exp_title_id = isset($_GET['exp_title_id']) ? $_GET['exp_title_id'] : 0;
if ($exp_title_id == 0) {
    echo "exp_title_id is not provided.";
    exit();
}

// Fetch expense details based on exp_title_id
$eventQuery = "SELECT * FROM expense_title WHERE exp_title_id = '$exp_title_id' AND user_id = '$user_id'";
$eventResult = mysqli_query($con, $eventQuery);

if ($eventRow = mysqli_fetch_assoc($eventResult)) {
    $eventName = $eventRow['expenseName'];
} else {
    echo "Title not found.";
    exit();
}

if (isset($_GET['expense_id'])) {
    $expense_id = $_GET['expense_id'];

    $expenseQuery = "SELECT * FROM expenses WHERE expense_id = '$expense_id'";
    $expenseResult = mysqli_query($con, $expenseQuery);

    if (!$expenseResult) {
        die('Query Error: ' . mysqli_error($con));
    }

    if ($expenseRow = mysqli_fetch_assoc($expenseResult)) {
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
        <link rel="icon" type="image/x-icon" href="resources/icon/CCS.png">
        <style>
         @font-face {
            font-family: "Klasik";
            src: url(resources/font/Klasik\ Regular.otf);
        }
        @font-face {
            font-family: "Poppins-Reg";
            src: url(resources/font/Poppins-Regular.ttf);
        }
        @font-face {
            font-family: "Poppins-Med";
            src: url(resources/font/Poppins-Medium.ttf);
        }
        @font-face {
            font-family: "Poppins-SemiB";
            src: url(resources/font/Poppins-SemiBold.ttf);
        }
        @font-face {
            font-family: "Poppins-Bold";
            src: url(resources/font/Poppins-Bold.ttf);
        }

        *{
            margin: 0;
            padding: 0;
        }
        
        .mar25tr{
            margin-left: 50px;
        }

        a{
            text-decoration: none;
        }

        .fontsize64{
            font-size: 64px;
        }
        .fontsize36{
            font-size: 36px;
        }
        .fontsize24{
            font-size: 24px;
        }
        .fontsize20{
            font-size: 20px;
        }
        .fontsize15{
            font-size: 15px;
        }
        .heading1{
            font-family: "Klasik";
        }
        .heading2{
            font-family: "Poppins-Bold";
        }
        .par1{
            font-family: "Poppins-Med";
        }

        .btn1{
            border-radius: 30px;
            width: 192px;
            height: 47px;
            font-family: "Klasik";
            font-size: 24px;
            color: #0E7259;
            background-color: #17B890;
            border: none;
            margin-left: 17%;
        }
        .btn2{
            border-radius: 30px;
            width: 112px;
            height: 26px;
            font-family: "Klasik";
            font-size: 16px;
            color: #0E7259;
            background-color: #17B890;
            border: none;
            margin-top: 10px;
            margin-bottom: 20px;
            cursor: pointer;
        }
        .btn3{
            border-radius: 30px;
            width: 112px;
            height: 26px;
            font-family: "Klasik";
            font-size: 16px;
            color: #3D0C0C;
            background-color: #B72323;
            border: none;
            cursor: pointer;
        }
        .btn4{
            border-radius: 30px;
            width: 200px;
            height: 26px;
            font-family: "Klasik";
            font-size: 16px;
            color: #0E7259;
            background-color: #17B890;
            border: none;
            cursor: pointer;
        }

        .btn5{
            /* display: relative; */
            /* margin-left: 90%; */
            border-radius: 30px;
            width: 112px;
            height: 26px;
            font-family: "Klasik";
            font-size: 16px;
            color: #0E7259;
            background-color: #17B890;
            border: none;
            margin-top: 10px;
            margin-bottom: 20px;
            cursor: pointer;
            /* margin-left: 50px; */
        }

        .textfield1{
            width: 600px;
            height: 55px;
            font-family: "Poppins-Reg";
            border: none;
            border-radius: 30px;
            background-color: #E8E6E5;
        }
        .textfield2{
            width: 360px;
            height: 43px;
            font-family: "Poppins-Reg";
            border: none;
            border-radius: 30px;
            background-color: #E8E6E5;
            padding-left: 25px;
        }
        .textfield3{
            width: 50%;
            height: 43px;
            font-family: "Poppins-Reg";
            border: none;
            border-radius: 30px;
            padding-left: 25px;
            border: solid 2px #0E7259;
            /* margin-left: 300px; */
        }
        .textfieldr{
            float: right;
            margin-top: -50px;
            margin-right: 50px;
        }

        .innertxt-btn{
            color: #0E7259;
        }
        .logout-btn{
            margin-right: 25px;
        }
        .open-btn{
            margin-top: 10%;
        }
        .back-btn{
            margin: 25px 0 0 25px;
        }

        .event-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .event-name{
            color: #747373;
            font-family: 'Klasik';
            font-size: 36px;
        }
        .event-date{
            color: #747373;
            font-family: 'Poppins-med';
            font-size: 24px;
            margin-top: -5px;
        }

        .add{
            color: #0E7259; 
        }

        .attendance-container{
            /* margin-left: 150px;
            margin-top: 20px; */
            text-align: left; 
            margin-left: 30%;
        }

        
        .stdname{
            font-family: "Poppins-med";
            font-size: 20px;
            color: #747373;
        }
        .stdname-act{
            font-family: "Klasik";
            font-size: 36px;
            color: #747373;
            border: none;
        }


        .modal {
            font-family: Poppins-Reg;
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
            text-align: center;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 45%;
            border-radius: 20px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        
        label{
            font-family: klasik;
            color: #0E7259;
        }
        
    </style>
        </head>

        <body>
        <a href="ccs_expense.php"><img src="resources/icon/back.png" class="back-btn"></a>
            <form id="editExpenseForm" class="attendance-container">

                <input type="hidden" id="expense_id" name="expense_id" value="<?php echo $expense_id; ?>">
                <br>
                <label for="student_name">Student Name</label><br>
                <input type="text" id="student_name" name="student_name" class="textfield3" placeholder="Student Name" value="<?php echo $expenseRow['student_name']; ?>" required><br>
                <br>
                <label for="ccs_days">CCS DAYS</label><br>
                <input type="text" id="ccs_days" name="ccs_days" class="textfield3" placeholder="CCS Days" value="<?php echo $expenseRow['ccs_days']; ?>" required><br>
                <br>
                <label for="ac_party">Acquaintance Party</label><br>
                <input type="text" id="ac_party" name="ac_party" class="textfield3" placeholder="AC Party"value="<?php echo $expenseRow['ac_party']; ?>" required><br>
                <br>
                <label for="membership">Membership</label><br>
                <input type="text" id="membership" name="membership" class="textfield3" placeholder="Membership" value="<?php echo $expenseRow['membership']; ?>" required><br>
                <br>
                <label for="palaro">Palaro</label><br>
                <input type="text" id="palaro" name="palaro" class="textfield3" placeholder="Palaro" value="<?php echo $expenseRow['palaro']; ?>" required><br>
                <br>
                <label for="community_extension">Community Extension</label><br>
                <input type="text" id="community_extension" name="community_extension" class="textfield3" placeholder="Community Extension" value="<?php echo $expenseRow['community_extension']; ?>" required><br>
                <br>
                <label for="penalty">Penalty</label><br>
                <input type="text" id="penalty" name="penalty" class="textfield3" placeholder="Penalty" value="<?php echo $expenseRow['penalty']; ?>" required><br>
                <br><br>
                <button type="button" class="btn1" onclick="saveEditedExpense()"><a href="number_expense.php"></a>Save Changes</button>
            </form>

            <script>
                function saveEditedExpense() {
                    var expenseId = document.getElementById('expense_id').value;
                    var studentName = document.getElementById('student_name').value;
                    var membership = document.getElementById('membership').value;
                    var ccsDays = document.getElementById('ccs_days').value;
                    var acParty = document.getElementById('ac_party').value;
                    var palaro = document.getElementById('palaro').value;
                    var communityExtension = document.getElementById('community_extension').value;
                    var penalty = document.getElementById('penalty').value;


                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState == 4) {
                            if (xhr.status == 200) {
                                console.log(xhr.responseText);
                                window.location.href = 'number_expense.php?exp_title_id=<?php echo $exp_title_id; ?>';
                            } else {
                                console.error("Error saving edited expense: " + xhr.status);
                            }
                        }
                    };

                    xhr.open("POST", "save_edited_expense.php", true);
                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    var params = "expense_id=" + expenseId + "&student_name=" + studentName + "&ccs_days=" + ccsDays + 
                    "&membership=" + membership + "&ac_party=" + acParty + "&palaro=" + palaro + "&community_extension=" + 
                    communityExtension + "&penalty=" + penalty;
                    xhr.send(params);
                }
            </script>
        </body>

        </html>
        <?php
    } else {
        echo "Expense not found.";
        exit();
    }
} else {
    echo "Expense ID is not provided.";
    exit();
}
?>