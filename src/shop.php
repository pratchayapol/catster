<?php
session_start();
include 'condb.php';

// Product All
$product_sql = "SELECT products.*, product_type.type_name FROM products
                INNER JOIN product_type ON products.type_id = product_type.type_id";
$product_result = mysqli_query($conn, $product_sql);
$products = mysqli_fetch_all($product_result, MYSQLI_ASSOC);
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
    <title>สินค้า</title>
</head>

<body>
    <?php include 'include/menu.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="container" style="margin-top: 110px;">
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Input for searching -->
            <input onkeyup="searchsomething(this)" id="txt_search" type="text" class="sidebar-search" placeholder="Search something...">
            <!-- Links to filter products -->
            <a onclick="searchproduct('all')" class="sidebar-items">All product</a>
            <a onclick="searchproduct('TYPE1')" class="sidebar-items">Food</a>
            <a onclick="searchproduct('TYPE2')" class="sidebar-items">Toy</a>
            <a onclick="searchproduct('TYPE3')" class="sidebar-items">Item</a>
        </div>
        
        <!-- Product list -->
        <div id="productlist" class="product">
            <?php while($product = mysqli_fetch_assoc($product_result)): ?>
                <!-- Individual product item -->
                <div onclick="openProductDetail(<?= $product['product_id']; ?>)" class="product-items <?= $product['type_id']; ?>">
                    <!-- Product image -->
                    <img class="product-img" src="images/<?= htmlspecialchars($product['product_picture']); ?>" alt="">
                    <!-- Product name -->
                    <p style="font-size: 1.2vw;"><?= htmlspecialchars($product['product_name']); ?></p>
                    <!-- Product price -->
                    <p style="font-size: 1vw;"><?= htmlspecialchars(number_format($product['product_price'])); ?> THB</p>
                </div>
            <?php endwhile ?>
        </div>
    </div>



    <div id="modalDesc" class="modal" style="display: none;">
        <div onclick="closeModal()" class="modal-bg"></div>
        <div class="modal-page">
            <div class="modaldesc-content">
                <img id="mdd-img" class="modaldesc-img" src="" alt="">
                <div class="modaldesc-detail">
                    <p id="mdd-name" style="font-size: 1.5vw;"></p>
                    <p id="mdd-price" style="font-size: 1.2vw;"></p>
                    <br>
                    <p id="mdd-desc" style="color: #adadad;"></p>
                    <br>
                    <div class="btn-control">
                        <button onclick="closeModal()" class="btn">Close</button>
                        <a id="mdd-add-to-cart" href="#" class="btn btn-buy">Add to cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        var product = <?= json_encode($products); ?>;
        var productindex = 0;

        $(document).ready(() => {
            var html = '';
            for (let i = 0; i < product.length; i++) {
                html += `<div onclick="openProductDetail(${i})" class="product-items ${product[i].type_id}">
                            <img class="product-img" src="images/${product[i].product_picture}" alt="">
                            <p style="font-size: 1.2vw;">${product[i].product_name}</p>
                            <p style="font-size: 1vw;">${ numberWithCommas(product[i].product_price) } THB</p>
                        </div>`;
            }
            $("#productlist").html(html);
        });

        function numberWithCommas(x) {
            x = x.toString();
            var pattern = /(-?\d+)(\d{3})/;
            while (pattern.test(x))
                x = x.replace(pattern, "$1,$2");
            return x;
        }

        function searchsomething(elem) {
            var value = elem.value.trim();
            var html = '';
            for (let i = 0; i < products.length; i++) {
                if (products[i].product_name.includes(value)) {
                    html += `<div onclick="openProductDetail(${products[i].product_id})" class="product-items ${products[i].type_id}">
                                <img class="product-img" src="images/${products[i].product_picture}" alt="">
                                <p style="font-size: 1.2vw;">${products[i].product_name}</p>
                                <p style="font-size: 1vw;">${numberWithCommas(products[i].product_price)} THB</p>
                            </div>`;
                }
            }
            if (html === '') {
                $("#productlist").html(`<p>Not found product</p>`);
            } else {
                $("#productlist").html(html);
            }
        }


        function searchproduct(param) {
            var items = document.getElementsByClassName('product-items');
            if (param === 'all') {
                // แสดงทุกรายการสินค้า
                for (var i = 0; i < items.length; i++) {
                    items[i].style.display = 'block';
                }
            } else {
                // กรองและแสดงเฉพาะรายการสินค้าที่มีคลาสตรงกับ param
                for (var i = 0; i < items.length; i++) {
                    if (items[i].classList.contains(param)) {
                        items[i].style.display = 'block';
                    } else {
                        items[i].style.display = 'none';
                    }
                }
            }
        }




        function openProductDetail(index) {
            productindex = index;
            $("#modalDesc").css('display', 'flex');
            $("#mdd-img").attr('src', 'images/' + product[index].product_picture);
            $("#mdd-name").text(product[index].product_name);
            $("#mdd-price").text(numberWithCommas(product[index].product_price) + ' THB');
            $("#mdd-desc").text(product[index].product_desc);
            $("#mdd-add-to-cart").attr('href', 'add_to_cart.php?product_id=' + product[index].product_id);
        }


        function closeModal() {
            $(".modal").css('display','none');
        }

    </script>
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
    background-color: #fff;
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
