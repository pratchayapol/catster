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

        // SQL query to retrieve orders based on username
        $order_sql = "SELECT * FROM orders WHERE mem_username = '$username'";
        $order_result = $conn->query($order_sql);


    } else {
        // If session data doesn't exist, display an error message
        echo "Session not found";
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>ประวัติการสั่งซื้อ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">
    <div class="view-account">
        <section class="module">
            <div class="module-inner">
                <div class="side-bar">
                    <div class="user-info">
                        <?php if (isset($row['mem_picture'])): ?>
                            <img class='img-profile img-circle img-responsive center-block' src='images/<?= $row['mem_picture'] ?>'>
                        <?php endif; ?>
                        <ul class="meta list list-unstyled">
                            <li class="name">
                                <?php if (isset($_SESSION['firstname'])): ?>
                                    <?= $_SESSION['firstname'] . " " . $_SESSION['lastname'] ?><br>
                                <?php endif; ?>
                                <?php if(isset($row['mem_status'])): ?>
                                    <?php if($row['mem_status'] == 0): ?>
                                        <label class='label' style='background-color: #FFF4E4; color: #454545;'>สถานะ : ไม่ได้เป็นผู้อุปการะ</label>
                                    <?php elseif($row['mem_status'] == 1): ?>
                                        <label class='label' style='background-color: #F88020;'>สถานะ : เป็นผู้อุปการะ</label>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </div>
                    <nav class="side-menu">
                        <ul class="nav">
                            <li><a href="index.php"><span class="fa fa-arrow-left"></span> หน้าหลัก </a></li>
                            <li><a href="edit_profile.php"><span class="fa fa-user"></span> ข้อมูลส่วนตัว </a></li>
                            <li class="active"><a href="your_orders.php"><span class="fa fa-clock-o"></span> ประวัติการสั่งซื้อ</a></li>
                            <li><a href="form_change_password.php"><span class="fa fa-cog"></span> เปลี่ยนรหัสผ่าน</a></li>
                            <li><a href="logout.php"><span class="fa fa-outdent"></span> ออกจากระบบ</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="content-panel">
                    <h3 class="fieldset-title">ประวัติการสั่งซื้อ</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#Order ID</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Invoice</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                        <?php while ($order_row = $order_result->fetch_assoc()): ?>
                            <?php
                            // SQL query to retrieve order details based on order ID
                            $order_details_sql = "SELECT * FROM order_details WHERE order_id = '{$order_row['order_id']}'";
                            $order_details_result = mysqli_query($conn, $order_details_sql);
                            ?>
                            <tr>
                                <th scope="row"><?= $order_row['order_id'] ?></th>
                                <td><?= $order_row['order_total'] ?></td>
                                <td><?= $order_row['order_status'] ?></td>
                                <td><a class="btn" href="your_invoice.php?order_id=<?php echo $order_row['order_id']; ?>" style="background-color: #F88020; color: #FFFFFF;">Invoice</a></td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>

                    <span class="badge rounded-pill" style="background-color: #F88020;">Success</span>
                    <span class="badge bg-danger-subtle border border-danger-subtle text-danger-emphasis rounded-pill">Danger</span>
                    <span class="badge bg-warning-subtle border border-warning-subtle text-warning-emphasis rounded-pill">Warning</span>
                </div>
            </div>
        </section>
    </div>
</div>

</body>
</html>