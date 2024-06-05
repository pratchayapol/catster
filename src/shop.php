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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <link href="assets/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/fontawesome/css/solid.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/5f1b7c0a83.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>สินค้า</title>
</head>

<body>
<?php include 'include/menu.php'; ?>

  <div class="container" style="margin-top: 110px;">
    <div class="sidebar">
      <input type="text" class="sidebar-search" placeholder="Search something...">

      <a onclick="searchproduct('all')" class="sidebar-items" style="text-decoration: none;">
        สินค้าทั้งหมด
      </a>
      <a onclick="searchproduct('TYPE1')" class="sidebar-items" style="text-decoration: none;">
        อาหาร
      </a>
      <a onclick="searchproduct('TYPE2')" class="sidebar-items" style="text-decoration: none;">
        ของเล่น
      </a>
      <a onclick="searchproduct('TYPE3')" class="sidebar-items" style="text-decoration: none;">
        อุปกรณ์ / ของใช้
      </a>
    </div>

    <div class="product">
        <?php if($rows > 0): ?>                        
            <?php while($product = mysqli_fetch_assoc($product_result)): ?>
                <div class="product-items">
                <?php if(!empty($product['product_picture'])): ?>
                    <img src="images/<?php echo htmlspecialchars($product['product_picture']); ?>" class="product-img" alt="รูปภาพสินค้า">
                <?php else: ?>
                    <img src="images/noimage.png" class="product-img" alt="ไม่มีรูปภาพ">
                <?php endif; ?>
                    <p style="font-size: 1.2vw;"><?php echo $product['product_name']; ?></p>
                    <p stlye="font-size: 1vw;"><?php echo $product['product_price']; ?> THB</p>
                </div>
            <?php endwhile ?>
        <?php endif ?>
    </div>

  </div>

  <div class="modal" style="display: none;">
    <div class="modal-bg"></div>
        <div class="modal-page">
            <h2>Detail</h2>
            <br>
            <?php if($rows > 0): ?>                        
            <?php while($product = mysqli_fetch_assoc($product_result)): ?>
            <div class="modaldesc-content">
                <?php if(!empty($product['product_picture'])): ?>
                    <img src="images/<?php echo htmlspecialchars($product['product_picture']); ?>" class="modaldesc-img" alt="รูปภาพสินค้า">
                <?php else: ?>
                    <img src="images/noimage.png" class="modaldesc-img" alt="ไม่มีรูปภาพ">
                <?php endif; ?>
                <div class="modaldesc-detail">
                    <p style="font-size: 1.5vw;"><?php echo $product['product_name']; ?></p>
                    <p style="font-size: 1.2vw;"><?php echo $product['product_price']; ?> THB</p>
                    <br>
                    <p style="color: #adadad;"><?php echo $product['product_desc']; ?></p>
                    <br>
                    <div class="btn-control">
                        <button class="btn">
                        Close
                        </button>
                        <button class="btn btn-buy">
                        Add to cart
                        </button>
                    </div>
                </div>
            </div>
            <?php endwhile ?>
            <?php endif ?>
        </div>
  </div>

  <div class="modal" style="display: none;">
    <div class="modal-bg"></div>
    <div class="modal-page">
      <h2>My cart</h2>
      <br>
      <div class="cartlist">
        <div class="cartlist-items">
          <div class="cartlist-left">
            <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80" alt="">
            <div class="cartlist-detail">
              <p style="font-size: 1.5vw;">Product name</p>
              <p style="font-size: 1.2vw;">500 THB</p>
            </div>
          </div>
          <div class="cartlist-right">
            <p class="btnc">-</p>
            <p style="margin: 0 20px;">1</p>
            <p class="btnc">+</p>
          </div>
        </div>
      </div>
      <div class="btn-control">
        <button class="btn">
          Cancel
        </button>
        <button class="btn btn-buy">
          Buy
        </button>
      </div>
    </div>
  </div>

</body>
</html>



<style>
    @import url("https://fonts.googleapis.com/css2?family=Noto+Sans:wght@500&display=swap");
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    text-decoration: none;
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
    }
    *::-webkit-scrollbar {
    display: none;
    }
    nav {
    background: linear-gradient(125deg, #e61b36, #9c1032);
    }
    .nav-container {
    max-width: 90vw;
    height: 100%;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    }
    .logonav {
    width: 7vw;
    object-fit: contain;
    }
    .nav-profile {
    display: flex;
    align-items: center;
    }
    .nav-profile-name {
    color: #fff;
    font-size: 1.2vw;
    margin-right: 10px;
    }
    .fa-cart-shopping {
    font-size: 2vw;
    color: #fff;
    }
    .nav-profile-cart {
    position: relative;
    }
    .cartcount {
    position: absolute;
    top: -15px;
    right: -15px;
    width: 25px;
    height: 25px;
    background: red;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff;
    }
    .container {
    width: 90vw;
    margin: 0 auto;
    display: flex;
    }
    .sidebar {
    width: 20%;
    padding: 10px;
    display: flex;
    flex-direction: column;
    }
    .product {
    width: 80%;
    padding: 10px;
    height: 100%;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-gap: 20px;
    }
    .sidebar-search {
    padding: 10px;
    border: 2px solid transparent;
    width: 100%;
    font-size: 1.2vw;
    outline: none;
    border-radius: 5px;
    background: #f2f2f2;
    transition: 0.3s;
    margin-bottom: 20px;
    }
    .sidebar-search:focus {
    border: 2px solid #e61b36;
    }
    .sidebar-items {
    background: #f2f2f2;
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #e5e5e5;
    color: #000;
    transition: 300ms;
    font-size: 1.2vw;
    }
    .sidebar-items:hover {
    background: #9c1032;
    color: #fff;
    }
    .product-items {
    cursor: pointer;
    transition: 0.3s;
    }
    .product-items:hover {
    transform: scale(1.03);
    }
    .product-img {
    width: 100%;
    height: 17vw;
    object-fit: cover;
    border-radius: 10px;
    }
    .modal,
    .modal-bg {
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    }
    .modal-page {
    z-index: 99;
    min-width: 30vw;
    max-width: 60vw;
    max-height: 30vw;
    overflow: scroll;
    background: #fff;
    border-radius: 15px;
    padding: 20px;
    }
    .modaldesc-content {
    width: 100%;
    display: flex;
    }
    .modaldesc-detail {
    margin-left: 20px;
    }
    .modaldesc-img {
    width: 20vw;
    height: 20vw;
    object-fit: cover;
    border-radius: 10px;
    }
    .btn-control {
    display: flex;
    justify-content: flex-end;
    }
    .btn {
    padding: 10px 20px;
    cursor: pointer;
    border: none;
    border-radius: 5px;
    font-size: 1.2vw;
    transition: 0.3s;
    }
    .btn-buy {
    background: linear-gradient(125deg, #e61b36, #9c1032);
    color: #fff;
    margin-left: 10px;
    }
    .cartlist {
    }
    .cartlist-items {
    width: 50vw;
    display: flex;
    margin-bottom: 20px;
    justify-content: space-between;
    }
    .cartlist-left {
    display: flex;
    }
    .cartlist-right {
    display: flex;
    align-items: center;
    }
    .cartlist-left img {
    width: 5vw;
    height: 5vw;
    object-fit: cover;
    border-radius: 5px;
    margin-right: 10px;
    }
    .btnc {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    border: 1px solid #000;
    cursor: pointer;
    }

</style>
