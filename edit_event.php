<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'qrs'); // Connect to the "qrs" database

if (isset($_POST['update_event'])) {
    $eventID = $_POST['event_id'];
    $newEvent = mysqli_real_escape_string($db, $_POST['new_event']);
    $newDate = mysqli_real_escape_string($db, $_POST['new_date']);

    if (!empty($newEvent) && !empty($newDate)) {
        $query = "UPDATE event SET event='$newEvent', date='$newDate' WHERE eventID=$eventID";
        
        if (mysqli_query($db, $query)) {
            header('location: event.php'); // Redirect to the event listing page after successful update
        } else {
            echo "Error: " . mysqli_error($db);
        }
    } else {
        echo "Event name and date are required fields.";
    }
}

if (isset($_GET['edit_event'])) {
    $eventID = $_GET['edit_event'];
    $event = mysqli_query($db, "SELECT * FROM event WHERE eventID=$eventID");
    $row = mysqli_fetch_array($event);
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/x-icon" href="resources/icon/CCS.png">
    <title>Edit Event</title>
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

        /*.padding10{
            background-color: #000;
            margin-top: -20px;
            display: inline-block;
        }*/

        a{
            text-decoration: none;
        }

        body{
            margin: auto;
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
            cursor: pointer;
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
        .back-btn{
            margin: 25px 0 0 25px;
        }

        .textfield1{
            width: 600px;
            height: 55px;
            font-family: "Poppins-Reg";
            border: none;
            border-radius: 30px;
            background-color: #E8E6E5;
            padding: 0 25px;
            color: #8A817C;
            border: 2px solid #199F52;
            outline-color: #47DE88;
        }
        /* .textfield1{
            width: 600px;
            height: 55px;
            font-family: "Poppins-Reg";
            border: none;
            border-radius: 30px;
            background-color: #E8E6E5;
            padding-left: 25px;
            border: 2px solid #199F52;
            outline-color: #47DE88;
        */
        .textfield2{
            width: 360px;
            height: 43px;
            font-family: "Poppins-Reg";
            border: none;
            border-radius: 30px;
            background-color: #E8E6E5;
            padding-left: 25px;
        }
        .btn1:hover, .btn2:hover, .btn3:hover, .btn4:hover{
            background-color: #75FAAD;
            transition: 0.3s;
        }

        .add{
            color: #0E7259; 
        }

        .save-event-container{
            text-align: center;
            margin-top: 10%;
        }

        .back-btn{
            width: 35px;
            margin: 25px 0 0 25px;
        }

    </style>
</head>
<body>
    <div class="heading">
          <a href="event.php"><img src="resources/icon/Back.png" class="back-btn"></a>
    </div>
    <div class="save-event-container">
        <form method="POST" action="edit_event.php">
            <input type="hidden"  name="event_id" value="<?php echo $row['eventID']; ?>">
            <input type="text" class="textfield1" name="new_event" value="<?php echo $row['event']; ?>" placeholder="New Event Name" required>
            <br>
            <br>
            <input type="date"class="textfield1"  name="new_date" value="<?php echo $row['date']; ?>" required>
            <br>
            <br>
            <button type="submit" class="btn1" name="update_event">Update</button>
        </form>
    </div>
</body>
</html>
