<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title> + สินค้า </title>
      <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
    <h2>เพิ่มสินค้าและตัวเลือก</h2>

    <form action="insert_product.php" method="post" enctype="multipart/form-data">
        <label for="product_picture">รูปภาพ:</label><br>
        <input type="file" id="product_picture" name="product_picture"><br>
        <label for="product_id">รหัสสินค้า:</label><br>
        <input type="text" id="product_id" name="product_id"><br>
        <label for="product_name">ชื่อสินค้า:</label><br>
        <input type="text" id="product_name" name="product_name"><br>
        <label for="type_id">ประเภทสินค้า:</label><br>
        <select id="type_id" name="type_id">
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
        </select>
        <br><br>


        <h3>ตัวเลือกสินค้า</h3>
        <button type="button" onclick="addOption()">เพิ่มตัวเลือก</button><br>
        <label for="option_name">ชื่อตัวเลือก:</label><br>
        <input type="text" id="option_name" name="option_name[]"><br>

        <label for="option_amount">จำนวน:</label><br>
        <input type="text" id="option_amount" name="option_amount[]"><br>
        <label for="option_price">ราคา:</label><br>
        <input type="text" id="option_price" name="option_price[]"><br>
        <label for="option_desc">คำอธิบาย:</label><br>
        <textarea id="option_desc" name="option_desc[]" rows="4" cols="50"></textarea><br><br>

        <div id="option_fields">
            <!-- ตำแหน่งที่จะให้ส่วนตัวเลือกสินค้าเพิ่มเข้ามา -->
        </div>

        <input type="submit" value="Submit">
    </form>

    <script>
        var optionCount = 0; // เพิ่มตัวแปรเพื่อเก็บจำนวนตัวเลือก

        function addOption() {
            optionCount++; // เพิ่มค่าตัวแปรเมื่อเพิ่มตัวเลือกใหม่
            var optionDiv = document.createElement("div");
            optionDiv.innerHTML = "<label for='option_name_" + optionCount + "'>ชื่อตัวเลือก:</label><br><input type='text' id='option_name_" + optionCount + "' name='option_name[]'><br><label for='option_amount_" + optionCount + "'>จำนวน:</label><br><input type='text' id='option_amount_" + optionCount + "' name='option_amount[]'><br><label for='option_price_" + optionCount + "'>ราคา:</label><br><input type='text' id='option_price_" + optionCount + "' name='option_price[]'><br><label for='option_desc_" + optionCount + "'>คำอธิบาย:</label><br><textarea id='option_desc_" + optionCount + "' name='option_desc[]' rows='4' cols='50'></textarea><br><br>";
            document.getElementById("option_fields").appendChild(optionDiv);
        }
    </script>

    </div>
  </body>
</html>
