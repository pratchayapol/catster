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
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="assets/fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="assets/fontawesome/css/brands.css" rel="stylesheet" />
    <link href="assets/fontawesome/css/solid.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Products</title>
</head>
<body>

    <?php include 'include/sidenav.php'; ?>

    <div class="main">
        <header class="py-3 mb-4 border-bottom">
            <div class="container d-flex flex-wrap justify-content-center">
                <p class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none">
                    <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
                    <span class="fs-4">Products</span>
                </p>
                <form class="col-12 col-lg-auto mb-3 mb-lg-0" role="search">
                    <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                </form>
            </div>
        </header>
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
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
                <table class="table table-hover ms-4">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Remain</th>
                            <th scope="col"></th>
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


<style>
  body {
    font-family: "Lato", sans-serif;
  }

  .sidenav {
    height: 100%;
    width: 250px;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #fff;
    overflow-x: hidden;
    padding-top: 20px;
  }

  .sidenav a {
    padding: 6px 8px 6px 16px;
    text-decoration: none;
    color: #000;
    display: block;
  }

  .sidenav a:hover {
    color: #000;
  }

  .main {
    margin-left: 250px; /* Same as the width of the sidenav */
    padding: 0px 10px;
  }

  @media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
  }

  .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }

      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }

      .nav-link a:hover {
        color: #ffffff;
        background-color: #F88020;
      }
</style>
