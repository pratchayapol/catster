<?php
    include 'condb.php';

    // รับค่าจากฟอร์ม
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
        // ถ้าไม่มีการอัปโหลดไฟล์ใหม่ใช้รูปภาพเดิม
        $shelter_qr = $_POST['current_picture'];
    }

    // สร้างคำสั่ง SQL ด้วย Prepared Statements
    $sql = "UPDATE shelter SET 
            shelter_address = ?,
            shelter_tel = ?,
            shelter_donation = ?,
            shelter_qr = ?
            WHERE shelter_name = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $shelter_address, $shelter_tel, $shelter_donation, $shelter_qr, $shelter_name);
    
    if(mysqli_stmt_execute($stmt)){
        echo "Record updated successfully";
        header("Location: shelter.php");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
?>
