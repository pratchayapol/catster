<?php
    include 'condb.php';

    // รับค่าจากฟอร์ม
    $emp_username = $_POST['emp_username'];
    $emp_firstname = $_POST['emp_firstname'];
    $emp_lastname = $_POST['emp_lastname'];
    $emp_email = $_POST['emp_email'];
    $emp_tel = $_POST['emp_tel'];
    $emp_address = $_POST['emp_address'];
    $emp_password = $_POST['emp_password'];

    // ตรวจสอบว่ามีการอัปโหลดไฟล์รูปหรือไม่
    if(isset($_FILES['emp_picture']) && $_FILES['emp_picture']['error'] === UPLOAD_ERR_OK) {
        $emp_picture = $_FILES['emp_picture']['name'];
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["emp_picture"]["name"]);
        move_uploaded_file($_FILES["emp_picture"]["tmp_name"], $target_file);
    } else {
        // ถ้าไม่มีการอัปโหลดไฟล์ใหม่ใช้รูปภาพเดิม
        $emp_picture = $_POST['current_picture'];
    }

        // Check if old password, new password, and confirm password are set
        if (isset($_POST['currentPassword']) && isset($_POST['newPassword']) && isset($_POST['confirmPassword'])) {
            // Get username from session
            $username = $_SESSION['username'];
            $currentPassword = $_POST['currentPassword'];
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];
            if($currentPassword == $_POST['emp_password']){
                if($newPassword == $confirmPassword){
                    $emp_password = $_POST['newPassword'];
                }
            }
        }else{
            $emp_password = $_POST['emp_password'];
        }

    // สร้างคำสั่ง SQL ด้วย Prepared Statements
    $sql = "UPDATE employees SET 
            emp_firstname = ?,
            emp_lastname = ?,
            emp_email = ?,
            emp_tel = ?,
            emp_address = ?,
            emp_password = ?,
            emp_picture = ?
            WHERE emp_username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssss", $emp_firstname, $emp_lastname, $emp_email, $emp_tel, $emp_address, $emp_password, $emp_picture, $emp_username);

    if(mysqli_stmt_execute($stmt)){
        // Redirection must be performed before any output
        header("Location: admin_edit_profile.php");
        exit(); // Make sure to exit after header to stop further execution
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
?>
