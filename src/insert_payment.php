<?php
    include 'condb.php';
    session_start();

    // ตรวจสอบว่ามีการตั้งค่า order_id หรือไม่
    if (!isset($_POST['order_id']) || empty($_POST['order_id'])) {
        die('Error: order_id is missing or empty.');
    }

    $order_id = $_POST['order_id'];

    // ตรวจสอบว่ามีการอัปโหลดไฟล์รูปหรือไม่
    if (isset($_FILES['slip_payment']) && $_FILES['slip_payment']['error'] === UPLOAD_ERR_OK) {
        $pay_slip = $_FILES['slip_payment']['name'];
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["slip_payment"]["name"]);
        move_uploaded_file($_FILES["slip_payment"]["tmp_name"], $target_file);
    } else {
        // ถ้าไม่มีการอัปโหลดไฟล์ใหม่ใช้ค่าว่าง
        $pay_slip = '';
    }

    function generatePayId($conn, $length = 11) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $payId = '';
        do {
            $payId = '';
            for ($i = 0; $i < $length; $i++) {
                $payId .= $characters[rand(0, $charactersLength - 1)];
            }
            // ตรวจสอบว่า pay_id ที่สร้างขึ้นมีอยู่ในฐานข้อมูลหรือไม่
            $check_query = mysqli_query($conn, "SELECT * FROM payment WHERE pay_id = '{$payId}'");
        } while (mysqli_num_rows($check_query) > 0);
        return $payId;
    }

    $pay_id = "P" . generatePayId($conn, 11);

    // เพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO payment (pay_id, order_id, pay_slip) VALUES ('{$pay_id}', '{$order_id}', '{$pay_slip}')";

    if (mysqli_query($conn, $sql)) {
        // อัปเดตสถานะของ order ในตาราง orders เป็น 'paid'
        $update_order_status_sql = "UPDATE orders SET order_status = 'paid' WHERE order_id = '{$order_id}'";
        if (mysqli_query($conn, $update_order_status_sql)) {
            // ดึงค่า total จาก orders เพื่อนำมาคำนวณกำไร
            $order_query = "SELECT order_total FROM orders WHERE order_id = '{$order_id}'";
            $order_result = mysqli_query($conn, $order_query);
            $order_data = mysqli_fetch_assoc($order_result);
    
            if ($order_data) {
                $total = $order_data['order_total'];
                $profit = $total * 0.15;
    
                // เพิ่มกำไรไปยัง shelter_donation ในตาราง shelter
                $update_shelter_donation_sql = "UPDATE shelter SET shelter_donation = shelter_donation + {$profit}";
                if (mysqli_query($conn, $update_shelter_donation_sql)) {
                    // เก็บค่า order_id ลงใน session
                    $_SESSION['order_id'] = $order_id;
    
                    // บันทึกข้อมูลสำเร็จ นำผู้ใช้ไปยังหน้า checkout_success.php
                    echo "<script>window.location='checkout_success.php';</script>";
                } else {
                    // ไม่สามารถอัปเดต donation ได้
                    echo "<script>alert('ไม่สามารถอัปเดต donation ได้: " . mysqli_error($conn) . "');</script>";
                }
            } else {
                // ไม่พบข้อมูล order
                echo "<script>alert('ไม่พบข้อมูล order');</script>";
            }
        } else {
            // ไม่สามารถอัปเดตสถานะ order ได้
            echo "<script>alert('ไม่สามารถอัปเดตสถานะ order ได้: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        // ไม่สามารถบันทึกข้อมูลการชำระเงินได้
        echo "<script>alert('ไม่สามารถบันทึกข้อมูลการชำระเงินได้: " . mysqli_error($conn) . "');</script>";
    }

    // ปิดการเชื่อมต่อกับฐานข้อมูล
    mysqli_close($conn);
?>
