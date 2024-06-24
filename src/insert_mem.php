<?php
include 'condb.php';

// Function to sanitize and validate inputs
function sanitize_input($input) {
    $input = trim($input);
    $input = htmlspecialchars($input); // Prevent XSS attacks
    return $input;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $mem_username = sanitize_input($_POST['mem_username']);
    $mem_firstname = sanitize_input($_POST['mem_firstname']);
    $mem_lastname = sanitize_input($_POST['mem_lastname']);
    $mem_password = $_POST['mem_password']; // No need to sanitize password input directly
    $mem_cfpassword = $_POST['mem_cfpassword'];
    $mem_email = ''; // Set default value for mem_email
    $mem_tel = '';
    $mem_status = 0;

    // Validation: Ensure all fields are filled
    if (empty($mem_username) || empty($mem_firstname) || empty($mem_lastname) || empty($mem_password) || empty($mem_cfpassword)) {
        echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน'); window.location='login.php';</script>";
        exit();
    }

    // Validation: Confirm password match
    if ($mem_password !== $mem_cfpassword) {
        echo "<script>alert('รหัสผ่านและยืนยันรหัสผ่านไม่ตรงกัน'); window.location='login.php';</script>";
        exit();
    }

    // Check if file upload is successful (if applicable)
    $mem_picture = 'images/noimage.png'; // Default value if no file uploaded
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
    }

    // Insert data into database
    $sql = "INSERT INTO members (mem_username, mem_firstname, mem_lastname, mem_password, mem_email, mem_picture, mem_tel, mem_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssssi", $mem_username, $mem_firstname, $mem_lastname, $mem_password, $mem_email, $mem_picture, $mem_tel, $mem_status);

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
} else {
    // Redirect if accessed directly without POST method
    header('Location: login.php');
    exit();
}
?>
