<?php
    include 'condb.php';

    // รับข้อมูลจากฟอร์ม
    $mem_username = trim($_POST['mem_username']);
    $mem_firstname = trim($_POST['mem_firstname']);
    $mem_lastname = trim($_POST['mem_lastname']);
    $mem_password = trim($_POST['mem_password']);

    // ตรวจสอบว่าไม่มีฟิลด์ใดว่างเปล่า
    if (empty($mem_username) || empty($mem_firstname) || empty($mem_lastname) || empty($mem_password)) {
        echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน'); window.location='login.php';</script>";
        exit();
    }

    // เข้ารหัสรหัสผ่าน
    $hashed_password = password_hash($mem_password, PASSWORD_BCRYPT);

    // ตรวจสอบว่ามีการอัปโหลดไฟล์รูปหรือไม่
    if (isset($_FILES['mem_picture']) && $_FILES['mem_picture']['error'] === UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_type = mime_content_type($_FILES['mem_picture']['tmp_name']);

        if (!in_array($file_type, $allowed_types)) {
            echo "<script>alert('ประเภทไฟล์ไม่ถูกต้อง'); window.location='login.php';</script>";
            exit();
        }

        $mem_picture = basename($_FILES['mem_picture']['name']);
        $target_dir = "images/";
        $target_file = $target_dir . $mem_picture;

        if (!move_uploaded_file($_FILES['mem_picture']['tmp_name'], $target_file)) {
            echo "<script>alert('ไม่สามารถอัปโหลดรูปภาพได้'); window.location='login.php';</script>";
            exit();
        }
    } else {
        // ถ้าไม่มีการอัปโหลดไฟล์ใหม่ใช้ค่าว่าง
        $mem_picture = '';
    }

    // เพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO members (mem_username, mem_firstname, mem_lastname, mem_password, mem_picture) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssss", $mem_username, $mem_firstname, $mem_lastname, $hashed_password, $mem_picture);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('ลงทะเบียนสำเร็จ!'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('ไม่สามารถเพิ่มสมัครสมาชิกได้: " . mysqli_error($conn) . "'); window.location='login.php';</script>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('ไม่สามารถเตรียมคำสั่ง SQL ได้: " . mysqli_error($conn) . "'); window.location='login.php';</script>";
    }

    mysqli_close($conn);
?>
