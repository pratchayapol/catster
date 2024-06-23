<div class="container-fluid px-0" style="background-color: #313131;">
    <div class="row gx-0">
        <div class="col-lg-3 d-none d-lg-block" style="background-color: #313131;">
            <a href="index.php" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                <h1 class="m-0 text-primary text-uppercase">Catster</h1>
            </a>
        </div>
        <div class="col-lg-9">
            <div class="row gx-0 bg-white d-none d-lg-flex">
                <div class="col-lg-7 px-5 text-start">
                    <div class="h-100 d-inline-flex align-items-center py-2 me-4">
                        <i class="fa fa-envelope text-primary me-2"></i>
                        <p class="mb-0">info@kingdomoftigers.com</p>
                    </div>
                    <div class="h-100 d-inline-flex align-items-center py-2">
                        <i class="fa fa-phone-alt text-primary me-2"></i>
                        <p class="mb-0">063-597-4794</p>
                    </div>
                </div>
                <div class="col-lg-5 px-5 text-end">
                    <div class="d-inline-flex align-items-center py-2">
                        <a class="me-3" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="me-3" href=""><i class="fab fa-twitter"></i></a>
                        <a class="me-3" href=""><i class="fab fa-linkedin-in"></i></a>
                        <a class="me-3" href=""><i class="fab fa-instagram"></i></a>
                        <a class="" href=""><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-expand-lg navbar-dark p-3 p-lg-0" style="background-color: #313131;">
                <a href="index.php" class="navbar-brand d-block d-lg-none">
                    <h1 class="m-0 text-primary text-uppercase">Catster</h1>
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="index.php" class="nav-item nav-link active">หน้าแรก</a>
                        <a href="about.php" class="nav-item nav-link">เกี่ยวกับ</a>
                        <a href="shop.php" class="nav-item nav-link">ร้านค้า</a>
                        <a href="catster.php" class="nav-item nav-link">แคทสเตอร์</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">เอกสาร</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="" class="dropdown-item">การขอรับอุปการะแมว</a>
                                <a href="" class="dropdown-item">ใบคำขออนุญาตเลี้ยงสัตว์</a>
                            </div>
                        </div>
                        <a href="contact.php" class="nav-item nav-link">ติดต่อ</a>
                    </div>
                    <?php if (isset($_SESSION['username'])): ?>
                        <div class="d-inline-flex align-items-center" onclick="toggleMenu()">
                            <p class="nav-item nav-link mb-0">ยินดีต้อนรับ, <?php echo $_SESSION['username'] ?></p>
                            <img src="images/mem-1.png" class="user-pic ms-2">
                        </div>
                        <div class="sub-menu-wrap" id="subMenu">
                            <div class="sub-menu">
                                <div class="user-info">
                                    <img src="images/mem-1.png">
                                    <h6>ไอย์ พงษ์สถิตย์พัฒน์</h6>
                                </div>
                                <hr>
                                <a href="#" class="sub-menu-link">
                                    <p>Edit Profile</p>
                                    <span>></span>
                                </a>
                                <a href="#" class="sub-menu-link">
                                    <p>Your Order</p>
                                    <span>></span>
                                </a>
                                <a href="#" class="sub-menu-link">
                                    <p>Change Password</p>
                                    <span>></span>
                                </a>
                                <hr>
                                <a href="logout.php" class="sub-menu-link">
                                    <p>Logout</p>
                                    <span></span>
                                </a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-primary rounded-0 py-4 px-md-5 d-none d-lg-block">เข้าสู่ระบบ / สมัครสมาชิก<i class="fa fa-arrow-right ms-3"></i></a>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
    </div>
</div>

<script>
    function toggleMenu() {
        let subMenu = document.getElementById("subMenu");
        subMenu.classList.toggle("open-menu");
    }
</script>

<style>
    .user-pic {
        width: 40px;
        border-radius: 50%;
        cursor: pointer;
        margin-left: 30px;
        margin-right: 50px;
    }

    .sub-menu-wrap {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        width: 320px;
        max-width: 400px;
        overflow: hidden;
        transition: max-height 0.5s, display 0.5s;
        z-index: 1000;
    }

    .sub-menu-wrap.open-menu {
        display: block;
        max-height: 400px;
    }

    .sub-menu {
        background: #fff;
        padding: 20px;
        margin: 10px 0;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
    }

    .user-info {
        display: flex;
        align-items: center;
    }

    .user-info h6 {
        font-weight: 500;
        margin: 0;
    }

    .user-info img {
        width: 60px;
        border-radius: 50%;
        margin-right: 15px;
    }

    .sub-menu hr {
        border: 0;
        height: 1px;
        width: 100%;
        background: #ccc;
        margin: 15px 0 10px;
    }

    .sub-menu-link {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: #525252;
        margin: 12px 0;
        transition: font-weight 0.3s, transform 0.3s;
    }

    .sub-menu-link p {
        margin: 0;
        flex-grow: 1;
    }

    .sub-menu-link span {
        font-size: 22px;
    }

    .sub-menu-link:hover span {
        transform: translateX(5px);
        color: #FFA559;
    }

    .sub-menu-link:hover p {
        font-weight: 600;
        color: #FFA559;
    }
</style>
