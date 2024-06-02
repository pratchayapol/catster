<?php
    include 'condb.php';
    if(isset($_GET['type_id'])) {
        $type_id = $_GET['type_id'];
        $sql = " SELECT * FROM goods_type WHERE type_id = '$type_id' ";
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
        <form action="update_type.php" method="POST">
            <label for="type_id">รหัสประเภทสินค้า:</label><br>
            <input type="text" id="type_id" name="type_id" value="<?php echo htmlspecialchars($row['type_id']); ?>" readonly><br>
            <label for="type_name">ชื่อ:</label><br>
            <input type="text" id="type_name" name="type_name" value="<?php echo htmlspecialchars($row['type_name']); ?>"><br>
            <br><br>
            <input type="submit" value="แก้ไข" class="btn" style="background-color: #FFE6C7;">
            <a href="types.php"><button type="button" class="btn" style="background-color: #FF6000;"> ยกเลิก </button></a>
        </form> 
    </div>
</body>
</html>
<?php
        } else {
            echo "<script>window.location='types.php';</script>";
        }
    } else {
        echo "<script>window.location='types.php';</script>";
    }
?>
