<?php
    include 'condb.php';

    // รับค่าจากฟอร์ม
    $vac_id = $_POST['vac_id'];
    $vac_name = $_POST['vac_name'];
    $vac_desc = $_POST['vac_desc'];

    // สร้างคำสั่ง SQL ด้วย Prepared Statements
    $sql = "UPDATE vaccine SET 
            vac_name = ?,
            vac_desc = ?
            WHERE vac_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $vac_name, $vac_desc, $vac_id);
    
    if(mysqli_stmt_execute($stmt)){
        echo "Record updated successfully";
        header("Location: vaccines.php");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
?>
