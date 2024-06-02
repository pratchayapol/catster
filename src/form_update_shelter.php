<?php
    include 'condb.php';
    if(isset($_GET['shelter_name'])) {
        $shelter_name = $_GET['shelter_name'];
        $sql = " SELECT * FROM shelter WHERE shelter_name = '$shelter_name' ";
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
        <form action="update_shelter.php" method="POST" enctype="multipart/form-data">
            <label for="shelter_name">ชื่อ:</label><br>
            <input type="text" id="shelter_name" name="shelter_name" value="<?php echo htmlspecialchars($row['shelter_name']); ?>" readonly><br>
            <label for="shelter_address">ที่อยู่:</label><br>
            <input type="text" id="shelter_address" name="shelter_address" value="<?php echo htmlspecialchars($row['shelter_address']); ?>"><br>
            <label for="shelter_tel">เบอร์โทรศัพท์:</label><br>
            <input type="text" id="shelter_tel" name="shelter_tel" value="<?php echo htmlspecialchars($row['shelter_tel']); ?>"><br>
            <label for="shelter_donation">เงินบริจาค:</label><br>
            <input type="text" id="shelter_donation" name="shelter_donation" value="<?php echo htmlspecialchars($row['shelter_donation']); ?>" readonly><br>
            <label for="shelter_qr">Qr:</label><br>
            <input type="hidden" name="current_picture" value="<?php echo htmlspecialchars($row['shelter_qr']); ?>">
            <input type="file" id="shelter_qr" name="shelter_qr"><br><br>
            <input type="submit" value="แก้ไข" class="btn" style="background-color: #FFE6C7;">
            <a href="shelter.php"><button type="button" class="btn" style="background-color: #FF6000;"> ยกเลิก </button></a>
        </form> 
    </div>
</body>
</html>
<?php
        } else {
            echo "<script>window.location='shelter.php';</script>";
        }
    } else {
        echo "<script>window.location='shelter.php';</script>";
    }
?>
