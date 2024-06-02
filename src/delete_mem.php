<?php
    include 'condb.php';
    $mem_username = $_GET['mem_username'];
    $sql = "DELETE FROM members WHERE mem_username='$mem_username' ";
    if(mysqli_query($conn, $sql)){
        echo "<script>alert('ลบข้อมูลเรียบร้อย');</script>";
        echo "<script>window.location='members.php';</script>";
    }else{
        echo "<script>alert('ไม่สามารถลบข้อมูลได้');</script>";
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
?>
