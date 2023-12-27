<?php

session_start();

$con = mysqli_connect('localhost', 'root', '', 'qrs');
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header('Location: login.php');
    exit();
}
$con = mysqli_connect('localhost', 'root', '', 'qrs');
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if (isset($_GET['delete_expense'])) {
    $expense_id = $_GET['delete_expense']; 
    mysqli_query($db, "DELETE FROM expenses WHERE expense_id=$expense_id"); 
    header('location: number_expense.php');
}

$exp_title_id = isset($_GET['exp_title_id']) ? mysqli_real_escape_string($con, $_GET['exp_title_id']) : 0;
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

// Retrieve and display data information from the database
$result = mysqli_query($con, "SELECT * FROM expenses WHERE expense_fk_id = '$exp_title_id'");

if (!$result) {
    die('Query Error: ' . mysqli_error($con));
}
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
            color: #fff;
            background-color: #199F52;
            border: none;
        }
        .btn2{
            border-radius: 30px;
            width: 112px;
            height: 26px;
            font-family: "Klasik";
            font-size: 16px;
            color: #fff;
            background-color: #199F52;
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
            color: #fff;
            background-color: #199F52;
            border: none;
            cursor: pointer;
        }
        .btn4{
            border-radius: 30px;
            width: 200px;
            height: 26px;
            font-family: "Klasik";
            font-size: 16px;
            color: #fff;
            background-color: #199F52;
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
            color: #fff;
            background-color: #199F52;
            border: none;
            margin-top: 10px;
            margin-bottom: 20px;
            cursor: pointer;
        }
        .btn1:hover, .btn2:hover, .btn3:hover, .btn4:hover, .btn5:hover{
            background-color: #75FAAD;
            transition: 0.3s;
        }
        .back-btn{
            width: 35px;
            margin: 25px 0 0 25px;
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
        /* .textfield3{
            width: 70%;
            height: 43px;
            font-family: "Poppins-Reg";
            border: none;
            border-radius: 30px;
            padding-left: 25px;
            border: solid 2px #0E7259;
        } */
        .textfield3{
            width: 70%;
            height: 43px;
            font-family: "Poppins-Reg";
            border: none;
            border-radius: 30px;
            padding-left: 25px;
            border: 2px solid #199F52;
            outline-color: #47DE88;
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
            width: 92%;
            margin-left: 150px;
            margin-top: 20px; 
        }

        table {
            width: 85%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 3px solid black;
            border-color: #747373;
        }
        th{
            font-family: 'Poppins-bold';
            color: #8A817C;
            font-size: 20px;
        }
        td{
            font-family: 'Poppins-reg';
            color: #8A817C;
            font-size: 15px;
        }
        th, td {
            padding: 8px;
            text-align: left;
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
            padding-top: 30px;
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

       
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <a href="ccs_expense.php"><img src="resources/icon/Back.png" class="back-btn"></a>
    <h1 class="attendance-name event-name mar25tr"><?php echo $eventName; ?></h1>
    <button class="btn2 mar25tr" onclick="exportToExcel()">Export</button>
    <button class="btn5" onclick="openModal()">Add</button>
  

    <input type="text" id="search" onkeyup="filterAttendees()" placeholder="Enter name..."
        class="textfield2 textfieldr"> 
        <div  style="margin-left:94%; margin-top: -92px; margin-bottom: 50px; font-size: 15px; opacity: 0.5;">
             <i class="fa-solid fa-magnifying-glass"></i>
        </div>
    <br>

    <!-- Modal -->
    <div id="expenseModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 style="margin-top: 20px; margin-bottom: 30px; color: #199F52;">ADD EXPENSE</h2>
            <form id="expenseForm">
                <select hidden id="exp_title_id" name="exp_title_id">
                    <?php
                    // Fetch all titles for the user
                    $titlesQuery = "SELECT * FROM expense_title WHERE user_id = '$user_id'";
                    $titlesResult = mysqli_query($con, $titlesQuery);

                    if (!$titlesResult) {
                        die('Query Error: ' . mysqli_error($con));
                    }

                    while ($titleRow = mysqli_fetch_assoc($titlesResult)) {
                        $selected = ($titleRow['exp_title_id'] == $exp_title_id) ? 'selected' : '';
                        echo "<option value='{$titleRow['exp_title_id']}' $selected>{$titleRow['expenseName']}</option>";
                    }
                    ?>
                
                <input type="text" id="student_name" name="student_name" class="textfield3" placeholder="Student Name" required><br>
                <br>
                <input type="text" id="ccs_days" name="ccs_days" class="textfield3" placeholder="CCS Days" required><br>
                <br>
                <input type="text" id="ac_party" name="ac_party"  class="textfield3" placeholder="Acquaintance Party" required><br>
                <br>
                <input type="text" id="palaro" name="palaro" class="textfield3" placeholder="Palaro" required><br>
                <br>
                <input type="text" id="community_extension" name="community_extension" class="textfield3" placeholder="Community Extension" required><br>
                <br>
                <input type="text" id="penalty" name="penalty" class="textfield3" placeholder="Penalty" required><br>
                <br>
                <input type="text" id="membership" name="membership" class="textfield3" placeholder="Membership" required><br>
                <br>
                <button type="button" class="btn1" onclick="saveExpense()">Save</button>
            </form>
        </div>
    </div>
    
    <div class="attendance-container">
        <table id="expenseTable">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Membership</th>
                    <th>CCS Days</th>
                    <th>AC Party</th>
                    <th>Palaro</th>
                    <th>Community Extension</th>
                    <th>Penalty</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['student_name']}</td>";
                    echo "<td>{$row['membership']}</td>";
                    echo "<td>{$row['ccs_days']}</td>";
                    echo "<td>{$row['ac_party']}</td>";
                    echo "<td>{$row['palaro']}</td>";
                    echo "<td>{$row['community_extension']}</td>";
                    echo "<td>{$row['penalty']}</td>";
                    echo "<td><a href='edit_expense.php?expense_id={$row['expense_id']}&exp_title_id={$exp_title_id}'>Edit</a> | ";
                    echo "<a href='delete_expense.php?expense_id={$row['expense_id']}&exp_title_id={$exp_title_id}' onclick=\"return confirm('Are you sure you want to delete this event?')\"> Delete</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    
    <script>

     function openModal() {
        var modal = document.getElementById('expenseModal');
        modal.style.display = 'block';
    }

    function closeModal() {
        var modal = document.getElementById('expenseModal');
        modal.style.display = 'none';
    }

        // Function to save the expense
    function saveExpense() {
    // Retrieve values from the form
    var studentName = document.getElementById('student_name').value;
    var membership = document.getElementById('membership').value;
    var ccsDays = document.getElementById('ccs_days').value;
    var acParty = document.getElementById('ac_party').value;
    var palaro = document.getElementById('palaro').value;
    var communityExtension = document.getElementById('community_extension').value;
    var penalty = document.getElementById('penalty').value;


    var table = document.getElementById('expenseTable').getElementsByTagName('tbody')[0];
    var newRow = table.insertRow(table.rows.length);
    var cells = [ studentName, membership, ccsDays, acParty, palaro, communityExtension, penalty];

    for (var i = 0; i < cells.length; i++) {
        var cell = newRow.insertCell(i);
        cell.innerHTML = cells[i];
    }

    // save data to database using AJAX 
    saveToDatabase(studentName, membership, ccsDays, acParty, palaro, communityExtension, penalty);
    closeModal();
}

function filterAttendees() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    table = document.getElementById("expenseTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function saveToDatabase(studentName, membership, ccsDays, acParty, palaro, communityExtension, penalty) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                console.log(xhr.responseText);
                loadExpenses(); // load once ma save
            } else {
                console.error("Error saving expense: " + xhr.status);
            }
        }
    };

    var selectedTitle = document.getElementById('exp_title_id').value; 
    
    xhr.open("POST", "save_title_expense_ccs.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

     var params = "expense_fk_id=" + selectedTitle +
        "&studentName=" + studentName + "&ccsDays=" + ccsDays + "&acParty=" + acParty +
        "&palaro=" + palaro + "&communityExtension=" + communityExtension + "&penalty=" + penalty +
        "&membership=" + membership;

    xhr.send(params);
}

function loadExpenses() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var expenses = JSON.parse(xhr.responseText);
            console.log(expenses); 
            populateTable(expenses);
        }
    };

    var selectedTitle = document.getElementById('exp_title_id').value;

    xhr.open("GET", "get_expenses.php?expense_title_id=" + selectedTitle, true);
    xhr.send();
}
    function populateTable(expenses) {
    var table = document.getElementById('expenseTable').getElementsByTagName('tbody')[0];

    table.innerHTML = "";

    expenses.forEach(function (expense) {
        var newRow = table.insertRow(table.rows.length);
        var cells = [expense.student_name, expense.membership, expense.ccs_days, expense.ac_party, expense.palaro,
            expense.community_extension, expense.penalty];

        for (var i = 0; i < cells.length; i++) {
            var cell = newRow.insertCell(i);
            cell.innerHTML = cells[i];
        }
    });
}

function exportToExcel() {
    var table = document.getElementById("expenseTable");
    var rows = table.getElementsByTagName("tr");
    var data = [];

    var headerRow = rows[0];
    var headerCells = headerRow.getElementsByTagName("th");
    var headerData = [];
    for (var i = 0; i < headerCells.length; i++) {
        headerData.push(headerCells[i].textContent);
    }
    data.push(headerData);

    for (var i = 1; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName("td");
        if (cells.length > 0) {
            var rowData = [];
            for (var j = 0; j < cells.length; j++) {
                rowData.push(cells[j].textContent);
            }
            data.push(rowData);
        }
    }

    // Create a CSV content
    var csvContent = "data:text/csv;charset=utf-8,";
    data.forEach(function (row) {
        csvContent += row.join(",") + "\n";
    });

    // Create a data URI for the CSV content
    var encodedUri = encodeURI(csvContent);

    // Create a hidden anchor element to trigger the download
    var link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", "contribution.csv");
    document.body.appendChild(link);

    // Trigger the download
    link.click();
}
//call ang load expense once ma load
    window.onload = function () {
        loadExpenses();
    };

    </script>
</body>

</html>
