<?php
    session_start(); // ตรวจสอบ session

    include 'condb.php';

    // ดึงข้อมูล order_id และ shipping_info จาก URL หรือ session
    $order_id = isset($_GET['order_id']) ? $_GET['order_id'] : (isset($_SESSION['order_id']) ? $_SESSION['order_id'] : '');

    if (empty($order_id)) {
        // ถ้าไม่มี order_id ให้จัดการข้อผิดพลาดตามที่คุณต้องการ
        echo "Order ID is not available.";
        exit; // หยุดการทำงานต่อ
    }
    // ตรวจสอบว่ามีคำสั่งซื้อที่มีสถานะ "unpaid" และถูกสร้างมาเมื่อ 24 ชั่วโมงที่ผ่านมาหรือไม่
    $current_date = date('Y-m-d H:i:s');
    $twenty_four_hours_ago = date('Y-m-d H:i:s', strtotime('-24 hours'));

    // คำสั่ง SQL เพื่ออัพเดต order_status เป็น "refuse" สำหรับคำสั่งซื้อที่มีสถานะ "unpaid" และถูกสร้างมาก่อนหนึ่งวัน
    $update_sql = "UPDATE orders SET order_status = 'refuse' WHERE order_status = 'pending' AND order_date <= '$twenty_four_hours_ago'";
    mysqli_query($conn, $update_sql);

    $sql = "SELECT * FROM orders WHERE order_id = '$order_id'";
    $result = mysqli_query($conn, $sql);
    $order = mysqli_fetch_assoc($result);
?>


<!DOCTYPE html>
<html lang="th">
<head>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/5f1b7c0a83.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>ชำระเงิน</title>
</head>
<body class="bg-body-tertiary">
    <?php include 'include/menu.php'; ?>
    <div class="container mt-5">
        <div class="form-structor">
            <div class="signup">
                <h2 class="form-title" id="signup"><span>or</span>Qr code</h2>
                <form action="insert_payment.php" method="POST" enctype="multipart/form-data">
                    <center><img src="images/noimage.png" style="width: 200px;"></center>
                    <input type="file" name="slip_payment" class="form-control" required>
                    <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order_id); ?>">
                    <button class="submit-btn" type="submit">ยืนยันการชำระเงิน</button>
                </form>
            </div>
            <div class="login slide-up">
                <div class="center">
                    <h2 class="form-title" id="login"><span>or</span>Bank account</h2><br>
                    <form action="confirm_payment.php" method="POST" enctype="multipart/form-data">
                        <center><img src="images/noimage.png" style="width: 200px;"></center>
                        <input type="file" name="slip_payment" class="form-control" required>
                        <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order_id); ?>">
                        <button class="submit-btn" type="submit">ยืนยันการชำระเงิน</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const loginBtn = document.getElementById('login');
        const signupBtn = document.getElementById('signup');

        loginBtn.addEventListener('click', (e) => {
            let parent = e.target.parentNode.parentNode;
            Array.from(e.target.parentNode.parentNode.classList).find((element) => {
                if (element !== "slide-up") {
                    parent.classList.add('slide-up')
                } else {
                    signupBtn.parentNode.classList.add('slide-up')
                    parent.classList.remove('slide-up')
                }
            });
        });

        signupBtn.addEventListener('click', (e) => {
            let parent = e.target.parentNode;
            Array.from(e.target.parentNode.classList).find((element) => {
                if (element !== "slide-up") {
                    parent.classList.add('slide-up')
                } else {
                    loginBtn.parentNode.parentNode.classList.add('slide-up')
                    parent.classList.remove('slide-up')
                }
            });
        });
    </script>
</body>
</html>




<style>
    @import url("https://fonts.googleapis.com/css?family=Fira+Sans");

    html,body {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: "Fira Sans", Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    }

    .form-structor {
    background-color: #222;
    border-radius: 15px;
    height: 550px;
    width: 450px;
    position: relative;
    overflow: hidden;
    
    &::after {
        content: '';
        opacity: .8;
        position: absolute;
        top: 0;right:0;bottom:0;left:0;
        background-repeat: no-repeat;
        background-position: left bottom;
        background-size: 500px;
        background-image: url('images/stray.jfif');
    }
    
    .signup {
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        width: 65%;
        z-index: 5;
        -webkit-transition: all .3s ease;
        
        
        &.slide-up {
        top: 5%;
        -webkit-transform: translate(-50%, 0%);
        -webkit-transition: all .3s ease;
        }
        
        &.slide-up .form-holder,
        &.slide-up .submit-btn {
        opacity: 0;
        visibility: hidden;
        }
        
        &.slide-up .form-title {
        font-size: 1em;
        cursor: pointer;
        }
        
        &.slide-up .form-title span {
        margin-right: 5px;
        opacity: 1;
        visibility: visible;
        -webkit-transition: all .3s ease;
        }
        
        .form-title {
        color: #fff;
        font-size: 1.7em;
        text-align: center;
        
        span {
            color: rgba(0,0,0,0.4);
            opacity: 0;
            visibility: hidden;
            -webkit-transition: all .3s ease;
        }
        }
        
        .form-holder {
        border-radius: 15px;
        background-color: #fff;
        overflow: hidden;
        margin-top: 50px;
        opacity: 1;
        visibility: visible;
        -webkit-transition: all .3s ease;
        
        .input {
            border: 0;
            outline: none;
            box-shadow: none;
            display: block;
            height: 30px;
            line-height: 30px;
            padding: 8px 15px;
            border-bottom: 1px solid #eee;
            width: 100%;
            font-size: 12px;
            
            &:last-child {
            border-bottom: 0;
            }
            &::-webkit-input-placeholder {
            color: rgba(0,0,0,0.4);
            }
        }
        }
        
        .submit-btn {
        background-color: rgba(0,0,0,0.4);
        color: rgba(256,256,256,0.7);
        border:0;
        border-radius: 15px;
        display: block;
        margin: 15px auto; 
        padding: 15px 45px;
        width: 100%;
        font-size: 13px;
        font-weight: bold;
        cursor: pointer;
        opacity: 1;
        visibility: visible;
        -webkit-transition: all .3s ease;
        
        &:hover {
            transition: all .3s ease;
            background-color: rgba(0,0,0,0.8);
        }
        }
    }
    
    .login {
        position: absolute;
        top: 20%;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #fff;
        z-index: 5;
        -webkit-transition: all .3s ease;
        
        &::before {
        content: '';
        position: absolute;
        left: 50%;
        top: -20px;
        -webkit-transform: translate(-50%, 0);
        background-color: #fff;
        width: 200%;
        height: 250px;
        border-radius: 50%;
        z-index: 4;
        -webkit-transition: all .3s ease;
        }
        
        .center {
        position: absolute;
        top: calc(50% - 10%);
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        width: 65%;
        z-index: 5;
        -webkit-transition: all .3s ease;
        
        .form-title {
            color: #000;
            font-size: 1.7em;
            text-align: center;

            span {
            color: rgba(0,0,0,0.4);
            opacity: 0;
            visibility: hidden;
            -webkit-transition: all .3s ease;
            }
        }

        .form-holder {
            border-radius: 15px;
            background-color: #fff;
            border: 1px solid #eee;
            overflow: hidden;
            margin-top: 50px;
            opacity: 1;
            visibility: visible;
            -webkit-transition: all .3s ease;

            .input {
            border: 0;
            outline: none;
            box-shadow: none;
            display: block;
            height: 30px;
            line-height: 30px;
            padding: 8px 15px;
            border-bottom: 1px solid #eee;
            width: 100%;
            font-size: 12px;

            &:last-child {
                border-bottom: 0;
            }
            &::-webkit-input-placeholder {
                color: rgba(0,0,0,0.4);
            }
            }
        }

        .submit-btn {
            background-color: #6B92A4;
            color: rgba(256,256,256,0.7);
            border:0;
            border-radius: 15px;
            display: block;
            margin: 15px auto; 
            padding: 15px 45px;
            width: 100%;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            opacity: 1;
            visibility: visible;
            -webkit-transition: all .3s ease;

            &:hover {
            transition: all .3s ease;
            background-color: rgba(0,0,0,0.8);
            }
        }
        }
        
        &.slide-up {
        top: 90%;
        -webkit-transition: all .3s ease;
        }
        
        &.slide-up .center {
        top: 10%;
        -webkit-transform: translate(-50%, 0%);
        -webkit-transition: all .3s ease;
        }
        
        &.slide-up .form-holder,
        &.slide-up .submit-btn {
        opacity: 0;
        visibility: hidden;
        -webkit-transition: all .3s ease;
        }
        
        &.slide-up .form-title {
        font-size: 1em;
        margin: 0;
        padding: 0;
        cursor: pointer;
        -webkit-transition: all .3s ease;
        }
        
        &.slide-up .form-title span {
        margin-right: 5px;
        opacity: 1;
        visibility: visible;
        -webkit-transition: all .3s ease;
        }
    }
    }
</style>