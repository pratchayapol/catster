<?php
    include 'condb.php';

    // รับข้อมูลจากฟอร์ม
    $type_id = $_POST['type_id'];
    $type_name = $_POST['type_name'];
    $type_desc = $_POST['type_desc'];

    // เพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO goods_type (type_id, type_name, type_desc) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $type_id, $type_name, $type_desc);
    
    if(mysqli_stmt_execute($stmt)){
        echo "insert success!";
        echo "<script>window.location='types.php';</script>";
    }else{
        echo "ERROR";
        echo "<script>alert('ไม่สามารถเพิ่มสมัครสมาชิกได้: " . mysqli_error($conn) . "');</script>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
?>
