<!DOCTYPE html>
<html>
<head>
    <title>Scanned QR Names</title>
</head>
<body>
    <h1>LIST OF ATTENDANCE</h1>
    <ul>
        <?php
       
        $con = mysqli_connect('localhost', 'root', '', 'qrs');

       
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        // Retrieve and display scanned names from the database
        $result = mysqli_query($con, "SELECT DISTINCT name FROM logs");
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<li>' . $row['name'] . '</li>';
        }
        mysqli_close($con);
        ?>
    </ul>
</body>
</html>
