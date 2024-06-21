<?php
session_start();
include 'condb.php';

?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <link href="assets/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/fontawesome/css/solid.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5f1b7c0a83.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>แม๊ว</title>
    <style>
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

      input,textarea,
        input[type="radio"] + label,
        input[type="checkbox"] + label:before,
        select option,
        select {
        width: 100%;
        padding: 1em;
        line-height: 1.4;

        border: 1px solid #e5e5e5;
        border-radius: 3px;
        -webkit-transition: 0.35s ease-in-out;
        -moz-transition: 0.35s ease-in-out;
        -o-transition: 0.35s ease-in-out;
        transition: 0.35s ease-in-out;
        transition: all 0.35s ease-in-out;
        }
        input:focus {
        outline: 0;
        border-color: #bd8200;
        }
        input:focus + .input-icon i {
        color: #f0a500;
        }
        input:focus + .input-icon:after {
        border-right-color: #f0a500;
        }
        input[type="radio"] {
        display: none;
        }
        input[type="radio"] + label,
        select {
        display: inline-block;
        width: 50%;
        text-align: center;
        float: left;
        border-radius: 0;
        }
        input[type="radio"] + label:first-of-type {
        border-top-left-radius: 3px;
        border-bottom-left-radius: 3px;
        }
        input[type="radio"] + label:last-of-type {
        border-top-right-radius: 3px;
        border-bottom-right-radius: 3px;
        }
        input[type="radio"] + label i {
        padding-right: 0.4em;
        }
        input[type="radio"]:checked + label,
        input:checked + label:before,
        select:focus,
        select:active {
        background-color: #f0a500;
        color: #fff;
        border-color: #bd8200;
        }
        input[type="checkbox"] {
        display: none;
        }
        input[type="checkbox"] + label {
        position: relative;
        display: block;
        padding-left: 1.6em;
        }
        input[type="checkbox"] + label:before {
        position: absolute;
        top: 0.2em;
        left: 0;
        display: block;
        width: 1em;
        height: 1em;
        padding: 0;
        content: "";
        }
        input[type="checkbox"] + label:after {
        position: absolute;
        top: 0.45em;
        left: 0.2em;
        font-size: 0.8em;
        color: #fff;
        opacity: 0;
        font-family: FontAwesome;
        content: "\f00c";
        }
        input:checked + label:after {
        opacity: 1;
        }
        select {
        height: 3.4em;
        line-height: 2;
        }
        select:first-of-type {
        border-top-left-radius: 3px;
        border-bottom-left-radius: 3px;
        }
        select:last-of-type {
        border-top-right-radius: 3px;
        border-bottom-right-radius: 3px;
        }
        select:focus,
        select:active {
        outline: 0;
        }
        select option {
        background-color: #f0a500;
        color: #fff;
        }
        .input-group {
        margin-bottom: 1em;
        zoom: 1;
        }
        .input-group:before,
        .input-group:after {
        content: "";
        display: table;
        }
        .input-group:after {
        clear: both;
        }
        .input-group-icon {
        position: relative;
        }
        .input-group-icon input {
        padding-left: 4.4em;
        }
        .input-group-icon .input-icon {
        position: absolute;
        top: 0;
        left: 0;
        width: 3.4em;
        height: 3.4em;
        line-height: 3.4em;
        text-align: center;
        pointer-events: none;
        }
        .input-group-icon .input-icon:after {
        position: absolute;
        top: 0.6em;
        bottom: 0.6em;
        left: 3.4em;
        display: block;
        border-right: 1px solid #e5e5e5;
        content: "";
        -webkit-transition: 0.35s ease-in-out;
        -moz-transition: 0.35s ease-in-out;
        -o-transition: 0.35s ease-in-out;
        transition: 0.35s ease-in-out;
        transition: all 0.35s ease-in-out;
        }
        .input-group-icon .input-icon i {
        -webkit-transition: 0.35s ease-in-out;
        -moz-transition: 0.35s ease-in-out;
        -o-transition: 0.35s ease-in-out;
        transition: 0.35s ease-in-out;
        transition: all 0.35s ease-in-out;
        }
    </style>

</head>

<body>
    <?php include 'include/menu.php'; ?>


      <!-- <div class="container" style="margin-top: 80px;">
        <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
            <img class="bd-placeholder-img" width="100%" height="100%" src="images/welcome.png" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <rect width="100%" height="100%" fill="var(--bs-secondary-color)" />
              </svg>
              <div class="container">
                <div class="carousel-caption text-center">
                  <p><a class="btn btn-lg btn-warning w-75" href="#">ADOPT CAT</a></p>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <img class="bd-placeholder-img" width="100%" height="100%" src="images/petshop.png" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <rect width="100%" height="100%" fill="var(--bs-secondary-color)" />
              </img>
              <div class="container" style="background-color: #eee;">
                <div class="carousel-caption text-end">
                  <h1>Catster SHOP</h1>
                  <p>Products for your Catster</p>
                  <p><a class="btn btn-lg btn-warning" href="shop.php">view products &raquo;</a></p>
                </div>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div> -->

    <main>
    <section class="text-center container" style="margin-top: 80px;">
      <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
          <h1 class="fw-light">เหมียวเชลเตอร์หาบ้าน</h1>
          <p class="lead text-body-secondary">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
          <p>
            <a href="#" class="btn btn-primary my-2">รับอุปการะ</a>
            <button class="btn btn-secondary my-2" onclick="$('#exampleModal').modal('show');">แบบฟอร์มแจ้งพบแมวจร</button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แบบฟอร์มแจ้งพบแมวจร</h5>
                  </div>
                  <div class="modal-body">
                    <form>
                        <div class="row">
                        <div class="input-group input-group-icon">
                            <input type="text" placeholder="Full Name">
                            <div class="input-icon">
                            <i class="fa fa-user ms-3"></i>
                            </div>
                        </div>
                        <div class="input-group input-group-icon">
                            <input type="email" placeholder="Email Adress">
                            <div class="input-icon">
                            <i class="fa fa-envelope"></i>
                            </div>
                        </div>
                        <h4>วันที่พบ</h4>
                        <div class="input-group">
                            <div class="col">
                                <input type="date" value="">
                            </div>
                        </div>
                        <h4>รายละเอียด</h4>
                        <div class="input-group">
                            <div class="col">
                                <textarea name="report_desc" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="input-group input-group-icon">
                            <input type="password" placeholder="Password">
                            <div class="input-icon">
                            <i class="fa fa-key"></i>
                            </div>
                        </div>
                    </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </div>
            </div>
          </p>
        </div>
      </div>
    </section>




    <div class="album py-5">
        <div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <div class="col">
            <div class="card shadow-sm">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                <div class="card-body">
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                    </div>
                    <small class="text-body-secondary">9 mins</small>
                </div>
                </div>
            </div>
            </div>


            <div class="col">
            <div class="card shadow-sm">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                <div class="card-body">
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                    </div>
                    <small class="text-body-secondary">9 mins</small>
                </div>
                </div>
            </div>
            </div>

            <div class="col">
            <div class="card shadow-sm">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                <div class="card-body">
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                    </div>
                    <small class="text-body-secondary">9 mins</small>
                </div>
                </div>
            </div>
            </div>

        </div>
        </div>
    </div>

    </main>

    <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
