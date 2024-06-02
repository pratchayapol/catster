<?php
    include 'condb.php';

    // รับข้อมูลจากฟอร์ม
    $emp_username = $_POST['emp_username'];
    $emp_firstname = $_POST['emp_firstname'];
    $emp_lastname = $_POST['emp_lastname'];
    $emp_address = $_POST['emp_address'];
    $emp_email = $_POST['emp_email'];
    $emp_tel = $_POST['emp_tel'];
    $emp_password = $_POST['emp_password'];
    
    // ตรวจสอบว่ามีการอัปโหลดไฟล์รูปหรือไม่
    if(isset($_FILES['emp_picture']) && $_FILES['emp_picture']['error'] === UPLOAD_ERR_OK) {
        $emp_picture = $_FILES['emp_picture']['name'];
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["emp_picture"]["name"]);
        move_uploaded_file($_FILES["emp_picture"]["tmp_name"], $target_file);
    } else {
        // ถ้าไม่มีการอัปโหลดไฟล์ใหม่ใช้ค่าว่าง
        $emp_picture = '';
    }

    // เพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO employees (emp_username, emp_firstname, emp_lastname, emp_address, emp_email, emp_tel, emp_password, emp_picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssss", $emp_username, $emp_firstname, $emp_lastname, $emp_address, $emp_email, $emp_tel, $emp_password, $emp_picture);
    
    if(mysqli_stmt_execute($stmt)){
        echo "<script>alert('Insert success!');</script>";
        echo "<script>window.location='employees.php';</script>";
    }else{
        echo "ERROR";
        echo "<script>alert('ไม่สามารถเพิ่มสมัครสมาชิกได้: " . mysqli_error($conn) . "');</script>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
?>
