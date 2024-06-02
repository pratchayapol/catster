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

    <form action="insert_shelter.php" method="post" enctype="multipart/form-data">
        <label for="shelter_name">ชื่อ:</label><br>
        <input type="text" id="shelter_name" name="shelter_name"><br>
        <label for="shelter_address">ที่อยู่:</label><br>
        <input type="text" id="shelter_address" name="shelter_address"><br>
        <label for="shelter_tel">เบอร์:</label><br>
        <input type="text" id="shelter_tel" name="shelter_tel"><br>
        <label for="shelter_donation">เงินบริจาค:</label><br>
        <input type="text" id="shelter_donation" name="shelter_donation"><br>
        <label for="shelter_qr">รูปภาพ:</label><br>
        <input type="file" id="shelter_qr" name="shelter_qr"><br><br>
        <input type="submit" value="ส่ง">
    </form> 
    </div>
  </body>
</html>
