<?php
    include 'condb.php';

    // รับข้อมูลจากฟอร์ม
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'] ?: 0;
    $product_remain = $_POST['product_remain'];
    $product_desc = $_POST['product_desc'];
    $type_id = $_POST['type_id'];

    // ตรวจสอบว่ามีการอัปโหลดไฟล์รูปหรือไม่
    if (isset($_FILES['product_picture']) && $_FILES['product_picture']['error'] === UPLOAD_ERR_OK) {
        $product_picture = $_FILES['product_picture']['name'];
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["product_picture"]["name"]);
        move_uploaded_file($_FILES["product_picture"]["tmp_name"], $target_file);
    } else {
        // ถ้าไม่มีการอัปโหลดไฟล์ใหม่ใช้ค่าว่าง
        $product_picture = '';
    }

    // เพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO products (product_id, product_name, product_price, product_remain, product_picture, product_desc, type_id) VALUES ('{$product_id}', '{$product_name}', '{$product_price}', '{$product_remain}', '{$product_picture}', '{$product_desc}', '{$type_id}')";


    if (!empty($sql) && mysqli_query($conn, $sql)) {
        echo "<script>window.location='products.php';</script>";
    } else {
        echo "<script>alert('ไม่สามารถบันทึกข้อมูลสินค้าได้: " . mysqli_error($conn) . "');</script>";
    }

    mysqli_close($conn);
?>
