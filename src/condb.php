<?php
  date_default_timezone_set("Asia/Bangkok");
  $servername = "mariadb-catster";
  $username = "root";
  $password = "admincatster";
  $dbname = "dbcatster";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  // echo "Connected successfully";
?>