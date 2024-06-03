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
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="assets/fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="assets/fontawesome/css/brands.css" rel="stylesheet" />
    <link href="assets/fontawesome/css/solid.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employees</title>
</head>
<body>

    <?php include 'include/sidenav.php'; ?>

    <div class="main">
        <header class="py-3 mb-4 border-bottom">
            <div class="container d-flex flex-wrap justify-content-center">
                <p class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none">
                    <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
                    <span class="fs-4">Employees</span>
                </p>
                <form class="col-12 col-lg-auto mb-3 mb-lg-0" role="search">
                    <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                </form>
            </div>
        </header>
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <form action="insert_emp.php" method="POST" enctype="multipart/form-data">
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                            <label for="emp_picture" class="form-label">Picture</label>
                            <input type="file" name="emp_picture" class="form-control" id="emp_picture">
                        </div>
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6">
                            <label for="emp_firstname" class="form-label">First Name</label>
                            <input type="text" name="emp_firstname" class="form-control" id="emp_firstname">
                        </div>
                        <div class="col-sm-6">
                            <label for="emp_lastname" class="form-label">Last Name</label>
                            <input type="text" name="emp_lastname" class="form-control" id="emp_lastname">
                        </div>
                        <div class="col-sm-12">
                            <label for="emp_address" class="form-label">Address</label>
                            <textarea rows="3" name="emp_address" class="form-control" id="emp_address"></textarea>
                        </div>
                        <div class="col-sm-6">
                            <label for="emp_email" class="form-label">Email</label>
                            <input type="email" name="emp_email" class="form-control" id="emp_email">
                        </div>
                        <div class="col-sm-6">
                            <label for="emp_tel" class="form-label">Telephone</label>
                            <input type="tel" name="emp_tel" class="form-control" id="emp_tel">
                        </div>
                        <div class="col-sm-6">
                            <label for="emp_username" class="form-label">Username</label>
                            <input type="text" name="emp_username" class="form-control" id="emp_username">
                        </div>
                        <div class="col-sm-6">
                            <label for="emp_password" class="form-label">Password</label>
                            <input type="password" name="emp_password" class="form-control" id="emp_password">
                        </div>
                    </div>
                    <button class="btn btn-success" type="submit">
                        <i class="fa-regular fa-floppy-disk me-1"></i>Save
                    </button>
                    <a class="btn btn-secondary" href="employees.php"><i class="fa-solid fa-angles-left me-1"></i>Cancel</a>
                    <hr class="my-4">
                </form>

                <table class="table table-hover ms-4">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col" style="width: 150px;">First Name</th>
                            <th scope="col" style="width: 150px;">Last Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telephone</th>
                            <th scope="col"></th>
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
                                    <img src="images/<?php echo htmlspecialchars($employee['emp_picture']); ?>" style="width: 100px;" alt="Employee Picture">
                                <?php else: ?>
                                    <img src="images/noimage.png" style="width: 100px;" alt="No Image">
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($employee['emp_firstname']); ?></td>
                            <td><?php echo htmlspecialchars($employee['emp_lastname']); ?></td>
                            <td><?php echo htmlspecialchars($employee['emp_address']); ?></td>
                            <td><?php echo htmlspecialchars($employee['emp_email']); ?></td>
                            <td><?php echo htmlspecialchars($employee['emp_tel']); ?></td>
                            <td>
                                <a role="button" href="delete_emp.php?emp_username=<?php echo htmlspecialchars($employee['emp_username']); ?>" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this employee?');">
                                    <i class="fa-regular fa-trash-can me-1"></i>Delete
                                </a>
                            </td>
                        </tr>
                        <?php 
                                endwhile; 
                            else: 
                        ?>
                        <tr>
                            <td colspan="8"><p class="text-center">No data available</p></td>
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
