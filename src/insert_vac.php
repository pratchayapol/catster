<?php
    include 'condb.php';

    // รับข้อมูลจากฟอร์ม
    $vac_id = $_POST['vac_id'];
    $vac_name = $_POST['vac_name'];
    $vac_desc = $_POST['vac_desc'];

    // เพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO vaccine (vac_id, vac_name, vac_desc) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $vac_id, $vac_name, $vac_desc);
    
    if(mysqli_stmt_execute($stmt)){
        echo "insert success!";
        echo "<script>window.location='form.php';</script>";
    }else{
        echo "ERROR";
        echo "<script>alert('ไม่สามารถเพิ่มวัคซีนได้: " . mysqli_error($conn) . "');</script>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
?>
