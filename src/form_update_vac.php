<?php
    include 'condb.php';
    if(isset($_GET['vac_id'])) {
        $vac_id = $_GET['vac_id'];
        $sql = " SELECT * FROM vaccine WHERE vac_id = '$vac_id' ";
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
        <form action="update_vac.php" method="POST">
            <label for="vac_id">รหัสวัคซีน:</label><br>
            <input type="text" id="vac_id" name="vac_id" value="<?php echo htmlspecialchars($row['vac_id']); ?>" readonly><br>
            <label for="vac_name">ชื่อ:</label><br>
            <input type="text" id="vac_name" name="vac_name" value="<?php echo htmlspecialchars($row['vac_name']); ?>"><br>
            <label for="vac_desc">รายละเอียด:</label><br>
            <input type="text" id="vac_desc" name="vac_desc" value="<?php echo htmlspecialchars($row['vac_desc']); ?>"><br>
            <br><br>
            <input type="submit" value="แก้ไข" class="btn" style="background-color: #FFE6C7;">
            <a href="form.php"><button type="button" class="btn" style="background-color: #FF6000;"> ยกเลิก </button></a>
        </form> 
    </div>
</body>
</html>
<?php
        } else {
            echo "<script>window.location='form.php';</script>";
        }
    } else {
        echo "<script>window.location='from.php';</script>";
    }
?>
