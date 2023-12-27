<?php
$con = mysqli_connect('localhost', 'root', '', 'qrs');
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Retrieve and display scanned names from the database
$result = mysqli_query($con, "SELECT DISTINCT name FROM logs");
?>
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
    <div style="width:500px;" id="reader"></div>
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
    function showHint(str) {
      if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
      } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("txtHint").innerHTML = this.responseText;
          }
        };
        xmlhttp.open("GET", "gethint.php?q=" + str, true);
        xmlhttp.send();
      }
    }

    function playAudio() { 
      x.play(); 
    } 
  </script>
  <div class="col" style="padding:30px;">
    <h4>SCAN RESULT</h4>
    <div>Student Name</div>
    <form action="">
      <input type="text" name="" class="input" id="result" placeholder="result here" readonly="" />
    </form>
    <p>Status: <span id="txtHint"></span></p>
  </div>
</div>
<script type="text/javascript">
  function onScanSuccess(qrCodeMessage) {
    console.log("QR Code Message:", qrCodeMessage); 
    document.getElementById("result").value = qrCodeMessage; // Set scanned name to the result input field
    showHint(qrCodeMessage);
    playAudio();

    // Update the attendance list without refreshing the page
    updateAttendanceList(qrCodeMessage);
}

function updateAttendanceList(newName) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Append the new name to the attendance list
            var li = document.createElement("li");
            li.appendChild(document.createTextNode(newName));
            document.querySelector("ul").appendChild(li);
        }
    };
    xmlhttp.open("GET", "gethint.php?q=" + newName, true);
    xmlhttp.send();
}


  function onScanError(errorMessage) {
    // Handle scan error
  }

  var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 250 });
  html5QrcodeScanner.render(onScanSuccess, onScanError);
</script>
