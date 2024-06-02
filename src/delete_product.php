<?php
    include 'condb.php';

    // ตรวจสอบว่ามีการส่ง ID มาหรือไม่
    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];

        // เตรียมคำสั่ง SQL สำหรับลบสินค้า
        $sql = "DELETE FROM products WHERE product_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $product_id);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('ลบสินค้าสำเร็จ!');</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด: " . mysqli_error($conn) . "');</script>";
        }

        mysqli_stmt_close($stmt);
    }

    // กลับไปหน้าสินค้า
    echo "<script>window.location='products.php';</script>";

    mysqli_close($conn);
?>
