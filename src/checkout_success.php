<?php
include 'condb.php';
session_start();

$order_id = isset($_SESSION['order_id']) ? $_SESSION['order_id'] : '';
$shipping_info = isset($_SESSION['shipping_info']) ? $_SESSION['shipping_info'] : '';

if (empty($order_id)) {
    // ถ้าไม่มี order_id ให้จัดการข้อผิดพลาดตามที่คุณต้องการ
    echo "Order ID is not available.";
    exit; // หยุดการทำงานต่อ
}

$sql = "SELECT * FROM orders WHERE order_id = '$order_id'";
$result = mysqli_query($conn, $sql);
$order = mysqli_fetch_assoc($result);

$order_details_sql = "SELECT * FROM order_details WHERE order_id = '$order_id'";
$order_details_result = mysqli_query($conn, $order_details_sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="assets/js/bootstrap.min.js"></script>
    <link href="assets/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/fontawesome/css/solid.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5f1b7c0a83.js" crossorigin="anonymous"></script>
    <title>เสร็จสิ้น</title>
    <style>
        .checkmark__circle {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            stroke-width: 2;
            stroke-miterlimit: 10;
            stroke: #7ac142;
            fill: none;
            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        }
        .checkmark {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: block;
            stroke-width: 2;
            stroke: #fff;
            stroke-miterlimit: 10;
            margin: 2% auto;
            box-shadow: inset 0px 0px 0px #7ac142;
            animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
        }
        .checkmark__check {
            transform-origin: 50% 50%;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
        }
        @keyframes stroke {
            100% { stroke-dashoffset: 0; }
        }
        @keyframes scale {
            0%, 100% { transform: none; }
            50% { transform: scale3d(1.1, 1.1, 1); }
        }
        @keyframes fill {
            100% { box-shadow: inset 0px 0px 0px 80px #7ac142; }
        }

        @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');
        body {
            background-color: #ffe8d2;
            font-family: 'Montserrat', sans-serif;
        }
        .card {
            border: none;
        }
        .logo {
            background-color: #eeeeeea8;
        }
        .totals tr td {
            font-size: 13px;
        }
        .footer {
            background-color: #eeeeeea8;
        }
        .footer span {
            font-size: 12px;
        }
        .product-qty span {
            font-size: 12px;
            color: #dedbdb;
        }
    </style>
</head>
<body class="bg-body-tertiary">
    <?php include 'include/menu.php'; ?>
    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <br>
                <div class="card">
                    <div class="invoice p-5">
                        <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"> 
                            <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/> 
                            <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                        </svg>
                        <h5>ยืนยันการชำระเงิน!</h5> 
                        <span class="font-weight-bold d-block mt-4">สวัสดี, <?php echo $_SESSION['firstname']; ?></span> 
                        <span class="text-muted">รายการสั่งซื้อสินค้าจะถูกตรวจสอบและจัดส่งภายใน 7 - 14 วัน</span>
                        <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>
                                        <div class="py-2"> 
                                            <span class="d-block text-muted">วันที่</span> 
                                            <?php echo date('j F Y', strtotime($order['order_date'])); ?>
                                        </div>
                                        </td>
                                        <td>
                                            <div class="py-2"> 
                                                <span class="d-block text-muted">หมายเลขการสั่งซื้อ</span> 
                                                <?php if ($order && isset($order['order_id'])): ?>
                                                    <span><?php echo $order['order_id']; ?></span>
                                                <?php else: ?>
                                                    <span>Error</span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="py-2"> 
                                                <span class="d-block text-muted">ที่อยู่สำหรับการจัดส่ง</span> 
                                                <?php if ($order && isset($order['order_id'])): ?>
                                                    <span><?php echo $order['order_address']; ?></span>
                                                <?php else: ?>
                                                    <span>Error</span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="product border-bottom table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <?php while ($order_details = mysqli_fetch_assoc($order_details_result)): ?>
                                    <tr>
                                        <td width="20%"> 
                                            <?php
                                            // Query to get product picture based on product_id
                                            $product_id = $order_details['product_id'];
                                            $product_sql = "SELECT product_picture FROM products WHERE product_id = '$product_id'";
                                            $product_result = mysqli_query($conn, $product_sql);
                                            $product_row = mysqli_fetch_assoc($product_result);
                                            $product_picture = $product_row['product_picture'];
                                            ?>
                                            <img src="images/<?php echo $product_picture; ?>" style="max-width: 90px;">
                                        </td>
                                        <td width="60%"> 
                                            <span class="font-weight-bold"><?php echo $order_details['product_name']; ?></span>
                                            <div class="product-qty"> 
                                                <span class="d-block">จำนวน: <?php echo $order_details['quantity']; ?></span>
                                            </div>
                                        </td>
                                        <td width="20%">
                                            <div class="text-right"> 
                                                <span class="font-weight-bold">$<?php echo number_format($order_details['sub_total'], 2); ?></span> 
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row d-flex justify-content-end">
                            <div class="col-md-5">
                                <table class="table table-borderless">
                                    <tbody class="totals">
                                        <tr class="border-top border-bottom">
                                            <td>
                                                <div class="text-left"> <span class="font-weight-bold">Total</span> </div>
                                            </td>
                                            <td>
                                                <div class="text-right">
                                                    <?php if ($order && isset($order['order_total'])): ?>
                                                        <span class="font-weight-bold"><strong>$<?php echo number_format($order['order_total'], 2); ?></strong></span>
                                                    <?php else: ?>
                                                        <span class="font-weight-bold"><strong>$0.00</strong></span>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <span class="text-muted">หมายเหตุ: <?php echo $order['order_note'] ?></span>
                        <br><br>
                        <p class="font-weight-bold mb-0">ขอบคุณสำหรับการสนับสนุนเรา!</p> <span>Catster</span>
                    </div>
                    <div class="d-flex justify-content-between footer p-3"> 
                        <span>ต้องการความช่วยเหลือ ? <a href="#">catster@gmail.com</a></span> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
