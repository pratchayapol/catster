<?php
    include 'condb.php';
    $sql = "SELECT * FROM shelter";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title> SHELTER </title>
</head>
<body>
    <div class="sidenav">
        <a href="admin.php">หน้าหลัก</a>
        <a href="shelter.php">สถานพักพิง</a>
        <a href="employees.php">พนักงาน</a>
        <a href="members.php">สมาชิก</a>
        <a href="types.php">ประเภท</a>
        <a href="goods.php">สินค้า</a>
        <a href="#vaccines">วัคซีน</a>
        <a href="logout.php"><button type="button" class="btn mt-2" style="background-color: #FFA559;"> ออกจากระบบ </button></a>
    </div>
    <div class="main">
        <br>
        <h4 class="alert alert-secondary" style="text-align: center;">ข้อมูลสถานพักพิง</h4>
        <table class="table table-dark" style="text-align: center;">
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Tel</th>
                <th>Donation</th>
                <th>Qr</th>
                <th>Manage</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["shelter_name"]. "</td>";
                    echo "<td>" . $row["shelter_address"]. "</td>";
                    echo "<td>" . $row["shelter_tel"]. "</td>";
                    echo "<td>" . $row["shelter_donation"]. "</td>";
                    echo "<td><img src='images/" . $row["shelter_qr"] . "' style='width: 50px;' ></td>";
                    echo "<td>";    
                    echo "<a href='form_update_shelter.php?shelter_name=" . $row['shelter_name'] . "' class='btn btn-warning mb-3'> แก้ไข </a><br>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>0 results</td></tr>";
            }
            $conn->close();
            ?>
        </table>
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