<?php
    include 'condb.php';
    if(isset($_GET['emp_username'])) {
        $emp_username = $_GET['emp_username'];
        $sql = " SELECT * FROM employees WHERE emp_username = '$emp_username' ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        if($row) {
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> แก้ไขข้อมูล </title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
<body>
    <div class="container">
        <h2>แก้ไขข้อมูล</h2>
        <form action="update_emp.php" method="POST" enctype="multipart/form-data">
            <label for="emp_username">ชื่อผู้ใช้งาน:</label><br>
            <input type="text" id="emp_username" name="emp_username" value="<?php echo htmlspecialchars($row['emp_username']); ?>" readonly><br>
            <label for="emp_firstname">ชื่อ:</label><br>
            <input type="text" id="emp_firstname" name="emp_firstname" value="<?php echo htmlspecialchars($row['emp_firstname']); ?>"><br>
            <label for="emp_lastname">นามสกุล:</label><br>
            <input type="text" id="emp_lastname" name="emp_lastname" value="<?php echo htmlspecialchars($row['emp_lastname']); ?>"><br>
            <label for="emp_address">ที่อยู่:</label><br>
            <input type="text" id="emp_address" name="emp_address" value="<?php echo htmlspecialchars($row['emp_address']); ?>"><br>
            <label for="emp_email">อีเมล:</label><br>
            <input type="text" id="emp_email" name="emp_email" value="<?php echo htmlspecialchars($row['emp_email']); ?>"><br>
            <label for="emp_tel">เบอร์โทรศัพท์:</label><br>
            <input type="text" id="emp_tel" name="emp_tel" value="<?php echo htmlspecialchars($row['emp_tel']); ?>"><br>
            <label for="emp_password">รหัสผ่าน:</label><br>
            <input type="text" id="emp_password" name="emp_password" value="<?php echo htmlspecialchars($row['emp_password']); ?>"><br>
            <label for="emp_picture">รูปภาพ:</label><br>
            <input type="hidden" name="current_picture" value="<?php echo htmlspecialchars($row['emp_picture']); ?>">
            <input type="file" id="emp_picture" name="emp_picture"><br><br>
            <input type="submit" value="แก้ไข" class="btn" style="background-color: #FFE6C7;">
            <a href="employees.php"><button type="button" class="btn" style="background-color: #FF6000;"> ยกเลิก </button></a>
        </form> 
    </div>
</body>
</html>
<?php
        } else {
            echo "<script>window.location='employees.php';</script>";
        }
    } else {
        echo "<script>window.location='employees.php';</script>";
    }
?>
