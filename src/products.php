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
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class="active">
				<a href="admin_manage.php">
					<i class='bx bxs-group' ></i>
					<span class="text">Manage</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="logout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
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
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Manage</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
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
      <h1>พนักงาน</h1>
      <ul class="breadcrumb">
        <li>
          <a href="admin_manage.php" class="active">Manage</a>
        </li>
        <li><i class='bx bx-chevron-right'></i></li>
        <li>
          <a href="employees.php">Employees</a>
        </li>
      </ul>
    </div>
  </div>

  <form id="insertForm" class="form-input" action="insert_product.php" method="POST" enctype="multipart/form-data" style="display: none;">
    <div class="row">
      <div class="col-6">
        <input type="file" name="product_picture">
        <input type="text" name="product_id" id="product_id" placeholder="Product ID">
        <input type="text" name="product_name" id="product_name" placeholder="Product Name">
        <input type="text" name="product_price" id="product_price" placeholder="Price">
        <input type="text" name="product_remain" id="product_remain" placeholder="Remain">
        <select name="type_id" id="type_id">
                            <?php while ($row = mysqli_fetch_assoc($type_result)): ?>
                                <option value="<?php echo htmlspecialchars($row['type_id']); ?>" <?php if ($row['type_id'] == $result['type_id']) echo 'selected'; ?>><?php echo htmlspecialchars($row['type_name']); ?></option>
                            <?php endwhile; ?>
                        </select>
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


  <div class="table-data">
    <div class="order">
      <div class="head">
        <h3>รายชื่อพนักงาน</h3>
        <i class='bx bx-plus' id="toggleFormButton" style="cursor: pointer;">เพิ่ม</i>
        <i class='bx bx-search'></i>
        <i class='bx bx-filter'></i>
      </div>
      <table>
        <thead>
          <tr>
            <th></th>
            <th>#</th>
            <th>Name</th>
            <th>Type</th>
            <th>Manage</th>
          </tr>
        </thead>
        <tbody>
                            <?php if(mysqli_num_rows($product_result) > 0): ?>
                                <?php while($product = mysqli_fetch_assoc($product_result)): ?>
                                    <tr>
                                        <td>
                                            <?php if(!empty($product['product_picture'])): ?>
                                                <img src="images/<?php echo htmlspecialchars($product['product_picture']); ?>" style="width: 50px; height: auto;" alt="Product Picture">
                                            <?php else: ?>
                                                <img src="images/noimage.png" style="width: 50px; height: auto;" alt="No Image">
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($product['product_id']); ?></td>
                                        <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                                        <td><?php echo htmlspecialchars($product['type_name']); ?></td>
                                        <td>
                                            <a href="delete_product.php?product_id=<?php echo htmlspecialchars($product['product_id']); ?>" onclick="return confirm('Are you sure you want to delete this product?');">
                                                <i class="fas fa-trash-alt" style="margin-right: 10px; color: #FFA559;"></i><span style="color: #FFA559;">Delete</span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5"><p class="text-center">No data available</p></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
      </table>
    </div>
  </div>
</main>

<script>
  document.getElementById('toggleFormButton').addEventListener('click', function() {
    var form = document.getElementById('insertForm');
    if (form.style.display === 'none' || form.style.display === '') {
      form.style.display = 'block';
    } else {
      form.style.display = 'none';
    }
  });
</script>

		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	
	

	<script src="assets/js/script_admin.js"></script>
</body>
</html>

<script>
  //Load animation if fields containing data on page load
  $( document ).ready(function() {
    $(".input-login").each(function() { 
      if ($(this).val() != "") {
        $(this).parent().addClass("animation");
      }
    });
  });

  //Add animation when input is focused
  $(".login-input").focus(function(){
    $(this).parent().addClass("animation animation-color");
  });

  //Remove animation(s) when input is no longer focused
  $(".login-input").focusout(function(){
    if($(this).val() === "")
      $(this).parent().removeClass("animation");
    $(this).parent().removeClass("animation-color");
  })
</script>

<style>

    input,
    select {
        margin-bottom: 10px;
        width: 90%;
        height: 40px;
        font-size: 16px;
        transition: border-bottom 0.6s; /* Added transition for consistency */
        border: 1px solid #CCC; /* Added default border for consistency */
        background-color: transparent;
        border-radius: 4px; /* Added border-radius for consistency */
        padding: 8px; /* Added padding for consistency */
    }

    input:focus,
    select:focus {
        outline: none;
        border-color: #FFA559;
        border-bottom: 1px solid #FFA559; /* Adjusted to match input field behavior */
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
    margin-top: 20px; /* Adjust margin as needed */
    text-align: center; /* Center align the button */
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