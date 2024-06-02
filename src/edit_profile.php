<?php
include 'condb.php';

// รับค่าจากฟอร์ม
$mem_username = $_POST['mem_username'];
$mem_firstname = $_POST['mem_firstname'];
$mem_lastname = $_POST['mem_lastname'];
$mem_email = $_POST['mem_email'];
$mem_tel = $_POST['mem_tel'];
$mem_password = $_POST['mem_password'];

// ตรวจสอบว่ามีการอัปโหลดไฟล์รูปหรือไม่
if(isset($_FILES['mem_picture']) && $_FILES['mem_picture']['error'] === UPLOAD_ERR_OK) {
    $mem_picture = $_FILES['mem_picture']['name'];
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["mem_picture"]["name"]);
    move_uploaded_file($_FILES["mem_picture"]["tmp_name"], $target_file);
} else {
    // ถ้าไม่มีการอัปโหลดไฟล์ใหม่ใช้รูปภาพเดิม
    $mem_picture = $_POST['current_picture'];
}

// สร้างคำสั่ง SQL ด้วย Prepared Statements
$sql = "UPDATE members SET 
        mem_firstname = ?,
        mem_lastname = ?,
        mem_email = ?,
        mem_tel = ?,
        mem_password = ?,
        mem_picture = ?
        WHERE mem_username = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sssssss", $mem_firstname, $mem_lastname, $mem_email, $mem_tel, $mem_password, $mem_picture, $mem_username);

if(mysqli_stmt_execute($stmt)){
    // Redirection must be performed before any output
    header("Location: form_edit_profile.php");
    exit(); // Make sure to exit after header to stop further execution
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
