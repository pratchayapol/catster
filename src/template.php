<?php
    session_start();
    // if(!isset($_SESSION['username'])){
    //     header("location:login.php");
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> หน้าหลัก </title>
    <link rel="icon" type="image/x-icon" href="images/catster.png">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>

    <div class="header" style="background-image: url(images/banner.png);"></div>

        <div id="navbar">
            <a class="active" href="javascript:void(0)">Home</a>
            <a href="javascript:void(0)">Catster</a>
            <a href="javascript:void(0)">Shop</a>
                <?php
                    if(isset($_SESSION['firstname'])){
                        echo "<a href='form_edit_profile.php' style='float: right;'>";
                        echo $_SESSION['firstname'] . " " . $_SESSION['lastname'];
                        echo "</a>";
                    }else{
                        echo "<a href='login.php' style='float: right;'>Login</a>";
                    }
                ?>
        </div>

        <script>
            window.onscroll = function() {myFunction()};

            var navbar = document.getElementById("navbar");
            var sticky = navbar.offsetTop;

            function myFunction() {
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
            } else {
                navbar.classList.remove("sticky");
            }
            }
        </script>

        
    
    </div>


        
    <!-- <div class="container">
        <a href="logout.php"><button type="button" class="btn mt-2" style="background-color: #FFA559;"> ออกจากระบบ </button></a>
    </div> -->
    <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">ระบบสาระสนเทศ &copy;  มหาวิทยาลัยเทคโนโลยีราชมงคลอีสาน วิทยาเขตขอนแก่น</p></div>
        </footer>
</body>

<script type="text/JavaScript">
    $('#footer').load('footer.html')
</script>

</html>

