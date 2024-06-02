<?php
    include 'condb.php';

    // รับข้อมูลจากฟอร์ม
    $shelter_name = $_POST['shelter_name'];
    $shelter_address = $_POST['shelter_address'];
    $shelter_tel = $_POST['shelter_tel'];
    $shelter_donation = $_POST['shelter_donation'];
    
    // ตรวจสอบว่ามีการอัปโหลดไฟล์รูปหรือไม่
    if(isset($_FILES['shelter_qr']) && $_FILES['shelter_qr']['error'] === UPLOAD_ERR_OK) {
        $shelter_qr = $_FILES['shelter_qr']['name'];
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["shelter_qr"]["name"]);
        move_uploaded_file($_FILES["shelter_qr"]["tmp_name"], $target_file);
    } else {
        // ถ้าไม่มีการอัปโหลดไฟล์ใหม่ใช้ค่าว่าง
        $shelter_qr = '';
    }

    // เพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO shelter (shelter_name, shelter_address, shelter_tel, shelter_donation, shelter_qr) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $shelter_name, $shelter_address, $shelter_tel, $shelter_donation, $shelter_qr);
    
    if(mysqli_stmt_execute($stmt)){
        echo "insert success!";
        echo "<script>window.location='shelter.php';</script>";
    }else{
        echo "ERROR";
        echo "<script>alert('ไม่สามารถเพิ่มสมัครสมาชิกได้: " . mysqli_error($conn) . "');</script>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
?>
