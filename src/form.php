<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title> ฟอร์ม </title>
      <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>

    <?php
        include 'condb.php';
        $sql = "SELECT * FROM employees";
        $result = mysqli_query($conn, $sql);
    ?>
    <section id="emp">
        <div class="row">
            <div class="col-3">
                <div class="container">
                    <hr>
                    <h2>+ พนักงาน</h2>
                    <hr>
                    <form action="insert_emp.php" method="post" enctype="multipart/form-data">
                        <label for="emp_username">ชื่อผู้ใช้งาน:</label><br>
                        <input type="text" id="emp_username" name="emp_username"><br>
                        <label for="emp_firstname">ชื่อ:</label><br>
                        <input type="text" id="emp_firstname" name="emp_firstname"><br>
                        <label for="emp_lastname">นามสกุล:</label><br>
                        <input type="text" id="emp_lastname" name="emp_lastname"><br>
                        <label for="emp_address">ที่อยู่:</label><br>
                        <input type="text" id="emp_address" name="emp_address"><br>
                        <label for="emp_email">อีเมล:</label><br>
                        <input type="text" id="emp_email" name="emp_email"><br>
                        <label for="emp_tel">เบอร์โทรศัพท์:</label><br>
                        <input type="text" id="emp_tel" name="emp_tel"><br>
                        <label for="emp_password">รหัสผ่าน:</label><br>
                        <input type="text" id="emp_password" name="emp_password"><br>
                        <label for="emp_picture">รูปภาพ:</label><br>
                        <input type="file" id="emp_picture" name="emp_picture"><br><br>
                        <input type="submit" value="ส่ง">
                    </form> 
                </div>
            </div>
            <div class="col-9">
                <div class="container" style="text-align: center;">
                    <hr>
                    <h2>พนักงาน</h2>
                    <hr>
                    <table class="table" style="text-align: center;">
                        <tr>
                            <th> </th>
                            <th>Username</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Telephone</th>
                            <th>Manage</th>
                        </tr>
                        <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td><img src='images/" . $row["emp_picture"] . "' style='width: 50px;' ></td>";
                                echo "<td>" . $row["emp_username"]. "</td>";
                                echo "<td>" . $row["emp_firstname"]. "</td>";
                                echo "<td>" . $row["emp_lastname"]. "</td>";
                                echo "<td>" . $row["emp_tel"]. "</td>";
                                echo "<td>";    
                                echo "<a href='form_update_emp.php?emp_username=" . $row['emp_username'] . "' class='btn btn-warning mb-3'> แก้ไข </a><br>";
                                echo "<a href='delete_emp.php?emp_username=" . $row['emp_username'] . "' class='btn btn-danger mb-3'> ลบ </a>";
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
            </div>
        </div>
    </section>
    <hr>

    <?php
        include 'condb.php';
        $sql = "SELECT * FROM product_type";
        $result = mysqli_query($conn, $sql);
    ?>
    <section id="type">
        <div class="row">
            <div class="col-3">
                <div class="container">
                    <hr>
                    <h2>+ ประเภทสินค้า</h2>
                    <hr>
                    <form action="insert_type.php" method="post">
                        <label for="type_id">รหัสประเภทสินค้า:</label><br>
                        <input type="text" id="type_id" name="type_id"><br>
                        <label for="type_name">ชื่อ:</label><br>
                        <input type="text" id="type_name" name="type_name"><br><br>
                        <input type="submit" value="บันทึก">
                    </form> 
                </div>
            </div>
            <div class="col-9">
                <div class="container" style="text-align: center;">
                    <hr>
                    <h2>ประเภทสินค้า</h2>
                    <hr>
                    <table class="table" style="text-align: center;">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Manage</th>
                        </tr>
                        <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["type_id"]. "</td>";
                                echo "<td>" . $row["type_name"]. "</td>";
                                echo "<td>";    
                                echo "<a href='form_update_type.php?type_id=" . $row['type_id'] . "' class='btn btn-warning mb-3'> แก้ไข </a><br>";
                                echo "<a href='delete_type.php?type_id=" . $row['type_id'] . "' class='btn btn-danger mb-3'> ลบ </a>";
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
            </div>
        </div>
    </section>
    <hr>

    <?php
        include 'condb.php';
        $sql = "SELECT products.*, product_type.type_name FROM products
                INNER JOIN product_type ON products.type_id = product_type.type_id";
        $resultp = mysqli_query($conn, $sql);
    ?>
    <section id="product">
        <div class="row">
            <div class="col-3">
                <div class="container">
                    <hr>
                    <h2>+ สินค้า</h2>
                    <button type="button" onclick="addProduct()">เพิ่มรายการสินค้า</button><br>
                    <hr>
                    <form action="insert_product.php" method="post" enctype="multipart/form-data">
                        <label for="product_id">รหัสสินค้า:</label><br>
                        <input type="text" id="product_id" name="product_id[]"><br>
                        <label for="product_name">ชื่อ:</label><br>
                        <input type="text" id="product_name" name="product_name[]"><br>
                        <label for="product_price">ราคา:</label><br>
                        <input type="text" id="product_price" name="product_price[]"><br>
                        <label for="product_amount">คงเหลือ:</label><br>
                        <input type="number" id="product_amount" name="product_amount[]"><br>
                        <label for="type_id">เลือกประเภทสินค้า:</label><br>
                        <select id="type_id" name="type_id[]">
                            <?php
                                // เชื่อมต่อฐานข้อมูล
                                include 'condb.php';

                                // ตรวจสอบการเชื่อมต่อ
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                // คำสั่ง SQL เพื่อดึงข้อมูลประเภทสินค้าจากตาราง product_type
                                $sql = "SELECT type_id, type_name FROM product_type";
                                $result = $conn->query($sql);

                                // วนลูปเพื่อแสดงตัวเลือก
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row["type_id"] . "'>" . $row["type_name"] . "</option>";
                                    }
                                } else {
                                    echo "0 results";
                                }

                                // ปิดการเชื่อมต่อ
                                $conn->close();
                            ?>
                        </select><br>
                        <label for="product_picture">รูปภาพ:</label><br>
                        <input type="file" id="product_picture" name="product_picture[]"><br><br>

                        <div id="add_fields"></div>

                        <input type="submit" value="บันทึก">
                    </form>
                    <script>
                        var optionCount = 0;

                        function addProduct() {
                            optionCount++;
                            var optionDiv = document.createElement("div");
                            optionDiv.innerHTML = `
                                <label for="product_id_${optionCount}">รหัสสินค้า:</label><br>
                                <input type="text" id="product_id_${optionCount}" name="product_id[]"><br>
                                <label for="product_name_${optionCount}">ชื่อ:</label><br>
                                <input type="text" id="product_name_${optionCount}" name="product_name[]"><br>
                                <label for="product_price_${optionCount}">ราคา:</label><br>
                                <input type="text" id="product_price_${optionCount}" name="product_price[]"><br>
                                <label for="product_amount_${optionCount}">คงเหลือ:</label><br>
                                <input type="number" id="product_amount_${optionCount}" name="product_amount[]"><br>
                                <label for="type_id_${optionCount}">เลือกประเภทสินค้า:</label><br>
                                <select id="type_id_${optionCount}" name="type_id[]">
                                    <?php
                                        include 'condb.php';

                                        if ($conn->connect_error) {
                                            die("Connection failed: " . $conn->connect_error);
                                        }

                                        $sql = "SELECT type_id, type_name FROM product_type";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row["type_id"] . "'>" . $row["type_name"] . "</option>";
                                            }
                                        } else {
                                            echo "0 results";
                                        }

                                        $conn->close();
                                    ?>
                                </select><br>
                                <label for="product_picture_${optionCount}">รูปภาพ:</label><br>
                                <input type="file" id="product_picture_${optionCount}" name="product_picture[]"><br><br>
                            `;
                            document.getElementById("add_fields").appendChild(optionDiv);
                        }
                    </script>
                </div>
            </div>
            <div class="col-9">
                <div class="container" style="text-align: center;">
                    <hr>
                    <h2>สินค้า</h2>
                    <hr>
                    <table class="table" style="text-align: center;">
                        <tr>
                            <th> </th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Manage</th>
                        </tr>
                        <?php
                            if ($resultp->num_rows > 0) {
                                while($row = $resultp->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td><img src='images/" . $row["product_picture"] . "' style='width: 50px;' ></td>";
                                    echo "<td>" . $row["product_id"]. "</td>";
                                    echo "<td>" . $row["product_name"]. "</td>";
                                    echo "<td>" . $row["type_name"]. "</td>";
                                    echo "<td>";    
                                    echo "<a href='form_update_product.php?product_id=" . $row['product_id'] . "' class='btn btn-warning mb-3'> แก้ไข </a><br>";
                                    echo "<a href='delete_product.php?product_id=" . $row['product_id'] . "' class='btn btn-danger mb-3'> ลบ </a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>0 results</td></tr>";
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <hr>

    <?php
        include 'condb.php';
        $sql = "SELECT * FROM vaccine";
        $result = mysqli_query($conn, $sql);
    ?>
    <section id="vaccine">
        <div class="row">
            <div class="col-3">
                <div class="container">
                    <hr>
                    <h2>+ วัคซีน</h2>
                    <hr>
                    <form action="insert_vac.php" method="post">
                        <label for="vac_id">รหัสวัคซีน:</label><br>
                        <input type="text" id="vac_id" name="vac_id"><br>
                        <label for="vac_name">ชื่อ:</label><br>
                        <input type="text" id="vac_name" name="vac_name"><br>
                        <label for="vac_desc">รายละเอียด:</label><br>
                        <input type="text" id="vac_desc" name="vac_desc"><br><br>
                        <input type="submit" value="บันทึก">
                    </form> 
                </div>
            </div>
            <div class="col-9">
                <div class="container" style="text-align: center;">
                    <hr>
                    <h2>วัคซีน</h2>
                    <hr>
                    <table class="table" style="text-align: center;">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Manage</th>
                        </tr>
                        <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["vac_id"]. "</td>";
                                echo "<td>" . $row["vac_name"]. "</td>";
                                echo "<td>" . $row["vac_desc"]. "</td>";
                                echo "<td>";    
                                echo "<a href='form_update_vac.php?vac_id=" . $row['vac_id'] . "' class='btn btn-warning mb-3'> แก้ไข </a><br>";
                                echo "<a href='delete_vac.php?vac_id=" . $row['vac_id'] . "' class='btn btn-danger mb-3'> ลบ </a>";
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
            </div>
        </div>
    </section>
    <hr>

    <?php
        include 'condb.php';
        $sql = "SELECT * FROM members";
        $result = mysqli_query($conn, $sql);
    ?>
    <section id="mem">
        <div class="row">
            <div class="col-3">
                <div class="container">
                    <hr>
                    <h2>+ สมาชิก</h2>
                    <hr>
                    <form action="insert_mem.php" method="post" enctype="multipart/form-data">
                        <label for="mem_username">ชื่อผู้ใช้งาน:</label><br>
                        <input type="text" id="mem_username" name="mem_username"><br>
                        <label for="mem_firstname">ชื่อ:</label><br>
                        <input type="text" id="mem_firstname" name="mem_firstname"><br>
                        <label for="mem_lastname">นามสกุล:</label><br>
                        <input type="text" id="mem_lastname" name="mem_lastname"><br>
                        <label for="mem_lastname">อีเมล:</label><br>
                        <input type="text" id="mem_email" name="mem_email"><br>
                        <label for="mem_password">รหัสผ่าน:</label><br>
                        <input type="password" id="mem_password" name="mem_password"><br>
                        <label for="mem_picture">รูปภาพ:</label><br>
                        <input type="file" id="mem_picture" name="mem_picture"><br><br>
                        <input type="submit" value="ส่ง">
                    </form>
                </div>
            </div>
            <div class="col-9">
                <div class="container" style="text-align: center;">
                    <hr>
                    <h2>สมาชิก</h2>
                    <hr>
                    <table class="table" style="text-align: center;">
                        <tr>
                            <th>Picture</th>
                            <th>Username</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Manage</th>
                        </tr>
                        <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td><img src='images/" . $row["mem_picture"] . "' style='width: 50px;' ></td>"; 
                                echo "<td>" . $row["mem_username"]. "</td>";
                                echo "<td>" . $row["mem_firstname"]. "</td>";
                                echo "<td>" . $row["mem_lastname"]. "</td>";
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
            </div>
        </div>
    </section>
    <hr>


  </body>
</html>
