<?php
    include 'condb.php';
    if(isset($_GET['mem_username'])) {
        $mem_username = $_GET['mem_username'];
        $sql = " SELECT * FROM members WHERE mem_username = '$mem_username' ";
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
        <form action="update_mem.php" method="POST" enctype="multipart/form-data">
            <label for="mem_username">ชื่อผู้ใช้งาน:</label><br>
            <input type="text" id="mem_username" name="mem_username" value="<?php echo htmlspecialchars($row['mem_username']); ?>" readonly><br>
            <label for="mem_firstname">ชื่อ:</label><br>
            <input type="text" id="mem_firstname" name="mem_firstname" value="<?php echo htmlspecialchars($row['mem_firstname']); ?>"><br>
            <label for="mem_lastname">นามสกุล:</label><br>
            <input type="text" id="mem_lastname" name="mem_lastname" value="<?php echo htmlspecialchars($row['mem_lastname']); ?>"><br>
            <label for="mem_tel">อีเมล:</label><br>
            <input type="text" id="mem_email" name="mem_email" value="<?php echo htmlspecialchars($row['mem_email']); ?>"><br>
            <label for="mem_password">รหัสผ่าน:</label><br>
            <input type="text" id="mem_password" name="mem_password" value="<?php echo htmlspecialchars($row['mem_password']); ?>"><br>
            <label for="mem_picture">รูปภาพ:</label><br>
            <input type="hidden" name="current_picture" value="<?php echo htmlspecialchars($row['mem_picture']); ?>">
            <input type="file" id="mem_picture" name="mem_picture"><br><br>
            <input type="submit" value="แก้ไข" class="btn" style="background-color: #FFE6C7;">
            <a href="members.php"><button type="button" class="btn" style="background-color: #FF6000;"> ยกเลิก </button></a>
        </form> 
    </div>
</body>
</html>
<?php
        } else {
            echo "<script>window.location='members.php';</script>";
        }
    } else {
        echo "<script>window.location='members.php';</script>";
    }
?>
