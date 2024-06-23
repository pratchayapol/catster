<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Catster - แจ้งพบแมวจร</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">  

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

</head>

<body style="background-color: #fff;">
    <!-- Header -->
    <?php include('include/header.php'); ?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-2 p-0" style="background-image: url(img/carousel-1.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center pb-5">
                <h1 class="display-3 text-white mb-3 animated slideInDown">แจ้งพบแคทสเตอร์</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">แจ้งพบ</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Team Start -->
        <div class="container-xxl py-5 mb-5">
            <div class="container mb-5">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">Reprot</h6>
                    <h1 class="mb-5">แจ้งพบ <span class="text-primary text-uppercase">แคทสเตอร์</span></h1>
                </div>
                <div class="row g-4">
                    <div class="w3-container">
                        <div class="w3-bar w3-black" style="background-color: #313131;">
                            <button class="w3-bar-item w3-button tablink w3-orange" onclick="openType(event,'pets')">เคยมีบ้าน</button>
                            <button class="w3-bar-item w3-button tablink" onclick="openType(event,'stray')">จรแต่เกิด</button>
                        </div>
                        
                        <div id="pets" class="w3-container w3-border type" style="margin-bottom: 150px;">
                            <h2 class="mt-3">ข้อมูลเบื้องต้น</h2>
                            <p>โปรดกรอกข้อมูลตามความเป็นจริงเพื่อประโยชน์และความปลอดภัยของแคทสเตอร์<span style="color: red;"> *</span></p>
                            <form>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="file">
                                    </div>
                                    <div class="col-6">
                                        <div class="control">
                                            <input class="input mb-1" type="text" placeholder="Text input">
                                            <input class="input" type="text" placeholder="Text input">
                                            <input class="input" type="text" placeholder="Text input">
                                            <input class="input" type="text" placeholder="Text input">
                                            <input class="input" type="text" placeholder="Text input">
                                            <input class="input" type="text" placeholder="Text input">
                                            <input class="input" type="text" placeholder="Text input">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div id="stray" class="w3-container w3-border type" style="display:none">
                            <h2>Paris</h2>
                            <p>Paris is the capital of France.</p> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team End -->

        <script>
            function openType(evt, catType) {
            var i, x, tablinks;
            x = document.getElementsByClassName("type");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < x.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" w3-orange", "");
            }
            document.getElementById(catType).style.display = "block";
            evt.currentTarget.className += " w3-orange";
            }
        </script>


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    
    <!-- Footer -->
    <?php include('include/footer.php') ?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>