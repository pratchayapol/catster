<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title> + พนักงาน </title>
      <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
    <h2>เพิ่มสมาชิก</h2>

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
  </body>
</html>
