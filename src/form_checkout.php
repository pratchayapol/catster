<?php
    session_start();
    include 'condb.php';

    // ตรวจสอบว่ามีข้อมูล cart ใน session หรือไม่
    $cart_count = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $quantity) {
            $cart_count += $quantity;
        }
    }

    // สร้างรายการ product IDs จาก session cart
    $productIDs = [];
    foreach (($_SESSION['cart'] ?? []) as $cartID => $cartValue) {
        $productIDs[] = "'" . mysqli_real_escape_string($conn, $cartID) . "'";
    }

    // สร้างรายการ IDs เป็น string สำหรับ query
    $IDs = '';
    if (count($productIDs) > 0) {
        $IDs = implode(', ', $productIDs);
    }

    // query เพื่อดึงข้อมูลสินค้า
    $query = null;
    if (!empty($IDs)) {
        $query = mysqli_query($conn, "SELECT * FROM products WHERE product_id IN ($IDs)");
    }
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>สั่งซื้อสินค้า</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="background-color: #fff; color: #000;">
    <?php include 'include/menu.php'; ?>
    <div class="container mt-5">
        <main>
            <div class="py-5 text-center">
                <h2>สั่งซื้อสินค้า</h2>
                <p class="lead">โปรดตรวจสอบสินค้าในตะกร้าของคุณก่อนทำการชำระเงิน</p>
            </div>

            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-dark">รายการสินค้า</span>
                        <span class="badge bg-secondary-subtle border border-secondary-subtle text-secondary-emphasis rounded-pill"><?php echo $cart_count; ?></span>
                    </h4>
                    <form action="insert_order.php" method="POST">
                        <ul class="list-group mb-3">
                            <?php
                            if (mysqli_num_rows($query) > 0) {
                                $order_total = 0;
                                while ($product = mysqli_fetch_assoc($query)) {
                                    $quantity = $_SESSION['cart'][$product['product_id']];
                                    $product_price = $product['product_price'];
                                    $subtotal = $quantity * $product_price;
                                    $order_total += $subtotal;
                                    ?>
                                    <li class="list-group-item d-flex justify-content-between lh-sm">
                                        <div>
                                            <h6 class="my-0">
                                                <span class="badge bg-secondary rounded-pill me-1"><?php echo $quantity; ?></span>
                                                <?php echo $product['product_name']; ?>
                                            </h6>
                                            <small class="text-muted"><?php echo $product['product_desc']; ?></small>
                                            <input type="hidden" name="product[<?php echo $product['product_id'] ?>][product_id]" value="<?php echo $product['product_id']; ?>">
                                            <input type="hidden" name="product[<?php echo $product['product_id'] ?>][product_price]" value="<?php echo $product['product_price']; ?>">
                                            <input type="hidden" name="product[<?php echo $product['product_id'] ?>][product_name]" value="<?php echo $product['product_name']; ?>">
                                            <input type="hidden" name="product[<?php echo $product['product_id'] ?>][quantity]" value="<?php echo $quantity; ?>">
                                        </div>
                                        <span class="text-muted"><?php echo number_format($product_price, 2); ?></span>
                                    </li>
                                    <?php
                                }
                                ?>
                                <li class="list-group-item d-flex justify-content-between lh-sm">
                                    <div class="text-success">
                                        <h6 class="my-0">ทั้งหมด: </h6>
                                    </div>
                                    <span class="text-success"><strong><?php echo number_format($order_total, 2); ?></strong></span>
                                </li>
                                <?php
                            } else {
                                echo "<li class='list-group-item d-flex justify-content-between lh-sm'>ไม่มีสินค้าที่เลือกในตะกร้า</li>";
                            }
                            ?>
                        </ul>
                        <input type="hidden" name="order_total" value="<?php echo $order_total; ?>">
                        <hr class="my-4">
                        <button class="w-100 btn btn-primary btn-md mb-2" type="submit">ชำระเงิน</button>
                        <a href="cart.php" class="w-100 btn btn-secondary btn-md">กลับ</a>

                </div>

                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">ข้อมูลสำหรับการจัดส่ง</h4>
                    <?php if (isset($_SESSION['username'])) { ?>

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="mem_firstName" class="form-label">ชื่อ</label>
                                <input type="text" class="form-control" id="mem_firstName" placeholder="" value="<?php echo $_SESSION['firstname'] ?>" required>
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="mem_lastName" class="form-label">นามสกุล</label>
                                <input type="text" class="form-control" id="mem_lastName" placeholder="" value="<?php echo $_SESSION['lastname'] ?>" required>
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="mem_username" class="form-label">ชื่อผู้ใช้งาน</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text">@</span>
                                    <input type="text" class="form-control" id="mem_username" name="mem_username" placeholder="" value="<?php echo $_SESSION['username'] ?>" required>
                                    <div class="invalid-feedback">
                                        Your username is required.
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="order_tel" class="form-label">เบอร์โทรศัพท์</label>
                                <input type="tel" class="form-control" id="order_tel" name="order_tel" placeholder="xxx-xxx-xxxx" required>
                                <div class="invalid-feedback">
                                    กรุณากรอกเบอร์โทรศัพท์สำหรับการติดต่อ
                                </div>
                            </div>

                            <div class="col-8">
                                <label for="order_address" class="form-label">ที่อยู่</label>
                                <textarea type="text" class="form-control" id="order_address" name="order_address" placeholder="" required></textarea>
                                <div class="invalid-feedback">
                                    กรุณากรอกที่อยู่สำหรับการจัดส่ง
                                </div>
                            </div>
                            <div class="col-4">
                                <label for="order_note" class="form-label">หมายเหตุ</label>
                                <textarea type="text" class="form-control" id="order_note" name="order_note" placeholder=""></textarea>
                            </div>

                        </div>
                        <hr class="my-4">
                    </form>
                    <?php } ?>
                </div>
            </div>
        </main>
    </div>

    <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-pp3Dmlh1NmsyAuAY3Z9wF7c/2eDtKLEe5zvF/nHYG0p+1w2p1lWue73e5IrTw3f7" crossorigin="anonymous"></script>
    <script src="form-validation.js"></script>
</body>

</html>
