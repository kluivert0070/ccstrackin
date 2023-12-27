<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="resources/icon/CCS.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Dashboard</title>
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

        .btn1{
            border-radius: 50px;
            width: 150px;
            height: 47px;
            font-family: "Klasik";
            font-size: 24px;
            color: #0E7259;
            background-color: #17B890;
            border: none;
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
        }
        .add-btn{
            width: 10px;
            margin-top: 30px;
            margin-right: 30px;
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
            color: #0E7259;
        }
        .logout-btn{
            margin-right: 25px;
        }
        .open-btn{
            margin-top: 10%;
        }

        .event-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .add{
            color: #0E7259; 
        }

        .event {
            border: none;
            border-radius: 30px;
            padding: 25px;
            max-width: 500px;
            width: 100%;
            background-color: #fff;
            position: relative;
            margin-bottom: 25px;
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
        }

        .event-name{
            color: #747373;
            font-family: 'Poppins-bold';
            font-size: 24px;
        }
        .event-date{
            color: #747373;
            font-family: 'Poppins-med';
            font-size: 24px;
            margin-top: -10px;
        }

        /* ----- */
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
            color: #0E7259;
            margin-left: 10px;
            margin-top:-5px;
            padding-top:-10px;
        }
        .icon{
            width: 20px;
            margin-left: 15px;
   
        }

        .content{
            height: 30px;
            padding-top: 5px;
        }
        .content:hover{
            background-color: #6FDDC2;
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
            margin-top: -23px;
        }


    </style>
</head>
<body>
    <div class="heading"></div>
    <div class="sidenav">
        <div class="content"><img src="resources/icon/Event2.png" class="icon"><a href="dashboard.php">Event</a></div>
        <div class="content"><img src="resources/icon/expense.png" class="icon"><a href="ccs_expense.php">Expense</a></div>
        <div class="content logout-con"><!--<img src="resources/icon/Logout.png" class="icon icon-logout">--><a href="logout.php">Logout</a></div>
    </div>

    <div class="main">
        <div class="mar25tr">
            <input type="text" class="textfield2" placeholder="Search events..."/><i class="fa-solid fa-magnifying-glass" style="margin-left:-35px; font-size: 15px; opacity: 0.5;"></i>
            <a href="add_event.php" class="innertxt-btn floatr add-btn"><img src="resources/icon/Add.png"></a>
        </div>
        <div class="event-container">
        <?php
     
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
        } else {
            header('Location:login.php'); 
            exit();
        }
        $db = mysqli_connect('localhost', 'root', '', 'qrs'); // Connect to the "event" database
        
        if (!$db) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        if (isset($_GET['delete_event'])) {
            $eventID = $_GET['delete_event']; 
            mysqli_query($db, "DELETE FROM event WHERE eventID=$eventID"); 
            header('location: dashboard.php');
        }
        
        $user_id = $_SESSION['user_id'];
        $eventsQuery = "SELECT * FROM event WHERE user_id = '$user_id'";
        $events = mysqli_query($db, $eventsQuery);

        if (!$events) {
            die("Query failed: " . mysqli_error($db));
        }

        while ($row = mysqli_fetch_array($events)) {
         ?>
                <div class="event">
                    <p class="event-name"><?php echo $row['event']; ?></p>
                    <p class="event-date"><?php echo $row['date']; ?></p>
                    <br>
                    <button class="btn2 open-btn"><a href="attendance.php?eventID=<?php echo $row['eventID']; ?>" class="add">Open</a></button>
                    <span class="options-icon" onclick="eventMenu(this)">&#8286;</span>
                    <div class="options-menu">
                        <a href="delete_event.php?delete_event=<?php echo $row['eventID']; ?>" onclick="return confirm('Are you sure you want to delete this event?')">Delete</a>
                        <a href="edit_event.php?edit_event=<?php echo $row['eventID']; ?>">Edit</a>
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
    </script>
</body>
</html>