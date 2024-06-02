<?php
    include 'condb.php';
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM members WHERE mem_username='$username' AND mem_password='$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($result);

    if($row > 0){
        $row = mysqli_fetch_array($result);
        $_SESSION['username'] = $row['mem_username'];
        $_SESSION['password'] = $row['mem_password'];
        $_SESSION['firstname'] = $row['mem_firstname'];
        $_SESSION['lastname'] = $row['mem_lastname'];
        $_SESSION['email'] = $row['mem_email'];
        header("Location: index.php");
        exit();
    } else {
        $sql2 = "SELECT * FROM employees WHERE emp_username='$username' AND emp_password='$password'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_num_rows($result2);
        
        if($row2 > 0){
            $row2 = mysqli_fetch_array($result2);
            $_SESSION['username'] = $row2['emp_username'];
            $_SESSION['password'] = $row2['emp_password'];
            $_SESSION['firstname'] = $row2['emp_firstname'];
            $_SESSION['lastname'] = $row2['emp_lastname'];
            $_SESSION['email'] = $row2['emp_email'];
            header("Location: admin.php");
            exit();
        } else {
            $_SESSION['Error'] = "<p>Your username or password is invalid</p>";
            header("Location: login.php");
            exit();
        }
    }

    // Logging
    $ip = $_SERVER['REMOTE_ADDR'];
    $date = date("Y-m-d H:i:s");
    $message_log = $date . " " . $ip . " request: username = " . $username . "  password = " . $password . "\n";
    $objFopen = @fopen("log/getLogin.log", "a+");
    if ($objFopen) {
        @fwrite($objFopen, $message_log);
        @fclose($objFopen);
    } else {
        error_log("Failed to open log file", 0);
    }
?>
