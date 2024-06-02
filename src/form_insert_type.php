<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title> + ประเภท </title>
      <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
    <h2>เพิ่มประเภทสินค้า</h2>

    <form action="insert_type.php" method="post">
        <label for="type_id">รหัสประเภทสินค้า:</label><br>
        <input type="text" id="type_id" name="type_id"><br>
        <label for="type_name">ชื่อ:</label><br>
        <input type="text" id="type_name" name="type_name"><br>
        <label for="type_desc">รายละเอียด:</label><br>
        <input type="text" id="type_desc" name="type_desc"><br>
        <input type="submit" value="บันทึก">
    </form> 
    </div>
  </body>
</html>
