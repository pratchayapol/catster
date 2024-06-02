<?php
    include 'condb.php';
    $type_id = $_GET['type_id'];
    $sql = "DELETE FROM goods_type WHERE type_id='$type_id' ";
    if(mysqli_query($conn, $sql)){
        echo "<script>alert('ลบข้อมูลเรียบร้อย');</script>";
        echo "<script>window.location='types.php';</script>";
    }else{
        echo "<script>alert('ไม่สามารถลบข้อมูลได้');</script>";
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
?>
