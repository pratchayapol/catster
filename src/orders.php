<?php
  include 'condb.php';
  session_start();
  if (!isset($_SESSION['username'])) {
      header("location:login.php");
  }
  $sql = "SELECT * FROM orders";
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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Orders</title>
</head>
<body>

    <?php include 'include/sidenav.php'; ?>

    <div class="main">
        <header class="py-3 mb-4 border-bottom">
            <div class="container d-flex flex-wrap justify-content-center">
                <p class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none">
                    <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
                    <span class="fs-4">Orders</span>
                </p>
                <form class="col-12 col-lg-auto mb-3 mb-lg-0" role="search">
                    <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                </form>
            </div>
        </header>
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <table class="table table-hover ms-4">
                    <thead>
                        <tr>
                            <th scope="col">ORDER ID</th>
                            <th scope="col">MEMBER</th>
                            <th scope="col">DATE</th>
                            <th scope="col">TOTAL</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">DETAILS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <th scope="row"><?php echo $row['order_id']; ?></th>
                            <td><?php echo $row['mem_username']; ?></td>
                            <td><?php echo $row['order_date']; ?></td>
                            <td><?php echo $row['order_total']; ?></td>
                            <td><?php echo $row['order_status']; ?></td>
                            <td>
                                <button type="button" class="w3-button w3-amber" data-bs-toggle="modal" data-bs-target="#orderDetails<?php echo $row['order_id']; ?>">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                                <div class="modal fade" id="orderDetails<?php echo $row['order_id']; ?>" tabindex="-1" aria-labelledby="orderDetailsLabel<?php echo $row['order_id']; ?>" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header border-bottom-0">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body text-start p-4">
                                      <h5 class="modal-title text-uppercase mb-5" id="orderDetailsLabel<?php echo $row['order_id']; ?>"><?php echo $row['mem_username']; ?></h5>
                                        <?php 
                                          $order_id = $row['order_id'];
                                          $payment_sql = "SELECT * FROM payment WHERE order_id = '$order_id'";
                                          $payment_result = mysqli_query($conn, $payment_sql);
                                          while($payment_row = mysqli_fetch_assoc($payment_result)){ ?>
                                            <img src="images/<?php echo $payment_row['pay_slip']; ?>" style="width: 480px;">
                                          <?php } ?>
                                        <p class="mb-0">Payment summary</p>
                                        <?php 
                                          $order_details_sql = "SELECT * FROM order_details WHERE order_id = '$order_id'";
                                          $order_details_result = mysqli_query($conn, $order_details_sql);
                                          while ($order_details_row = mysqli_fetch_assoc($order_details_result)) { ?>
                                            <div class="d-flex justify-content-between">
                                              <p class="fw-small mb-0"><?php echo $order_details_row['product_name']; ?> (Qty: <?php echo $order_details_row['quantity']; ?>)</p>
                                              <p class="text-muted mb-0">$<?php echo $order_details_row['sub_total']; ?></p>
                                            </div>
                                        <?php } ?>
                                        <hr class="mt-2 mb-4"
                                          style="height: 0; background-color: transparent; opacity: .75; border-top: 2px dashed #9e9e9e;">
                                        
                                        <!-- Order total -->
                                        <div class="d-flex justify-content-between">
                                          <p class="fw-bold">Total</p>
                                          <p class="fw-bold"><?php echo $row['order_total']; ?></p>
                                        </div>
                                      </div>
                                      <div class="modal-footer d-flex justify-content-center border-top-0 py-4">
                                        <button type="button" class="btn btn-lg mb-1" style="background-color: #FFA931;">
                                          Confirm
                                        </button>
                                        <p></p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
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