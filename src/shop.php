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
    <script src="https://kit.fontawesome.com/5f1b7c0a83.js" crossorigin="anonymous"></script>
    <title>สินค้า</title>
</head>
<body class="bg-body-tertiary">
    <?php include 'include/menu.php'; ?>

    <div class="container mt-5">
        <div class="wrapper">
            <div id="mobile-filter">
                <div class="py-3">
                    <h5 class="font-weight-bold">Categories</h5>
                    <ul class="list-group">
                            <li class="btn list-group-item list-group-item-action d-flex justify-content-between align-items-center category"> Food <span class="badge badge-primary badge-pill">328</span> </li>
                            <li class="btn list-group-item list-group-item-action d-flex justify-content-between align-items-center category"> Toy <span class="badge badge-primary badge-pill">112</span> </li>
                            <li class="btn list-group-item list-group-item-action d-flex justify-content-between align-items-center category"> Item <span class="badge badge-primary badge-pill">32</span> </li>
                            <li class="btn list-group-item list-group-item-action d-flex justify-content-between align-items-center category"> by Catster <span class="badge badge-primary badge-pill">48</span> </li>
                        </ul>
                </div>
            </div>
            <div class="content py-md-0 py-3">
                <section id="sidebar">
                    <div class="py-3" id="myBtnContainer">
                        <h5 class="font-weight-bold">Categories</h5>
                        <ul class="list-group">
                        <li class="btn list-group-item list-group-item-action d-flex justify-content-between align-items-center category" data-type="All" onclick="filterSelection('All                                             ')"> All <span class="badge badge-primary badge-pill">328</span> </li>
<li class="btn list-group-item list-group-item-action d-flex justify-content-between align-items-center category" data-type="TYPE1" onclick="filterSelection('TYPE1')"> Food <span class="badge badge-primary badge-pill">328</span> </li>
<li class="btn list-group-item list-group-item-action d-flex justify-content-between align-items-center category" data-type="TYPE2" onclick="filterSelection('TYPE2')"> Toy <span class="badge badge-primary badge-pill">112</span> </li>
<li class="btn list-group-item list-group-item-action d-flex justify-content-between align-items-center category" data-type="TYPE3" onclick="filterSelection('TYPE3')"> Item <span class="badge badge-primary badge-pill">32</span> </li>
<li class="btn list-group-item list-group-item-action d-flex justify-content-between align-items-center category" data-type="TYPE4" onclick="filterSelection('TYPE4')"> by Catster <span class="badge badge-primary badge-pill">48</span> </li>
                        </ul>
                    </div>
                </section> 
                
                
                <!-- Products Section -->
                <?php if ($rows > 0) : ?>
                    <section id="products">
                        <div class="container py-3">
                            <div class="row">
                                <?php $count = 0; ?>
                                <?php while ($product = mysqli_fetch_assoc($product_result)) : ?>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="card mb-3 <?php echo htmlspecialchars($product['type_id']); ?>" data-type-id="<?php echo htmlspecialchars($product['type_id']); ?>">
                                            <?php if (!empty($product['product_picture'])) : ?>
                                                <img src="images/<?php echo htmlspecialchars($product['product_picture']); ?>" class="card-img-top" alt="Product Image">
                                            <?php else : ?>
                                                <img src="images/noimage.png" class="card-img-top" alt="No Image">
                                            <?php endif; ?>
                                            <div class="card-body">
                                                <h6 class="font-weight-bold pt-1"><?php echo htmlspecialchars($product['product_name']); ?></h6>
                                                <div class="text-muted description"><?php echo htmlspecialchars($product['product_desc']); ?></div>
                                                <div class="d-flex align-items-center justify-content-between pt-3">
                                                    <div class="d-flex flex-column">
                                                        <div class="h6 font-weight-bold">
                                                            <i class="fa-solid fa-baht-sign me-1"></i>
                                                            <?php echo htmlspecialchars($product['product_price']); ?>
                                                        </div>
                                                    </div>
                                                    <a href="add_to_cart.php?product_id=<?php echo htmlspecialchars($product['product_id']); ?>" class="btn mt-auto">
                                                        <i class="fa-solid fa-cart-plus me-2"></i>ADD TO CART
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $count++;
                                    if ($count % 3 == 0) {
                                        echo '</div><div class="row">';
                                    }
                                    ?>
                                <?php endwhile ?>
                            </div>
                        </div>
                    </section>
                <?php else : ?>
                    <div class="col-12">
                        <h4 class="text-dark">No products available</h4>
                    </div>
                <?php endif ?>




            </div>
        </div>
    </div>

</body>

<script>
    filterSelection("All")
    function filterSelection(c) {
    var x, i;
    x = document.getElementsByClassName("filterDiv");
    if (c == "all") c = "";
    for (i = 0; i < x.length; i++) {
        w3RemoveClass(x[i], "show");
        if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
    }
    }

    function w3AddClass(element, name) {
    var i, arr1, arr2;
    arr1 = element.className.split(" ");
    arr2 = name.split(" ");
    for (i = 0; i < arr2.length; i++) {
        if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
    }
    }

    function w3RemoveClass(element, name) {
    var i, arr1, arr2;
    arr1 = element.className.split(" ");
    arr2 = name.split(" ");
    for (i = 0; i < arr2.length; i++) {
        while (arr1.indexOf(arr2[i]) > -1) {
        arr1.splice(arr1.indexOf(arr2[i]), 1);     
        }
    }
    element.className = arr1.join(" ");
    }

    // Add active class to the current button (highlight it)
    var btnContainer = document.getElementById("myBtnContainer");
    var btns = btnContainer.getElementsByClassName("btn");
    for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function(){
        var current = document.getElementsByClassName("active");
        current[0].className = current[0].className.replace(" active", "");
        this.className += " active";
    });
    }
    
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.category').click(function(){
            var type = $(this).attr('data-type');
            if(type == 'All'){
                $('.card').show();
            }else{
                $('.card').hide();
                $('.' + type).show();
            }
        });
    });
</script>



</html>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    .wrapper{
        padding: 30px;
        max-width: 1200px;
        margin: auto;
    }
    .h3{
        font-weight: 900;
    }
    .btn{
        color: #666;
        font-size: 0.85rem;
    }
    .btn:hover{
        color: #61b15a;
    }
    .green-label{
        background-color: #defadb;
        color: #48b83e;
        border-radius: 5px;
        font-size: 0.8rem;
        margin: 0 3px;
    }
    .radio,.checkbox{
        padding: 6px 10px;
    }
    .border{
        border-radius: 12px;
    }
    .options{
        position: relative;
        padding-left: 25px;
    }
    .radio label,
    .checkbox label{
        display: block;
        font-size: 14px;
        cursor: pointer;
        margin: 0;
    }
    .options input{
        opacity: 0;
    }
    .checkmark {
        position: absolute;
        top: 0px;
        left: 0;
        height: 20px;
        width: 20px;
        background-color: #f8f8f8;
        border: 1px solid #ddd;
        border-radius: 50%;
    }
    .options input:checked ~ .checkmark:after {
        display: block;
    }
    .options .checkmark:after{
        content: "";
        width: 9px;
        height: 9px;
        display: block;
        background: white;
        position: absolute;
        top: 52%;
        left: 51%;
        border-radius: 50%;
        transform: translate(-50%,-50%) scale(0);
        transition: 300ms ease-in-out 0s;
    }
    .options input[type="radio"]:checked ~ .checkmark{
        background: #61b15a;
        transition: 300ms ease-in-out 0s;
    }
    .options input[type="radio"]:checked ~ .checkmark:after{
        transform: translate(-50%,-50%) scale(1);
    }
    .count{
        font-size: 0.8rem;
    }
    label{
        cursor: pointer;
    }
    .tick{
        display: block;
        position: relative;
        padding-left: 23px;
        cursor: pointer;
        font-size: 0.8rem;
        margin: 0;
    }
    .tick input{
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }
    .check{
        position: absolute;
        top: 1px;
        left: 0;
        height: 18px;
        width: 18px;
        background-color: #f8f8f8;
        border: 1px solid #ddd;
        border-radius: 3px;
    }
    .tick:hover input ~ .check {
        background-color: #f3f3f3;
    }
    .tick input:checked ~ .check {
        background-color: #61b15a;
    }
    .check:after {
        content: "";
        position: absolute;
        display: none;
    }
    .tick input:checked ~ .check:after {
        display: block;
        transform: rotate(45deg) scale(1);
    } 
    .tick .check:after {
        left: 6px;
        top: 2px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        transform: rotate(45deg) scale(2);
    }
    #country{
        font-size: 0.8rem;
        border: none;
        border-left: 1px solid #ccc;
        padding: 0px 10px;
        outline: none;
        font-weight: 900;
    }
    .close{
        font-size: 1.2rem;
    }
    div.text-muted{
        font-size: 0.85rem;
    }
    #sidebar{
        width: 25%;
        float: left;
    }
    .category{
        font-size: 0.9rem;
        cursor: pointer;
    }
    .list-group-item{
        border: none;
        padding: 0.3rem 0.4rem 0.3rem 0rem;
    }
    .badge-primary{
        background-color: #defadb;
        color: #48b83e
    }
    .brand .check{
        background-color: #fff;
        top: 3px;
        border: 1px solid #666;
    }
    .brand .tick{
        font-size: 1rem;
        padding-left: 25px;
    }
    .rating .check{
        background-color: #fff;
        border: 1px solid #666;
        top: 0;
    }
    .rating .tick{
        font-size: 0.9rem;
        padding-left: 25px;
    }
    .rating .fas.fa-star{
        color: #ffbb00;
        padding: 0px 3px;
    }
    .brand .tick:hover input ~ .check,
    .rating .tick:hover input ~ .check{
        background-color: #f9f9f9;
    }
    .brand .tick input:checked ~ .check,
    .rating .tick input:checked ~ .check{
        background-color: #61b15a;
    }
    #products{
        width: 75%;
        padding-left: 30px;
        margin: 0;
        float: right;
    }
    .card:hover{
        transform: scale(1.1);
        transition: all 0.5s ease-in-out;
        cursor: pointer;
    }
    .card-body{
        padding: 0.5rem;
    }
    .card-body .description{
        font-size: 0.78rem;
        padding-bottom: 8px;
    }
    div.h6,h6{
        margin: 0;
    }
    .product .fa-star{
        font-size: 0.9rem;
    }
    .rebate{
        font-size: 0.9rem   ;
    }
    .btn.btn-primary{
        background-color: #48b83e;
        color: #fff;
        border: 1px solid #008000;    
        border-radius: 10px;
        font-weight: 800;
    }
    .btn.btn-primary:hover{
        background-color: #48b83ee8;
    }
    .img-p{
        width: 192px;
        height: 132px;
        object-fit: contain;
    }

    .clear{
        clear: both;
    }
    .btn.btn-success{
        visibility: hidden;
    }
    @media(min-width:992px){
        .filter,#mobile-filter{
            display: none;
        }
    }
    @media(min-width:768px) and (max-width:991px){
        .radio, .checkbox {
            padding: 6px 10px;
            width: 49%;
            float: left;
            margin: 5px 5px 5px 0px;
        }
        .filter,#mobile-filter{
            display: none;
        }
    }
    @media(min-width:576px) and (max-width:767px){
        #sidebar{
            width: 35%;
        }
        #products{
            width: 65%;
        }
        .filter,#mobile-filter{
            display: none;
        }
        .h3 + .ml-auto{
            margin: 0;
        }
    }
    @media(max-width:575px){
        .wrapper{
            padding: 10px;
        }
        .h3{
            font-size: 1.3rem;
        }
        #sidebar{
            display: none;
        }
        #products{
            width: 100%;
            float: none;
        }
        #products{
            padding: 0;
        }
        .clear{
            float: left;
            width: 80%;
        }
        .btn.btn-success{
            visibility: visible;
            margin: 10px 0px;
            color: #fff;
            padding: 0.2rem 0.1rem;
            width: 20%;
        } 
        .green-label{
            width: 50%;
        }
        .btn.text-success{
            padding: 0;
        }
        .content,#mobile-filter{
            clear: both;
        }
    }

    .category.active {
            background-color: #FFE084;
        }
</style>