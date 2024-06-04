<?php
    // Start session
    session_start();

    include 'condb.php';

    // Check database connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if session data exists
    if (isset($_SESSION['username'])) {
        // Get username from session
        $username = $_SESSION['username'];

        // SQL query to retrieve user data based on username
        $sql = "SELECT * FROM employees WHERE emp_username = '$username'";
        $result = $conn->query($sql);

        // Check if user data exists
        if ($result->num_rows > 0) {
            // Fetch user data
            $row = $result->fetch_assoc();

            // Set session variables for first name and last name
            $_SESSION['firstname'] = $row['emp_firstname'];
            $_SESSION['lastname'] = $row['emp_lastname'];
        }
    } else {
        // If session data doesn't exist, display an error message
        echo "Session not found";
    }

    // Close the database connection
    $conn->close();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
    
    <title>Profile</title>
</head>
<body>

    <?php include 'include/sidenav.php'; ?>

    <div class="main">
        <header class="py-3 mb-4 border-bottom">
            <div class="container d-flex flex-wrap justify-content-center">
                <p class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none">
                    <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
                    <span class="fs-4">Profile</span>
                </p>
                <form class="col-12 col-lg-auto mb-3 mb-lg-0" role="search">
                    <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                </form>
            </div>
        </header>
        <div class="container">
          <div class="row">
              <div class="col-12">
                <!-- Form START -->
                <form class="file-upload" action="edit_profile_admin.php" method="POST" enctype="multipart/form-data">
                  <div class="row mb-5 gx-5">
                    <!-- Upload profile -->
                    <div class="col-xxl-4">
                      <div class="bg-secondary-soft px-4 py-5 rounded">
                        <div class="row g-3">
                          <h4 class="mb-4 mt-0">Username : <?php echo $row['emp_username'] ?></h4>
                          <div class="text-center">
                            <!-- Image upload -->
                            <div class="position-relative display-2 mb-3">
                              <img src="images/<?php echo $row['emp_picture'] ?>" style="border-radius: 50%;">
                            </div>
                            <!-- Button -->
                            <input type="hidden" class="form-control" name="current_picture" value="<?php echo isset($row['emp_picture']) ? htmlspecialchars($row['emp_picture']) : ''; ?>">
                            <center><input type="file" id="emp_picture" name="emp_picture" class="form-control"></center>
                            <!-- Content -->
                            <small class="text-muted mt-3 mb-0"><span class="me-1">Note:</span>Minimum size 300px x 300px</small>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Contact detail -->
                    <div class="col-xxl-8 mb-5 mb-xxl-0">
                      <div class="bg-secondary-soft px-4 py-5 rounded">
                        <div class="row g-3">
                          <h4 class="mb-4 mt-0">Contact</h4>
                          <!-- First Name -->
                          <div class="col-md-6">
                            <label class="form-label">Firstname</label>
                            <input type="hidden" class="form-control" name="emp_username" aria-label="Username" value="<?php echo $row['emp_username'] ?>">
                            <input type="text" class="form-control" name="emp_firstname" aria-label="First name" value="<?php echo $row['emp_firstname'] ?>">
                          </div>
                          <!-- Last name -->
                          <div class="col-md-6">
                            <label class="form-label">Lastname</label>
                            <input type="text" class="form-control" name="emp_lastname" aria-label="Last name" value="<?php echo $row['emp_lastname'] ?>">
                          </div>
                          <!-- Phone number -->
                          <div class="col-md-6">
                            <label class="form-label">Phone number</label>
                            <input type="text" class="form-control" name="emp_tel" aria-label="Phone number" value="<?php echo $row['emp_tel'] ?>">
                          </div>
                          <!-- Mobile number -->
                          <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="emp_email" aria-label="Email" value="<?php echo $row['emp_email'] ?>">
                          </div>
                          <!-- Email -->
                          <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">Address</label>
                            <textarea type="text" class="form-control" name="emp_address"><?php echo $row['emp_address'] ?></textarea>
                          </div>
                        </div> <!-- Row END -->
                      </div>

                      <hr>
                      
                      <!-- change password -->
                      <div class="col-xxl-12 text-center">
                        <div class="bg-secondary-soft px-4 py-5 rounded">
                          <div class="row g-3">
                            <h4 class="my-4">Change Password</h4>
                            <input type="hidden" name="emp_password" value="<?php echo $row['emp_password']; ?>">
                            <!-- Old password -->
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                              <label for="currentPassword" class="form-label">Password</label>
                              <input type="password" class="form-control" name="currentPassword">
                            </div>
                            <div class="col-md-2"></div>
                            <!-- New password -->
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                              <label for="newPassword" class="form-label">New password</label>
                              <input type="password" class="form-control" name="newPassword">
                            </div>
                            <div class="col-md-2"></div>
                            <!-- Confirm password -->
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                              <label for="confirmPassword" class="form-label">Confirm Password</label>
                              <input type="password" class="form-control" name="confirmPassword">
                            </div>
                            <div class="col-md-2"></div>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div> <!-- Row END -->

                  </div> <!-- Row END -->
                  <!-- button -->
                  <div class="gap-3 d-md-flex justify-content-center text-center mb-5">
                    <button type="submit" class="btn btn-warning btn-lg w-100">Update</button>
                  </div>
                </form> <!-- Form END -->
              </div>
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

    .account-settings .user-profile {
        margin: 0 0 1rem 0;
        text-align: center;
    }
    .account-settings .user-profile .user-avatar {
        margin: 0 0 1rem 0;
    }
    .account-settings .user-profile .user-avatar img {
        width: 120px;
        height: 120px;
        -webkit-border-radius: 100px;
        -moz-border-radius: 100px;
        border-radius: 100px;
    }
    .account-settings .user-profile h5.user-name {
        margin: 0 0 0.5rem 0;
    }
    .account-settings .user-profile h6.user-email {
        margin: 0;
        font-size: 0.8rem;
        font-weight: 400;
        color: #9fa8b9;
    }
    .account-settings .about {
        margin: 2rem 0 0 0;
        text-align: center;
    }
    .account-settings .about h5 {
        margin: 0 0 15px 0;
        color: #007ae1;
    }
    .account-settings .about p {
        font-size: 0.825rem;
    }

    .card {
        background: #ffffff;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        border: 0;
        margin-bottom: 1rem;
    }

    body{
      color: #9b9ca1;
      }
      .bg-secondary-soft {
          background-color: rgba(208, 212, 217, 0.1) !important;
      }
      .rounded {
          border-radius: 5px !important;
      }
      .py-5 {
          padding-top: 3rem !important;
          padding-bottom: 3rem !important;
      }
      .px-4 {
          padding-right: 1.5rem !important;
          padding-left: 1.5rem !important;
      }
      .file-upload .square {
          height: 250px;
          width: 250px;
          margin: auto;
          vertical-align: middle;
          border: 1px solid #e5dfe4;
          background-color: #fff;
          border-radius: 5px;
      }
      .text-secondary {
          --bs-text-opacity: 1;
          color: rgba(208, 212, 217, 0.5) !important;
      }
      .btn-success-soft {
          color: #28a745;
          background-color: rgba(40, 167, 69, 0.1);
      }
      .btn-danger-soft {
          color: #dc3545;
          background-color: rgba(220, 53, 69, 0.1);
      }

</style>