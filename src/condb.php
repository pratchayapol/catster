<?php
  date_default_timezone_set("Asia/Bangkok");
  $servername = "100.70.4.4";
  $port = "3342";
  $username = "root";
  $password = "admincatster";
  $dbname = "dbcatster";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname, $port);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  // echo "Connected successfully";
?>
