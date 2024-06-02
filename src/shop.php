<?php
    session_start();
    include 'condb.php';

    // Product All
    $product_sql = "SELECT products.*, product_type.type_name FROM products
            INNER JOIN product_type ON products.type_id = product_type.type_id";
    $product_result = mysqli_query($conn, $product_sql);
    $rows = mysqli_num_rows($product_result);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <link href="assets/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/fontawesome/css/solid.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5f1b7c0a83.js" crossorigin="anonymous"></script>
    <title>สินค้า</title>
</head>
<body class="bg-body-tertiary">
    <?php include 'include/menu.php'; ?>
    <div class="container" style="margin-top: 30px;">
        <h4>สินค้าทั้งหมด</h4>
        <div class="row">
        <?php if($rows > 0): ?>                        
            <?php while($product = mysqli_fetch_assoc($product_result)): ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                    <div class="card h-100">
                        <?php if(!empty($product['product_picture'])): ?>
                            <img src="images/<?php echo htmlspecialchars($product['product_picture']); ?>" class="card-img-top" alt="รูปภาพสินค้า">
                        <?php else: ?>
                            <img src="images/noimage.png" class="card-img-top" alt="ไม่มีรูปภาพ">
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['product_name']); ?></h5>
                            <p class="card-text text-success mb-0 fw-bold"><i class="fa-solid fa-baht-sign me-1"></i><?php echo htmlspecialchars($product['product_price']); ?></p>
                            <p class="card-text text-muted"><?php echo htmlspecialchars($product['product_desc']); ?></p>
                            <a href="add_to_cart.php?product_id=<?php echo htmlspecialchars($product['product_id']); ?>" class="btn btn-primary mt-auto"><i class="fa-solid fa-cart-plus me-2"></i>ADD TO CART</a>
                        </div>
                    </div>
                </div>
            <?php endwhile ?>
        <?php else: ?>
            <div class="col-12">
                <h4 class="text-dark"> ไม่มีรายการสินค้า </h4>
            </div>
        <?php endif ?>
        </div>
    </div>
</body>
</html>
