<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/x-icon" href="resources/icon/CCS.png">
    <title>Add Event</title>
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
            color: #0E7259;
            background-color: #17B890;
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

        .add{
            color: #0E7259; 
        }

        .save-event-container{
            text-align: center;
            margin-top: 10%;
        }

    </style>
</head>
<body>
    <div class="heading">
     <a href="event.php"><img src="resources/icon/back.png" class="back-btn"></a>
    </div>
    <div class="save-event-container">
        <form method="POST" action="save_event.php"> 
            <?php if (isset($errors)) { ?>
                <p><?php echo $errors; ?></p>
            <?php } ?>
            <input class="textfield1" type="text" name="event" id="event" placeholder="Name" required><br><br>
            
            <input class="textfield1" type="datetime-local" name="date" id="date" required><br><br>
            <br><br>
            <input class="btn1" type="submit" name="submit" value="Save">
        </form>
    </div>
</body>
</html>
