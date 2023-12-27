<?php
    $con = mysqli_connect('localhost', 'root', '', 'qrs');
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $eventID = isset($_GET['eventID']) ? mysqli_real_escape_string($con, $_GET['eventID']) : 0;
    if ($eventID == 0) {
        // Handle the case when eventID is not provided
        echo "EventID is not provided.";
        exit();
    }

    // Fetch event details based sa eventID
    $eventQuery = "SELECT * FROM event WHERE eventID = '$eventID'";
    $eventResult = mysqli_query($con, $eventQuery);

    if ($eventRow = mysqli_fetch_assoc($eventResult)) {
        $eventName = $eventRow['event'];
        $eventDate = $eventRow['date'];
    } else {
        echo "Event not found.";
        exit();
    }
    // Retrieve and display scanned names from the database of the world
    $result = mysqli_query($con, "SELECT name, status, sign_in_time, sign_out_time FROM logs WHERE event_id = '$eventID'");

    if (!$result) {
        die('Query Error: ' . mysqli_error($con));
    }
    ?>
    <!DOCTYPE html>
    <html>
    <head>
    <link rel="icon" type="image/x-icon" href="resources/icon/CCS.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            margin-top: -10px;
            margin-bottom: 30px;
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
            color: #fff;
            background-color: #199F52;
            border: none;
            cursor: pointer;
        }
        .btn1:hover, .btn2:hover, .btn3:hover, .btn4:hover{
            background-color: #75FAAD;
            transition: 0.3s;
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
        .textfieldr{
            float: right;
            margin-top: -50px;
            margin-right: 50px;
        }

        .innertxt-btn{
            color: #fff;
        }
        .logout-btn{
            margin-right: 25px;
        }
        .open-btn{
            margin-top: 10%;
        }
        .back-btn{
            width: 35px;
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
            color: #fff; 
        }

        .attendance-container{
            float: right;
            width: 60%;
            margin-top: 50px;
            margin-right: 50px;
        }

        table {
            width: 100%;
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
    </style>
    <title><?php echo $eventName; ?></title>
    </head>
    <body>
        <a href="event.php"><img src="resources/icon/Back.png" class="back-btn"></a>
        <h1 class="attendance-name event-name mar25tr"><?php echo $eventName; ?></h1>
        <p class="event-date mar25tr"><?php echo $eventDate; ?></p>
        <input type="text" id="search" onkeyup="filterAttendees()" placeholder="Enter name..." class="textfield2 textfieldr">
        <div  style="margin-left:94%; margin-top: -35px; margin-bottom: 10px; font-size: 15px; opacity: 0.5;">
             <i class="fa-solid fa-magnifying-glass"></i>
         </div>
        <br>
        <button class="btn2 mar25tr" onclick="exportToExcel()">Export</button>

        
        <div class="attendance-container">
        <table id="attendanceList">
            <thead>
                <tr>
                    <th>STUDENT</th>
                    <th>SIGN IN</th>
                    <th>SIGN OUT</th>   
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr><td>' . $row['name'] . '</td>';
                        
                        if ($row['status'] == 'signed out') {
                            echo '<td>' . date("g:i A", strtotime($row['sign_in_time'])) . '</td>';
                            echo '<td>' . date("g:i A", strtotime($row['sign_out_time'])) . '</td>';
                        } else {
                            echo '<td>' . date("g:i A", strtotime($row['sign_in_time'])) . '</td>';
                            echo '<td><button class="btn3" onclick="signOut(\'' . $row['name'] . '\', ' . $eventID . ')">Sign Out</button></td>';
                        }

                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
    </body>
    </html>

    <script src="ht.js"></script>
    <style>
    .result{
        background-color: green;
        color:#fff;
        padding:20px;
    }
    .row{
        display:flex;
    }
    </style>
    <div class="row">
    <div class="col">
        <div style="width:450px;height:400px;margin-left:50px;border-radius:30px;" id="reader"></div>
    </div>
    <audio id="myAudio1">
        <source src="success.mp3" type="audio/ogg">
    </audio>
    <audio id="myAudio2">
        <source src="failes.mp3" type="audio/ogg">
    </audio>
    <script>
        var x = document.getElementById("myAudio1");
        var x2 = document.getElementById("myAudio2");
        var urlParams = new URLSearchParams(window.location.search);
        var eventID = urlParams.get("eventID");

        function showHint(str, eventId) {
            if (str.length == 0 || !eventId) { 
                document.getElementById("txtHint").innerHTML = "No student name or event ID provided.";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "gethint.php?q=" + str + "&event_id=" + eventId, true);
                xmlhttp.send();
            }
        }
        function playAudio() {
            x.play();
        }
    </script>
    <input type="hidden" id="eventID" value="<?php echo $_GET['eventID']; ?>" />
    </div>
    <div class="col" style="padding:30px;margin-left:50px">
        <p class="stdname">STUDENT NAME</p>
        <form action="">
        <input type="text" name="" class="input stdname-act" id="result" placeholder="" readonly="" />
        </form>
        <!--<p>Status: <span id="txtHint"></span></p>-->
    </div>
    <script type="text/javascript">


    function onScanSuccess(qrCodeMessage) {
        console.log("QR Code Message:", qrCodeMessage);
        document.getElementById("result").value = qrCodeMessage;
        var eventID = document.getElementById("eventID").value;

        if (!isNameInAttendanceList(qrCodeMessage)) {
            showHint(qrCodeMessage, eventID);
            playAudio();
            var table = document.getElementById("attendanceList");
            var newRow = table.insertRow(1);
            var cell = newRow.insertCell(0);
            cell.innerHTML = qrCodeMessage;
            cell = newRow.insertCell(1);
            cell.innerHTML = getCurrentTime();
            cell = newRow.insertCell(2);
            cell.innerHTML = '<button onclick="signOut(\'' + qrCodeMessage + '\', ' + eventID + ')">Sign Out</button>';
        }
    }

    function getCurrentTime() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        var currentTime = hours + ':' + minutes + ' ' + ampm;
        return currentTime;
    }
    function isNameInAttendanceList(name) {
        var table = document.getElementById("attendanceList");
        var rows = table.getElementsByTagName("tr");

        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName("td");
            if (cells.length > 0 && cells[0].textContent === name) {  
                return true;
            }
        }
        return false;
    }

    function updateAttendanceList(newName) {
            var table = document.getElementById("attendanceList");
            var newRow = table.insertRow(1); 
            var cell = newRow.insertCell(0);  
            cell.innerHTML = newName;        
        }

    function onScanError(errorMessage) {

    }

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 10, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess, onScanError);


    function filterAttendees() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        table = document.getElementById("attendanceList");
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

        function signOut(name, eventID) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.status === 'signed out') {
                var signOutTime = getCurrentTime();
                updateAttendanceInTable(name, signOutTime);
            } else {
                console.error(response.error);
            }
        }
    };

    xhr.open("GET", "signout.php?name=" + name + "&event_id=" + eventID, true);
    xhr.send();
}

function updateAttendanceInTable(name, signOutTime) {
    var table = document.getElementById("attendanceList");
    var rows = table.getElementsByTagName("tr");
    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName("td");
        if (cells.length > 0 && cells[0].textContent === name) {
            cells[2].innerHTML = signOutTime;
            break;
        }
    }
}

function exportToExcel() {
    var table = document.getElementById("attendanceList");
    var rows = table.getElementsByTagName("tr");
    var data = [];

    // Extract column headers (titles)
    var headerRow = rows[0];
    var headerCells = headerRow.getElementsByTagName("th");
    var headerData = [];
    for (var i = 0; i < headerCells.length; i++) {
        headerData.push(headerCells[i].textContent);
    }
    data.push(headerData);

    // Loop through the table rows and extract the data
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
    link.setAttribute("download", "attendance.csv");
    document.body.appendChild(link);

    // Trigger the download
    link.click();
}

function expEnse(student_name, exp_title_id) {
    var penaltyInput = document.getElementById("penalty_" + name);
    var contributionInput = document.getElementById("contribution_" + name);
    var penaltyValue = penaltyInput.value;
    var contributionValue = contributionInput.value;

    // Save values to localStorage
    localStorage.setItem(name + "_penalty", penaltyValue);
    localStorage.setItem(name + "_contribution", contributionValue);

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                console.log('Expense saved successfully for ' + name);
            } else {
                console.error(response.error);
            }
        }
    };
    xhr.open("POST", "saveexpense.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("name=" + name + "&event_id=" + eventID + "&penalty=" + penaltyValue + "&contribution=" + contributionValue);
    updateExpenses();

}

    function updateExpenses() {
        var table = document.getElementById("attendanceList");
        var rows = table.getElementsByTagName("tr");
        var totalExpense = 0;

        for (var i = 1; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName("td");
            var studentName = cells[0].textContent;
            var penaltyInput = document.getElementById("penalty_" + studentName);
            var contributionInput = document.getElementById("contribution_" + studentName);

            var penaltyValue = parseFloat(penaltyInput.value) || 0;
            var contributionValue = parseFloat(contributionInput.value) || 0;
            var studentExpense = penaltyValue + contributionValue;
            totalExpense += studentExpense;

            console.log("Student: " + studentName + ", Expense: " + studentExpense);
        }
        
        var totalExpenseDisplay = document.getElementById("totalExpense");
        totalExpenseDisplay.textContent = totalExpense.toFixed(2); 
    }

        function loadStoredValues() {
            var table = document.getElementById("attendanceList");
            var rows = table.getElementsByTagName("tr");

            for (var i = 1; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName("td");
                var studentName = cells[0].textContent;

                var penaltyInput = document.getElementById("penalty_" + studentName);
                var contributionInput = document.getElementById("contribution_" + studentName);

                var storedPenalty = localStorage.getItem(studentName + "_penalty");
                var storedContribution = localStorage.getItem(studentName + "_contribution");

                if (storedPenalty !== null) {
                    penaltyInput.value = storedPenalty;
                }

                if (storedContribution !== null) {
                    contributionInput.value = storedContribution;
                }
            }
        }
        document.addEventListener("DOMContentLoaded", function () {
        loadStoredValues();
        updateExpenses(); 
    });
        </script>
        </script>