<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'qrs'); // Connect to the database

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) == 1) {
        // Login successful, set session variables and redirect
        $_SESSION['user_id'] = $username; 
        header("location: event.php");
    } else {
        echo "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/x-icon" href="resources/icon/CCS.png">
    <title>Login</title>
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

        .btn1:hover{
            background-color: #47DE88;
            transition: 0.3s;
        }

        .textfield1{
            width: 600px;
            height: 55px;
            font-family: "Poppins-Reg";
            border: none;
            border-radius: 30px;
            /* background-color: #E8E6E5; */
            padding-left: 25px;
            border: 2px solid #199F52;
            outline-color: #47DE88;
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

        body{
            margin: auto;
        }

        .login-container{
            text-align: center;
            margin-top: 8%;
        }
        .logo{
            width: 130px;
            margin-bottom: 10px;
        }
        .login-text{
            color: #199F52;
            margin-bottom: 3%;
        }
        .login-btn{
            margin-top: 2%;
            cursor: pointer;
        }
    </style>

</head>
<body>
    <div class="login-container">
        <img src="resources/icon/CCS.png" class="logo">
        <h2 class="fontsize64 heading1 login-text">Trackin'</h2>
        <form method="post" action="login.php">
            <input type="text" name="username" class="textfield1" required placeholder="Username"><br><br>
            
            <input type="password" name="password" class="textfield1" required placeholder="Password"><br><br>
            
            <input type="submit" class="btn1 login-btn" value="Login">
        </form>
    </div>
</body>
</html>
