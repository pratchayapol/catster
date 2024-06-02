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
    }

    // Check if order_id is set in the URL
    if(isset($_GET['order_id'])) {
        // Sanitize the input to prevent SQL injection
        $order_id = mysqli_real_escape_string($conn, $_GET['order_id']);

        // SQL query to retrieve orders based on username and specific order_id
        $order_sql = "SELECT * FROM orders WHERE mem_username = '$username' AND order_id = '$order_id'";
        $order_result = $conn->query($order_sql);

        // SQL query to retrieve payment info based on order_id
        $payment_sql = "SELECT * FROM payment WHERE order_id = '$order_id'";
        $payment_result = $conn->query($payment_sql);
        $payment_row = $payment_result->fetch_assoc();

        // SQL query to retrieve order details based on order_id
        $order_details_sql = "SELECT od.*, p.product_name, p.product_price, p.product_desc 
                              FROM order_details od 
                              JOIN products p ON od.product_id = p.product_id 
                              WHERE od.order_id = '$order_id'";
        $order_details_result = $conn->query($order_details_sql);
    } else {
        // If order_id is not set in the URL, fetch all orders for the user
        $order_sql = "SELECT * FROM orders WHERE mem_username = '$username'";
        $order_result = $conn->query($order_sql);
    }

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
    <script>
        function printInvoice() {
            var printContents = document.getElementById('invoice').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
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
                    <h3 class="fieldset-title">ใบเสร็จการชำระเงิน</h3>
                    <div class="content-wrapper">
                        <div class="pad margin no-print" id="invoice">
                        <section class="invoice">
                        <div class="row">
                            <div class="col-xs-12">
                            <h3 class="page-header"> <img src="images/logo.png" width="75px"> Catster, by Kingdoms of Tigers </h3>
                            </div>
                        </div>
                        <?php if ($order_result && $order_result->num_rows > 0): ?>
                            <?php while ($order_row = $order_result->fetch_assoc()): ?>
                                <div class="row invoice-info">
                                    <div class="col-sm-8 invoice-col">
                                        <address>
                                            <strong><?php echo $row['mem_firstname'] . " " . $row['mem_lastname'] ?></strong><br>
                                            เบอร์โทรศัพท์: <?php echo $order_row['order_tel']; ?><br>
                                            อีเมล: <?php echo $row['mem_email'] ?><br>
                                            ที่อยู่: <?php echo $order_row['order_address']; ?><br>
                                            หมายเหตุ: <?php echo $order_row['order_note']; ?><br>
                                        </address>
                                    </div>
                                    <div class="col-sm-4 invoice-col"> 
                                        <b>Invoice #<?php echo isset($payment_row['pay_id']) ? $payment_row['pay_id'] : ''; ?></b><br>
                                        <br>
                                        <b>Order ID:</b> <?php echo $order_row['order_id']; ?><br>
                                        <b>Order Due:</b> <?php echo date('j F Y', strtotime($order_row['order_date'])); ?><br>
                                        <b>Username:</b> <?php echo $row['mem_username'] ?><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Qty</th>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Description</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if ($order_details_result && $order_details_result->num_rows > 0): ?>
                                                    <?php while ($order_details_row = $order_details_result->fetch_assoc()): ?>
                                                        <tr>
                                                            <td><?php echo $order_details_row['quantity']; ?></td>
                                                            <td><?php echo $order_details_row['product_name']; ?></td>
                                                            <td><?php echo $order_details_row['product_price']; ?></td>
                                                            <td><?php echo $order_details_row['product_desc']; ?></td>
                                                            <td><?php echo $order_details_row['quantity'] * $order_details_row['product_price']; ?></td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <!-- Empty column -->
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th>Total:</th>
                                                    <td><?php echo $order_row['order_total']; ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                        </section>
                        <div class="clearfix">
                        </div>
                </div>
            </div>
            <div class="row no-print">
                                <div class="col-xs-1">
                                    <a href="your_orders.php" class="btn btn-default">
                                        <i class="fa fa-arrow-left"></i> Back
                                    </a>
                                </div>
                                <div class="col-xs-11">
                                    <button onclick="printInvoice()" class="btn btn-default">
                                        <i class="fa fa-print"></i> Print
                                    </button>
                                </div>
                            </div>  
        </section>
    </div>
</div>
</body>
</html>

<!-- <small class="pull-right">Date: 2/10/2014</small> -->