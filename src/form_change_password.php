<?php
    // Start session
    session_start();

    include 'condb.php';

    // Check database connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if session data exists
    if (isset($_SESSION['username'])) {
        // Get username from session
        $username = $_SESSION['username'];

        // SQL query to retrieve user data based on username
        $sql = "SELECT * FROM members WHERE mem_username = '$username'";
        $result = $conn->query($sql);

        // Check if user data exists
        if ($result->num_rows > 0) {
            // Fetch user data
            $row = $result->fetch_assoc();

            // Set session variables for first name and last name
            $_SESSION['firstname'] = $row['mem_firstname'];
            $_SESSION['lastname'] = $row['mem_lastname'];
        }
    } else {
        // If session data doesn't exist, display an error message
        echo "Session not found";
    }

    // Close the database connection
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>เปลี่ยนรหัสผ่าน</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" target="_blank" href="style.css" />
</head>
<body>
<div class="container">
    <div class="view-account">
        <section class="module">
            <div class="module-inner">
                <div class="side-bar">
                    <div class="user-info">
                        <?php
                        if (isset($row['mem_picture'])) {
                            echo "<img class='img-profile img-circle img-responsive center-block' src='images/" . $row['mem_picture'] . "'>";
                        }
                        ?>
                        <ul class="meta list list-unstyled">
                            <li class="name">
                                <?php
                                if (isset($_SESSION['firstname'])) {
                                    echo $_SESSION['firstname'] . " " . $_SESSION['lastname'];
                                }
                                ?><br>
                                <?php
                                    // Check if mem_status is set in $row
                                    if(isset($row['mem_status'])) {
                                        // Check the value of mem_status
                                        if($row['mem_status'] == 0) {
                                            echo "<label class='label' style='background-color: #FFF4E4; color: #454545;'>สถานะ : ไม่ได้เป็นผู้อุปการะ</label>";
                                        } elseif($row['mem_status'] == 1) {
                                            echo "<label class='label' style='background-color: #F88020;'>สถานะ : เป็นผู้อุปการะ</label>";
                                        }
                                    }
                                ?>
                            </li>
                        </ul>
                    </div>
                    <nav class="side-menu">
                        <ul class="nav">
                            <li><a href="index.php"><span class="fa fa-arrow-left"></span> หน้าหลัก </a></li>
                            <li ><a href="edit_profile.php"><span class="fa fa-user"></span> ข้อมูลส่วนตัว </a></li>
                            <li><a href="your_orders.php"><span class="fa fa-clock-o"></span> ประวัติการสั่งซื้อ</a></li>
                            <li class="active"><a href="#"><span class="fa fa-cog"></span> เปลี่ยนรหัสผ่าน</a></li>
                            <li><a href="logout.php"><span class="fa fa-outdent"></span> ออกจากระบบ</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="content-panel">
                    <form class="form-horizontal" action="change_password.php" method="POST">
                        <fieldset class="fieldset">
                            <h3 class="fieldset-title">เปลี่ยนหัสผ่าน</h3>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">รหัสผ่านเดิม</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input type="text" name="old_password" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">รหัสผ่าน</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input type="text" name="new_password" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">ยืนยันรหัสผ่าน</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input type="text" name="cf_password" class="form-control">
                                </div>
                            </div>
                        </fieldset>

                        <hr>
                        <div class="form-group">
                            <div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
                                <input class="btn" style="background-color: #F88020; color: #FFF4E4;" name="submit" type="submit" value="เปลี่ยนรหัสผ่าน">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
</body>
</html>
