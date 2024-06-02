<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title> สมัครสมาชิก </title>
      <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
    <h2>เพิ่มสมาชิก</h2>

    <form action="insert_mem.php" method="post" enctype="multipart/form-data">
        <label for="mem_username">ชื่อผู้ใช้งาน:</label><br>
        <input type="text" id="mem_username" name="mem_username"><br>
        <label for="mem_firstname">ชื่อ:</label><br>
        <input type="text" id="mem_firstname" name="mem_firstname"><br>
        <label for="mem_lastname">นามสกุล:</label><br>
        <input type="text" id="mem_lastname" name="mem_lastname"><br>
        <label for="mem_lastname">อาชีพ:</label><br>
        <input type="text" id="mem_career" name="mem_career"><br>
        <label for="mem_lastname">รายได้ต่อเดือน:</label><br>
        <input type="text" id="mem_income" name="mem_income"><br>
        <label for="mem_lastname">ที่อยู่:</label><br>
        <input type="text" id="mem_address" name="mem_address"><br>
        <label for="mem_lastname">อีเมล:</label><br>
        <input type="text" id="mem_email" name="mem_email"><br>
        <label for="mem_tel">เบอร์โทรศัพท์:</label><br>
        <input type="text" id="mem_tel" name="mem_tel"><br>
        <label for="mem_password">รหัสผ่าน:</label><br>
        <input type="password" id="mem_password" name="mem_password"><br>
        <label for="mem_picture">รูปภาพ:</label><br>
        <input type="file" id="mem_picture" name="mem_picture"><br><br>
        <input type="submit" value="ส่ง">
    </form> 
    </div>
  </body>
</html>
