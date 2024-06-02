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

    // แก้ไขข้อมูล
        $product_id = $_POST['product_id'];
        $query_product = mysqli_query($conn, "SELECT * FROM products WHERE product_id = '".mysqli_real_escape_string($conn, $product_id)."'");
        $result = mysqli_fetch_assoc($query_product);

        if (empty($product_picture)) {
            $product_picture = $result['product_picture'];
        } else {
            @unlink($target_dir . $result['product_picture']);
        }
        $sql = "UPDATE products SET product_name = '{$product_name}', product_price = '{$product_price}', product_remain = '{$product_remain}', product_picture = '{$product_picture}', product_desc = '{$product_desc}', type_id = '{$type_id}' WHERE product_id = '{$product_id}'";


    if (!empty($sql) && mysqli_query($conn, $sql)) {
        echo "<script>window.location='products.php';</script>";
    } else {
        echo "<script>alert('ไม่สามารถบันทึกข้อมูลสินค้าได้: " . mysqli_error($conn) . "');</script>";
    }

    mysqli_close($conn);
?>
