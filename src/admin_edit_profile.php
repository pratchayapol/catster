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
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-11">
                    <hr>
                    <div class="row">
                    <!-- left column -->
                    <div class="col-md-3">
                        <div class="text-center">                        
                        <?php
                            if (isset($row['emp_picture'])) {
                                echo "<img class='avatar img-circle' alt='avatar' style='border-radius: 50%; width: 150px;' src='images/" . $row['emp_picture'] . "'>";
                            }
                        ?>
                        <br><br>
                        <input type="file" class="form-control">
                        </div>
                    </div>
                    
                    <!-- edit form column -->
                    <div class="col-md-9 personal-info">
                        <h3>Personal info</h3>
                        
                        <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">First name:</label>
                            <div class="col-lg-8">
                            <input class="form-control" type="text" value="Jane">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Last name:</label>
                            <div class="col-lg-8">
                            <input class="form-control" type="text" value="Bishop">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Company:</label>
                            <div class="col-lg-8">
                            <input class="form-control" type="text" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Email:</label>
                            <div class="col-lg-8">
                            <input class="form-control" type="text" value="janesemail@gmail.com">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Time Zone:</label>
                            <div class="col-lg-8">
                            <div class="ui-select">
                                <select id="user_time_zone" class="form-control">
                                <option value="Hawaii">(GMT-10:00) Hawaii</option>
                                <option value="Alaska">(GMT-09:00) Alaska</option>
                                <option value="Pacific Time (US &amp; Canada)">(GMT-08:00) Pacific Time (US &amp; Canada)</option>
                                <option value="Arizona">(GMT-07:00) Arizona</option>
                                <option value="Mountain Time (US &amp; Canada)">(GMT-07:00) Mountain Time (US &amp; Canada)</option>
                                <option value="Central Time (US &amp; Canada)" selected="selected">(GMT-06:00) Central Time (US &amp; Canada)</option>
                                <option value="Eastern Time (US &amp; Canada)">(GMT-05:00) Eastern Time (US &amp; Canada)</option>
                                <option value="Indiana (East)">(GMT-05:00) Indiana (East)</option>
                                </select>
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-8">
                            <input type="button" class="btn btn-primary" value="Save Changes">
                            <span></span>
                            <input type="reset" class="btn btn-default" value="Cancel">
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <hr>
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