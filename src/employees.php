<?php
  include 'condb.php';
  session_start();
  if (!isset($_SESSION['username'])) {
      header("location:login.php");
  }
  $sql = "SELECT * FROM employees";
  $result = mysqli_query($conn, $sql);
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
				<a href="#" class="logout">
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
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a href="employees.php">Employees</a>
						</li>
					</ul>
				</div>
			</div>

      <div class="table-data">
				<div class="todo">
					<div class="head">
						<h3>Todos</h3>
						<i class='bx bx-plus' >เพิ่ม</i>
					</div>
					<form>

          </form>
				</div>
			</div>

      <div class="table-data">
				<div class="order">
					<div class="head">
						<h3>รายชื่อพนักงาน</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th></th>
								<th>Firstname</th>
								<th>Lastname</th>
                <th>Email</th>
                <th>Manage</th>
							</tr>
						</thead>
						<tbody>
              <?php 
                if(mysqli_num_rows($result) > 0): 
                  while($employee = mysqli_fetch_assoc($result)):
              ?>
							<tr>
								<td>
                  <?php if(!empty($employee['emp_picture'])): ?>
                    <img src="images/<?php echo htmlspecialchars($employee['emp_picture']); ?>" style="width: 50px; height: auto;" alt="Employee Picture">
                  <?php else: ?>
                    <img src="images/noimage.png" style="width: 100px;" alt="No Image">
                  <?php endif; ?>
								</td>
                <td><?php echo htmlspecialchars($employee['emp_firstname']); ?></td>
								<td><?php echo htmlspecialchars($employee['emp_lastname']); ?></td>
								<td><?php echo htmlspecialchars($employee['emp_email']); ?></td>
                <td>
                  <a role="button" href="delete_emp.php?emp_username=<?php echo htmlspecialchars($employee['emp_username']); ?>" onclick="return confirm('Are you sure you want to delete this employee?');">
                    <i class="fa-regular fa-trash-can" style="margin-right: 10px;"></i>Delete
                  </a>
                </td>
							</tr>
              <?php endwhile; ?>
              <?php else: ?>
              <tr>
                <td colspan="8"><p class="text-center">No data available</p></td>
              </tr>
            <?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>

		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	
	

	<script src="assets/js/script_admin.js"></script>
</body>
</html>