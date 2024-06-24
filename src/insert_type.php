<?php
    include 'condb.php';

    // รับข้อมูลจากฟอร์ม
    $type_id = isset($_POST['type_id']) ? substr($_POST['type_id'], 0, 50) : '';  // จำกัดความยาวสูงสุด 50 ตัวอักษร
    $type_name = isset($_POST['type_name']) ? substr($_POST['type_name'], 0, 100) : '';  // จำกัดความยาวสูงสุด 100 ตัวอักษร

    if (!empty($type_id) && !empty($type_name)) {
        // เพิ่มข้อมูลลงในฐานข้อมูล
        $sql = "INSERT INTO product_type (type_id, type_name) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $type_id, $type_name);

        if (mysqli_stmt_execute($stmt)) {
            echo "insert success!";
            echo "<script>window.location='types.php';</script>";
        } else {
            echo "ERROR";
            echo "<script>alert('ไม่สามารถเพิ่มประเภทสินค้าได้: " . mysqli_error($conn) . "');</script>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน');</script>";
    }

    mysqli_close($conn);
?>
