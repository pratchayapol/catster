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
    <title>ข้อมูลส่วนตัว</title>
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

<nav>

</nav>

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
                            <li class="active"><a href="edit_profile.php"><span class="fa fa-user"></span> ข้อมูลส่วนตัว </a></li>
                            <li><a href="your_orders.php"><span class="fa fa-clock-o"></span> ประวัติการสั่งซื้อ</a></li>
                            <li><a href="form_change_password.php"><span class="fa fa-cog"></span> เปลี่ยนรหัสผ่าน</a></li>
                            <li><a href="logout.php"><span class="fa fa-outdent"></span> ออกจากระบบ</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="content-panel">
                    <form class="form-horizontal" action="edit_profile.php" method="POST" enctype="multipart/form-data">
                        <fieldset class="fieldset">
                            <h3 class="fieldset-title">ข้อมูลส่วนตัว</h3>
                            <div class="form-group avatar">
                                <figure class="figure col-md-2 col-sm-3 col-xs-12"></figure>
                                <div class="form-inline col-md-10 col-sm-9 col-xs-12">
                                    <input type="hidden" name="current_picture" value="<?php echo isset($row['mem_picture']) ? htmlspecialchars($row['mem_picture']) : ''; ?>">
                                    <input type="file" id="mem_picture" name="mem_picture" class="file-uploader pull-left">
                                    <button type="submit" name="submit" class="btn btn-sm btn-default-alt pull-left">แก้ไขรูปภาพ</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">ชื่อผู้ใช้งาน</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input type="text" name="mem_username" class="form-control" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">ชื่อ</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input type="text" name="mem_firstname" class="form-control" value="<?php echo isset($_SESSION['firstname']) ? $_SESSION['firstname'] : ''; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">นามสกุล</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input type="text" name="mem_lastname" class="form-control" value="<?php echo isset($_SESSION['lastname']) ? $_SESSION['lastname'] : ''; ?>">
                                </div>
                            </div>
                            <input type="hidden" name="mem_password" value="<?php echo isset($row['mem_password']) ? $row['mem_password'] : ''; ?>">
                        </fieldset>
                        <fieldset class="fieldset">
                            <h3 class="fieldset-title">ข้อมูลการติดต่อ</h3>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">อีเมล</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input type="email" name="mem_email" class="form-control" value="<?php echo isset($row['mem_email']) ? $row['mem_email'] : ''; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">เบอร์โทรศัพท์</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input type="text" name="mem_tel" class="form-control" value="<?php echo isset($row['mem_tel']) ? $row['mem_tel'] : ''; ?>">
                                </div>
                            </div>
                        </fieldset>

                        <hr>
                        <div class="form-group">
                            <div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
                                <input class="btn" style="background-color: #F88020; color: #FFF4E4;" name="submit" type="submit" value="แก้ไขข้อมูล">
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
