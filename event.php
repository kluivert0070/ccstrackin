<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Event Listing</title>
    <link rel="icon" type="image/x-icon" href="resources/icon/CCS.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles.css">
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

        body{
            background-color: #E8E6E5;
        }
        
        .mar25tr{
            margin: 25px 0 0 25px;
        }
        .floatr{
            float: right;
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

        .logo-s{
            width: 30px;
        }

        .btn1{
            border-radius: 30px;
            width: 192px;
            height: 47px;
            font-family: "Klasik";
            font-size: 24px;
            color: #199F52;
            background-color: #17B890;
            border: none;
        }
        .btn2{
            border-radius: 30px;
            width: 112px;
            height: 26px;
            font-family: "Klasik";
            font-size: 16px;
            color: #199F52;
            border: solid 0.5px;
        }
        .btn2:hover{
            transition: 0.3s;
            background: #75FAAD;
        }
        .add-btn{
          
            margin-top: -35px;
            margin-left: 95%; 
            font-size: 24px;
        }
        /* .add-btn:hover{
            transform: scale(1.2);
            transition: 0.3s;
        } */
       


        .textfield1{
            width: 600px;
            height: 55px;
            font-family: "Poppins-Reg";
            border: none;
            border-radius: 30px;
            background-color: #E8E6E5;
        }
        .textfield2{
            width: 500px;
            height: 43px;
            font-family: "Poppins-Reg";
            border: none;
            border-radius: 30px;
            background-color: #fff;
            padding-left: 25px;
            margin-top: 25px;
            outline: none;
        }

        .innertxt-btn{
            color: #199F52;
        }
        .logout-btn{
            margin-right: 25px;
        }
        .open-btn{
            margin-top: 10%;
        }

        .event-container {
            flex-direction: column;
            text-align: center;
            width: 95%;
            height: 100vh;
            margin-top: 20px;
            padding-left: 40px;
        
        }

        .add{
            color: #199F52; 
        }

        .event {
            border: none;
            border-radius: 30px;
            padding: 25px;
            width: 260px;
            background-color: #fff;
            position: relative;
            display: inline-block;
            margin-bottom: 20px;
            margin-right: 10px;
        }

        .options-icon {
            cursor: pointer;
            position: absolute;
            top: 5px;
            right: 5px;
            padding: 25px;
            font-size: larger;
        }

        .options-menu {
            display: none;
            position: absolute;
            top: 0%;
            right: 3%;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1;
            font-family: 'Poppins-med';
            padding: 10px;
        }

        .options-menu a {
            display: block;
            padding: 6px 12px;
            font-size: 14px;
            text-decoration: none;
            text-align: left;
        }

        .a-delete{
            color: red;
        }
        .a-edit{
            color: blue; 
        }

        .event-name{
            color: #747373;
            font-family: 'Poppins-bold';
            font-size: 24px;
            text-align: left;
        }
        .event-date{
            color: #747373;
            font-family: 'Poppins-med';
            font-size: 24px;
            margin-top: -10px;
            text-align: left;
        }

        .sidenav {
            height: 100%;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #fff;
            overflow-x: hidden;
            padding-top: 20px;
        }
        .sidenav a{
            font-family: klasik;
            text-decoration: none;
            font-size: 23px;
            color: #199F52;
            margin-left: 10px;
            margin-top:-5px;
            padding-top:-10px;
        }

        .nav-header{
            background-color: #199F52;
            height: 90px;
            margin-top: -20px;
            text-align: center;
            padding-top: 10px;
        }

        .nav-header p{
            font-family: klasik;
            font-size: 25px;
            padding-top: 10px;
            color: #fff;
        }

        .icon{
            width: 20px;
            margin-left: 15px;
   
        }

        .content{
            height: 30px;
            padding-top: 5px;
        }
        .content-highlighted{
            background-color: #75FAAD;
        }
        .content:hover{
            background-color: #75FAAD;
            transition: 0.5s;
            color: #17B890;
        }
        .content a{
            font-family: Poppins-SemiB; 
            font-size: 18px;
        }

        .logout-con{
            bottom: 0px;
            position: fixed;
            margin-bottom: 30px;
            width: 250px;
            text-align: center;
            padding-bottom: -10px;
            
        }
        .logout-con a{
            font-size: 15px;
            margin-left: -10%;
        }
        .icon-logout{
            width: 15px;
        }

        .main {
            margin-left: 250px;
            font-size: 28px;
            padding: 0px 10px;
            background-color: #E8E6E5;
            background-repeat: repeat;
            margin-top: -23px;
            max-height: auto;
         
        }
    </style>

</head>
<body>
    <div class="heading"></div>

    <div class="sidenav">
        <div class='nav-header'>
            <img src="resources/icon/ccs-s.png" class="logo-s">
            <p>CCS TRACKIN'</p>
        </div>
        <div class="content content-highlighted"><img src="resources/icon/Event2.png" class="icon"><a href="event.php">Event</a></div>
        <div class="content"><img src="resources/icon/expense.png" class="icon"><a href="ccs_expense.php">Expense</a></div>
        <div class="content logout-con"><!--<img src="resources/icon/Logout.png" class="icon icon-logout">--><a href="logout.php">Logout</a></div>
    </div>

    <div class="main">
        <div class="mar25tr">
        <input type="text" class="textfield2" placeholder="Search events..."/><i class="fa-solid fa-magnifying-glass" style="margin-left:-35px; font-size: 15px; opacity: 0.5;"></i>
            <div class="add-btn">
                <a href="add_event.php" class="innertxt-btn" ><i class="fa-solid fa-circle-plus fa-beat"></i></a>
            </div>
            <br><br>
        </div>
    <div class="event-container">
    <?php
    //session_start();
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        header('Location: login.php'); 
        exit();
    }
    $db = mysqli_connect('localhost', 'root', '', 'qrs'); // Connect to the "event" database
    
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    if (isset($_GET['delete_event'])) {
        $eventID = $_GET['delete_event']; 
        mysqli_query($db, "DELETE FROM event WHERE eventID=$eventID"); 
        header('location: event.php');
    }
    
    $user_id = $_SESSION['user_id'];
    $eventsQuery = "SELECT * FROM event WHERE user_id = '$user_id'";
    $events = mysqli_query($db, $eventsQuery);

    if (!$events) {
        die("Query failed: " . mysqli_error($db));
    }

    $eventsArray = array(); 
    while ($row = mysqli_fetch_array($events)) {
        $eventsArray[] = $row; 
    }
    $eventsArray = array_reverse($eventsArray);

    foreach ($eventsArray as $row) {
    ?>
            <div class="event">
                <p class="event-name"><?php echo $row['event']; ?></p>
                <p class="event-date"><?php echo $row['date']; ?></p>
                <br>
                <button class="btn2 open-btn"><a href="attendance.php?eventID=<?php echo $row['eventID']; ?>" class="add">Open</a></button>
                <span class="options-icon" onclick="eventMenu(this)">&#8286;</span>
                <div class="options-menu">
                    <a class="a-edit" href="edit_event.php?edit_event=<?php echo $row['eventID']; ?>">Edit</a>
                    <a class="a-delete" href="delete_event.php?delete_event=<?php echo $row['eventID']; ?>" onclick="return confirm('Are you sure you want to delete this event?')">Delete</a>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    </div>
    <script>
        function eventMenu(element) {
            var menu = element.nextElementSibling;
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
            document.addEventListener('click', function (e) {
                if (e.target !== element && e.target !== menu) {
                    menu.style.display = 'none';
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.querySelector('.textfield2');
            const events = document.querySelectorAll('.event');
            const originalDisplays = Array.from(events).map(event => event.style.display);

            searchInput.addEventListener('input', function () {
                const searchTerm = searchInput.value.toLowerCase();

                events.forEach(function (event, index) {
                    const eventName = event.querySelector('.event-name').textContent.toLowerCase();
                    const eventDate = event.querySelector('.event-date').textContent.toLowerCase();

                    if (eventName.includes(searchTerm) || eventDate.includes(searchTerm)) {
                        event.style.display = originalDisplays[index];
                    } else {
                        event.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>