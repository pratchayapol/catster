<?php
session_start();
include 'condb.php';

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตรวจสอบว่าฟอร์มส่งข้อมูลมาถูกต้อง
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าจากฟอร์ม
    $mem_username = $_POST['mem_username'];
    $mem_firstname = $_POST['mem_firstname'];
    $mem_lastname = $_POST['mem_lastname'];
    $mem_email = $_POST['mem_email'];
    $current_picture = $_POST['current_picture'];

    // Debugging output
    echo "Username: $mem_username<br>";
    echo "Firstname: $mem_firstname<br>";
    echo "Lastname: $mem_lastname<br>";
    echo "Email: $mem_email<br>";
    echo "Current Picture: $current_picture<br>";

    // ตรวจสอบว่ามีการอัปโหลดไฟล์รูปหรือไม่
    if (isset($_FILES['mem_picture']) && $_FILES['mem_picture']['error'] === UPLOAD_ERR_OK) {
        $mem_picture = $_FILES['mem_picture']['name'];
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["mem_picture"]["name"]);
        if (move_uploaded_file($_FILES["mem_picture"]["tmp_name"], $target_file)) {
            echo "File is uploaded successfully.<br>";
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
            exit();
        }
    } else {
        // ถ้าไม่มีการอัปโหลดไฟล์ใหม่ใช้รูปภาพเดิม
        $mem_picture = $current_picture;
        echo "No new file uploaded. Using current picture.<br>";
    }

    // สร้างคำสั่ง SQL ด้วย Prepared Statements
    $sql = "UPDATE members SET 
            mem_firstname = ?,
            mem_lastname = ?,
            mem_email = ?,
            mem_picture = ?
            WHERE mem_username = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Error preparing statement: " . mysqli_error($conn) . "<br>";
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssss", $mem_firstname, $mem_lastname, $mem_email, $mem_picture, $mem_username);

    if (mysqli_stmt_execute($stmt)) {
        echo "Record updated successfully.<br>";
        header("Location: members.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_stmt_error($stmt) . "<br>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo "Invalid request method.<br>";
}
