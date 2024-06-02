<?php
    include 'condb.php';
    $emp_username = $_GET['emp_username'];
    $sql = "DELETE FROM employees WHERE emp_username='$emp_username' ";
    if(mysqli_query($conn, $sql)){
        echo "<script>alert('ลบข้อมูลเรียบร้อย');</script>";
        echo "<script>window.location='employees.php';</script>";
    }else{
        echo "<script>alert('ไม่สามารถลบข้อมูลได้');</script>";
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
?>
