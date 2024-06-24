<?php
include 'condb.php';
if (isset($_GET['type_id'])) {
    $type_id = $_GET['type_id'];
    $sql = "SELECT * FROM product_type WHERE type_id = '$type_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    if (!$row) {
        header('Location: types.php');
        exit;
    }
} else {
    header('Location: types.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="assets/css/admin_style.css">
    <script src="https://kit.fontawesome.com/5f1b7c0a83.js" crossorigin="anonymous"></script>

    <title>AdminHub</title>
</head>

<body>


    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-smile'></i>
            <span class="text">AdminHub</span>
        </a>
        <ul class="side-menu top">
            <li>
                <a href="admin.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="active">
                <a href="admin_manage.php">
                    <i class='bx bxs-group'></i>
                    <span class="text">Manage</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="#">
                    <i class='bx bxs-cog'></i>
                    <span class="text">Settings</span>
                </a>
            </li>
            <li>
                <a href="logout.php" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->



    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <a href="#" class="nav-link">Manage</a>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">8</span>
            </a>
            <a href="#" class="profile">
                <img src="img/people.png">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>ประเภทสินค้า</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="admin_manage.php" class="active">Manage</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a href="types.php" class="active">Product Type</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a href="#">Update</a>
                        </li>
                    </ul>
                </div>
            </div>

            <form class="form-input" action="update_type.php" method="POST">
                <div class="row">
                    <div class="col-6">
                        <input type="text" name="type_id" id="type_id" style="background-color: #CCC;" value="<?php echo htmlspecialchars($row['type_id']); ?>" readonly>
                        <input type="text" name="type_name" id="type_name" value="<?php echo htmlspecialchars($row['type_name']); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="sub-main">
                            <button class="button-two" type="submit"><span>บันทึก</span></button>
                        </div>
                    </div>
                </div>
            </form>
        </main>

        <!-- MAIN -->
    </section>
    <!-- CONTENT -->



    <script src="assets/js/script_admin.js"></script>
</body>

</html>

<script>
    //Load animation if fields containing data on page load
    $(document).ready(function() {
        $(".input-login").each(function() {
            if ($(this).val() != "") {
                $(this).parent().addClass("animation");
            }
        });
    });

    //Add animation when input is focused
    $(".login-input").focus(function() {
        $(this).parent().addClass("animation animation-color");
    });

    //Remove animation(s) when input is no longer focused
    $(".login-input").focusout(function() {
        if ($(this).val() === "")
            $(this).parent().removeClass("animation");
        $(this).parent().removeClass("animation-color");
    })
</script>

<style>
    input,
    select,
    textarea {
        margin-bottom: 10px;
        width: 100%;
        height: 40px;
        font-size: 16px;
        transition: border-bottom 0.6s;
        /* Added transition for consistency */
        border: 1px solid #CCC;
        /* Added default border for consistency */
        background-color: transparent;
        border-radius: 4px;
        /* Added border-radius for consistency */
        padding: 8px;
        /* Added padding for consistency */
    }

    input:focus,
    select:focus,
    textarea:focus {
        outline: none;
        border-color: #FFA559;
        border-bottom: 1px solid #FFA559;
        /* Adjusted to match input field behavior */
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 10px;
    }

    .col-6 {
        flex: 1;
        min-width: 45%;
    }

    .form-input {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: auto;
        margin-top: 20px;
    }

    .form-input h2 {
        margin-bottom: 20px;
        font-size: 24px;
        color: #333;
        text-align: center;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-size: 14px;
        color: #555;
    }

    .form-group button {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        color: #fff;
        cursor: pointer;
    }

    .form-group button:hover {
        background-color: #0056b3;
    }


    .sub-main {
        margin-top: 20px;
        /* Adjust margin as needed */
        text-align: center;
        /* Center align the button */
    }

    .button-two {
        border-radius: 4px;
        background-color: #FFA559;
        font-size: 18px;
        border: none;
        padding: 10px;
        width: 200px;
        transition: all 0.5s;
    }

    .button-two span {
        cursor: pointer;
        display: inline-block;
        position: relative;
        transition: 0.5s;
    }

    .button-two span:after {
        content: '»';
        position: absolute;
        opacity: 0;
        top: 0;
        right: -20px;
        transition: 0.5s;
    }

    .button-two:hover span {
        padding-right: 25px;
    }

    .button-two:hover span:after {
        opacity: 1;
        right: 0;
    }
</style>