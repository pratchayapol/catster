<?php
session_start();
include 'condb.php';

// Fetch all products
$product_sql = "SELECT products.*, product_type.type_name FROM products
        INNER JOIN product_type ON products.type_id = product_type.type_id";
$product_result = mysqli_query($conn, $product_sql);
$rows = mysqli_num_rows($product_result);

// Fetch all product types
$type_query = "SELECT type_id, type_name FROM product_type";
$type_result = mysqli_query($conn, $type_query);

// Default values for the form
$result = [
    'product_id' => '',
    'product_name' => '',
    'product_price' => '',
    'product_remain' => '',
    'product_desc' => '',
    'product_picture' => '',
    'type_id' => '',
];

// Select a product to update
if (!empty($_GET['product_id'])) {
    $query_product = mysqli_query($conn, "SELECT * FROM products WHERE product_id = '".mysqli_real_escape_string($conn, $_GET['product_id'])."'");
    $row_product = mysqli_num_rows($query_product);
    if ($row_product == 0) {
        header('location:products.php');
        exit;
    }
    $result = mysqli_fetch_assoc($query_product);
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="assets/js/bootstrap.min.js"></script>
    <link href="assets/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/fontawesome/css/solid.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5f1b7c0a83.js" crossorigin="anonymous"></script>
    <title>สินค้า</title>
</head>
<body>
    <?php include 'include/menu.php' ?>
    <div class="container" style="margin-top: 70px;">
        <h4>จัดการข้อมูลสินค้า</h4>
        <div class="row g-5">
            <div class="col-md-8 col-sm-12">
                <form action="insert_product.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($result['product_id']); ?>">
                    <div class="row g-3 mb-3">
                        <?php if(!empty($result['product_id'])): ?>
                        <div class="col-sm-2">
                            <?php if(!empty($result['product_picture'])): ?>
                                <br>
                                <img src="images/<?php echo htmlspecialchars($result['product_picture']); ?>" style="width: 100px;" alt="รูปภาพสินค้า">
                            <?php else: ?>
                                <img src="images/noimage.png" style="width: 100px;" alt="รูปภาพสินค้า">
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-10">
                            <label for="product_picture" class="form-label">รูปภาพ</label>
                            <input type="file" name="product_picture" class="form-control" id="product_picture">
                        </div>
                        <?php else: ?>
                            <div class="col-sm-6">
                                <label for="product_picture" class="form-label">รูปภาพ</label>
                                <input type="file" name="product_picture" class="form-control" id="product_picture">
                            </div>
                            <div class="col-sm-6">
                                <label for="product_id" class="form-label">รหัสสินค้า</label>
                                <input type="text" name="product_id" class="form-control" id="product_id">
                            </div>
                        <?php endif; ?>
                        <div class="col-sm-6">
                            <label for="product_name" class="form-label">ชื่อสินค้า</label>
                            <input type="text" name="product_name" class="form-control" id="product_name" value="<?php echo htmlspecialchars($result['product_name']); ?>">
                        </div>
                        <div class="col-sm-6">
                            <label for="product_price" class="form-label">ราคา</label>
                            <input type="text" name="product_price" class="form-control" id="product_price" value="<?php echo htmlspecialchars($result['product_price']); ?>">
                        </div>
                        <div class="col-sm-6">
                            <label for="product_remain" class="form-label">จำนวนคงเหลือ</label>
                            <input type="number" name="product_remain" class="form-control" id="product_remain" value="<?php echo htmlspecialchars($result['product_remain']); ?>">
                        </div>
                        <div class="col-sm-6">
                            <label for="type_id" class="form-label">ประเภท</label>
                            <select name="type_id" id="type_id" class="form-select">
                                <?php 
                                    while($type = mysqli_fetch_assoc($type_result)) {
                                        $selected = ($type['type_id'] == $result['type_id']) ? 'selected' : '';
                                        echo '<option value="'.htmlspecialchars($type['type_id']).'" '.$selected.'>'.htmlspecialchars($type['type_name']).'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <label for="product_desc" class="form-label">รายละเอียด</label>
                            <textarea name="product_desc" class="form-control" id="product_desc" rows="3"><?php echo htmlspecialchars($result['product_desc']); ?></textarea>
                        </div>
                    </div>
                    <button class="btn btn-success" type="submit">
                        <i class="fa-regular fa-floppy-disk me-1"></i>Save
                    </button>
                    <a class="btn btn-secondary" href="products.php"><i class="fa-solid fa-angles-left me-1"></i>ยกเลิก</a>
                    <hr class="my-4">
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered border-dark">
                    <thead>
                        <tr style="text-align: center;">
                            <th style="width: 100px;">รูปภาพ</th>
                            <th>ชื่อสินค้า</th>
                            <th style="width: 200px;">ราคา</th>
                            <th style="width: 200px;">จำนวนคงเหลือ</th>
                            <th style="width: 200px;">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if($rows > 0): 
                                while($product = mysqli_fetch_assoc($product_result)):
                        ?>
                        <tr>
                            <td>
                                <?php if(!empty($product['product_picture'])): ?>
                                    <img src="images/<?php echo htmlspecialchars($product['product_picture']); ?>" style="width: 100px;" alt="รูปภาพสินค้า">
                                <?php else: ?>
                                    <img src="images/noimage.png" style="width: 100px;" alt="ไม่มีรูปภาพ">
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                            <td><?php echo number_format($product['product_price'], 2); ?></td>
                            <td><?php echo htmlspecialchars($product['product_remain']); ?></td>
                            <td>
                                <a role="button" href="form_update_product.php?product_id=<?php echo htmlspecialchars($product['product_id']); ?>" class="btn btn-outline-dark"><i class="fa-regular fa-pen-to-square me-1"></i>แก้ไข</a>
                                <a role="button" href="delete_product.php?product_id=<?php echo htmlspecialchars($product['product_id']); ?>" class="btn btn-outline-danger" onclick="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบสินค้านี้?');">
                                    <i class="fa-regular fa-trash-can me-1"></i>ลบ
                                </a>
                            </td>
                        </tr>
                        <?php 
                                endwhile; 
                            else: 
                        ?>
                        <tr>
                            <td colspan="5"><p class="text-center">ไม่มีข้อมูล</p></td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
