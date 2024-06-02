<?php
    include 'condb.php';

    // รับค่าจากฟอร์ม
    $type_id = $_POST['type_id'];
    $type_name = $_POST['type_name'];
    $type_desc = $_POST['type_desc'];

    // สร้างคำสั่ง SQL ด้วย Prepared Statements
    $sql = "UPDATE goods_type SET 
            type_name = ?,
            type_desc = ?
            WHERE type_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $type_name, $type_desc, $type_id);
    
    if(mysqli_stmt_execute($stmt)){
        echo "Record updated successfully";
        header("Location: types.php");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
?>
