<?php
    include 'condb.php';
    $sql = "SELECT * FROM members";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> สมาชิก </title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="sidenav">
        <a href="admin.php">หน้าหลัก</a>
        <a href="shelter.php">สถานพักพิง</a>
        <a href="employees.php">พนักงาน</a>
        <a href="members.php">สมาชิก</a>
        <a href="#types">ประเภท</a>
        <a href="#goods">สินค้า</a>
        <a href="#vaccines">วัคซีน</a>
        <a href="logout.php"><button type="button" class="btn mt-2" style="background-color: #FFA559;"> ออกจากระบบ </button></a>
    </div>
    <div class="main"><br>
        <h4 class="alert alert-secondary" style="text-align: center;">ข้อมูลสมาชิก</h4>
        <table class="table table-dark" style="text-align: center;">
            <tr>
                <th>Username</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Telephone</th>
                <th>Picture</th>
                <th>Manage</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["mem_username"]. "</td>";
                    echo "<td>" . $row["mem_firstname"]. "</td>";
                    echo "<td>" . $row["mem_lastname"]. "</td>";
                    echo "<td>" . $row["mem_tel"]. "</td>";
                    echo "<td><img src='images/" . $row["mem_picture"] . "' style='width: 50px;' ></td>";
                    echo "<td>";    
                    echo "<a href='form_update_mem.php?mem_username=" . $row['mem_username'] . "' class='btn btn-warning mb-3'> แก้ไข </a><br>";
                    echo "<a href='delete_mem.php?mem_username=" . $row['mem_username'] . "' class='btn btn-danger mb-3'> ลบ </a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>0 results</td></tr>";
            }
            $conn->close();
            ?>
        </table>
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
