<?php
    include 'condb.php';

    // รับข้อมูลจากฟอร์ม
    $mem_username = $_POST['mem_username'];
    $mem_firstname = $_POST['mem_firstname'];
    $mem_lastname = $_POST['mem_lastname'];
    $mem_password = $_POST['mem_password'];
    
    // ตรวจสอบว่ามีการอัปโหลดไฟล์รูปหรือไม่
    if(isset($_FILES['mem_picture']) && $_FILES['mem_picture']['error'] === UPLOAD_ERR_OK) {
        $mem_picture = $_FILES['mem_picture']['name'];
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["mem_picture"]["name"]);
        move_uploaded_file($_FILES["mem_picture"]["tmp_name"], $target_file);
    } else {
        // ถ้าไม่มีการอัปโหลดไฟล์ใหม่ใช้ค่าว่าง
        $mem_picture = '';
    }

    // เพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO members (mem_username, mem_firstname, mem_lastname, mem_password, mem_picture) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $mem_username, $mem_firstname, $mem_lastname, $mem_password, $mem_picture);
    
    if(mysqli_stmt_execute($stmt)){
        echo "insert success!";
        echo "<script>window.location='login.php';</script>";
    }else{
        echo "ERROR";
        echo "<script>alert('ไม่สามารถเพิ่มสมัครสมาชิกได้: " . mysqli_error($conn) . "');</script>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
?>
