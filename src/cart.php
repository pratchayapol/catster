<?php
session_start();
include 'condb.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$productIDs = [];
foreach (($_SESSION['cart'] ?? []) as $cartID => $cartQty) {
    $productIDs[] = "'" . mysqli_real_escape_string($conn, $cartID) . "'";
}

$IDs = '';
if (count($productIDs) > 0) {
    $IDs = implode(', ', $productIDs);
}

$rows = 0;
$products = [];

if (!empty($IDs)) {
    $product_sql = "SELECT products.*, product_type.type_name FROM products
                    INNER JOIN product_type ON products.type_id = product_type.type_id 
                    WHERE product_id IN ($IDs)";
    $product_result = mysqli_query($conn, $product_sql);
    if ($product_result) {
        while ($row = mysqli_fetch_assoc($product_result)) {
            $products[] = $row;
        }
        $rows = count($products);
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/5f1b7c0a83.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>ตะกร้า</title>
</head>
<body class="bg-body-tertiary">
    <?php include 'include/menu.php'; ?>
    <div class="container mt-5">
        <section class="h-100" style="background-color: #eee;">
            <div class="container h-100 py-5">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-10">
                        <form action="update_cart.php" method="POST">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="fw-normal mb-0 text-black">Shopping Cart</h3>
                            <button type="submit" class="btn btn-warning text-end"><i class="fa-solid fa-arrows-rotate"></i></button>
                        </div>

                        <?php if ($rows > 0): ?>
                            <?php foreach ($products as $product): ?>
                                <div class="card rounded-3 mb-4">
                                    <div class="card-body p-4">
                                        <div class="row d-flex justify-content-between align-items-center">
                                            <div class="col-md-2 col-lg-2 col-xl-2">
                                                <?php if (!empty($product['product_picture'])): ?>
                                                    <img src="images/<?php echo htmlspecialchars($product['product_picture']); ?>" class="img-fluid rounded-3" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                                                <?php else: ?>
                                                    <img src="images/noimage.png" class="img-fluid rounded-3" alt="">
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-xl-3">
                                                <p class="lead fw-normal mb-2"><?php echo htmlspecialchars($product['product_name']); ?></p>
                                                <p><span class="text-muted"><?php echo htmlspecialchars($product['product_desc']); ?></span></p>
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                <input type="number" name="product[<?php echo htmlspecialchars($product['product_id']); ?>][quantity]" value="<?php echo htmlspecialchars($_SESSION['cart'][$product['product_id']]); ?>" class="form-control">
                                            </div>
                                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                <h5 class="mb-0">&euro; <?php echo number_format($product['product_price'] * $_SESSION['cart'][$product['product_id']], 2); ?></h5>
                                            </div>
                                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                <a href="delete_from_cart.php?product_id=<?php echo htmlspecialchars($product['product_id']); ?>" onclick="return confirm('ต้องการลบสินค้าออกจากตะกร้า ?');" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="row">
                                <div class="col text-center"><p>ไม่มีรายการสินค้า.</p></div>
                            </div>
                        <?php endif; ?>
                        </form>

                        <div class="card">
                            <div class="card-body d-grid gap-2">
                                <a href="form_checkout.php" type="button" class="btn btn-warning btn-block btn-md">Check out</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        function updateQuantity(productId, delta) {
            let quantityInput = document.getElementById('quantity-' + productId);
            let currentQuantity = parseInt(quantityInput.value);
            let newQuantity = currentQuantity + delta;
            if (newQuantity >= 0) {
                quantityInput.value = newQuantity;
                updateCartSession(productId, newQuantity);
            }
        }

        function updateCartSession(productId, quantity) {
            $.post('update_cart.php', {
                product: {
                    [productId]: { quantity: quantity }
                }
            }, function(response) {
                // Handle the response if needed
                console.log('Cart updated successfully.');
            });
        }
    </script>
</body>
</html>
