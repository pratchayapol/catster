<?php
    include 'condb.php';
    $vac_id = $_GET['vac_id'];
    $sql = "DELETE FROM vaccine WHERE vac_id='$vac_id'";
    if(mysqli_query($conn, $sql)){
        echo "<script>alert('ลบข้อมูลเรียบร้อย');</script>";
        echo "<script>window.location='vaccines.php';</script>";
    }else{
        echo "<script>alert('ไม่สามารถลบข้อมูลได้');</script>";
        echo "<script>window.location='vaccines.php';</script>";
    }

    mysqli_close($conn);
?>
