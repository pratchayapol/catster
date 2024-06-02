<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("location:login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> แอดมิน </title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="sidenav">
        <a href="admin.php">หน้าหลัก</a>
        <a href="shelter.php">สถานพักพิง</a>
        <a href="employees.php">พนักงาน</a>
        <a href="members.php">สมาชิก</a>
        <a href="types.php">ประเภท</a>
        <a href="products.php">สินค้า</a>
        <a href="#vaccines">วัคซีน</a>
        <a href="logout.php"><button type="button" class="btn mt-2" style="background-color: #FFA559;"> ออกจากระบบ </button></a>
    </div>
    <div class="main">
        <h2> หน้าหลักแอดมิน </h2>
        <p> ยินดีต้อนรับ :
            <?php
                if(isset($_SESSION['firstname'])){
                    echo "<span class='text-secondary'>";
                    echo $_SESSION['firstname'] . " " . $_SESSION['lastname'];
                    echo "</span>";
                }
            ?>
        </p>
        <h1 style="text-align: center;"> คิดไว้ว่าน่าจะเป็น Dashboard </h1>
    </div>
</body>
</html>

<style>
.sidenav {
  height: 100%;
  width: 160px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.main {
  margin-left: 160px; /* Same as the width of the sidenav */
  padding: 0px 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>