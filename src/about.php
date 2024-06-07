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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bai+Jamjuree:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <title>เกี่ยวกับ</title>
    <style>

        body {
                font-family: "Bai Jamjuree", sans-serif;
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
    </style>
</head>

<body>
    <?php include 'include/menu.php'; ?>

    <main class="container" style="margin-top: 100px;">

    <div class="row mb-2">
        <div class="col-md-6">
          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
              <div class="col p-4 d-flex flex-column position-static">
              <strong class="d-inline-block mb-2 text-primary-emphasis">Adopt</strong>
              <h3 class="mb-0">Head</h3>
              <div class="mb-1 text-body-secondary"></div>
              <p class="card-text mb-auto">Description</p>
              <a href="cat_list.php" class="icon-link gap-1 icon-link-hover stretched-link">
                  Cat List >>
              </a>
              </div>
              <div class="col-auto d-none d-lg-block">
              <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
              </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
              <div class="col p-4 d-flex flex-column position-static">
              <strong class="d-inline-block mb-2 text-success-emphasis">Report</strong>
              <h3 class="mb-0">Head</h3>
              <div class="mb-1 text-body-secondary"></div>
              <p class="mb-auto">Description</p>
              <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
                  Donation >>
              </a>
              </div>
              <div class="col-auto d-none d-lg-block">
              <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
              </div>
          </div>
        </div>
    </div>

    <div class="row g-5">
        <div class="col-md-8">
            <h3 class="pb-4 mb-4 fst-italic border-bottom">
                ประวัติ
            </h3>

            <article class="blog-post">
                <h2 class="display-5 link-body-emphasis mb-3">Catster by Kingdom of Tigers</h2>
                <p>ถูกก่อตั้งขึ้นโดยอินฟลูเอนเซอร์เจ้าของแมวบ้านทูนหัวของบ่าว หรือ เพจ Kingdom of Tigers เพื่อที่จะสร้างสถานที่พักพิงให้แมวจรก่อนที่จะเจ้าแมวเหล่านี้จะถูกรับไปเลี้ยงในบ้านที่อบอุ่น ก่อนจะเข้าสู่ Catster และหาบ้าน เจ้าเหมียวเหล่านี้จะได้รับการตรวจร่างกาย ทำวัคซีนพื้นฐานเพื่อสุขภาพที่สมบูรณ์และป้องกันการเกิดโรคติดต่อ รวมเข้ารับการผ่าตัดทำหมันเมื่อถึงวัยไม่ว่าจะเป็นตัวผู้หรือตัวเมีย เพื่อควบคุมปริมาณแมว รวมทั้งเพื่อลดพฤติกรรมก้าวร้าวที่อาจเกิดขึ้นได้ในแมวหนุ่ม นำไปสู่การต่อสู้และบาดเจ็บ
                หลังจากเจ้าเหมียวผ่านขั้นตอนเหล่านี้แล้วก็พร้อมย้ายเข้าไปยัง Catster ที่เป็นทั้งสถานที่พักพิงและคาเฟ่แมวจร เพื่อรอพบเพื่อนใหม่และผู้ที่สนใจเข้ามาอุปการะหรือทำความรู้จักแมว</p>
                <center><img src="images/c1.jpg" style="widht: 720; height: 540px; border-radius: 10%"></center>
            </article>
            <article class="blog-post mt-5">
                <h2 class="display-5 link-body-emphasis mb-3">ภารกิจของ Catster</h2>
                <p>Catster มีความตั้งใจที่จะลดจำนวนแมวจรลงอย่างยุ่งยืน ผ่านการทำงานในรูปแบบของบ้านพักแมวจรที่สามารถอุปการะได้ ก่อนเจ้าเหมียวกลุ่มใหม่จะเข้าไปอยู่ร่วมกับเพื่อน ๆ แมวใน Catster นั้นต้องผ่านการตรวจเลือดเพื่อหาโรคติดต่อ และได้รับวัคป้องกันโรคซีนพื้นฐาน และหากเป็นแมวที่ก้าวเข้าสู่วัยรุ่นหรือแมวโตก็จะต้องรับการผ่าตัดเพื่อทำหมันเพื่อลดพฤติกรรมก้าวร้าว การปัสสาวะเพื่อสร้างอาณาเขต รวมถึงควบคุมปริมาณแมว</p>
                <p>การดูแลแมวพื้นฐาน 1 ตัวโดยประมาณประกอบด้วย</p>
                <ul>
                  <li>ค่าตรวจเลือดหาเอดส์ ลิวคีเมีย 600 บาท</li>
                  <li>วัคซีนพื้นฐาน (พิษสุนัขบ้า, ไวรัสไข้หัดแมว, เฮอร์ปีส์ไวรัส-1, แคลิซิไวรัสแมว) 400 บาท</li>
                  <li>ถ่ายพยาธิ หยอดเห็บหมัด 500 บาท</li>
                  <li>ทำหมัน 1,500-1,700 บาท</li>
                  <strong>รวม 3,000 บาทต่อแมว 1 ตัว</strong>
                </ul>
                <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
                  <div class="col-lg-12 px-0">
                  <h1 class="display-4 fst-italic" style="font-size: 40px">มอบคุณภาพชีวิตที่ดีให้เจ้าเหมียว,</h1>
                  <p class="lead my-3"> ทุก 3,000 บาท จะนำไปสนับสนุนวัคซีนพื้นฐานและการทำหมันแมวจร</p>
                  <p class="lead mb-0 text-end"><a href="#" class="text-body-emphasis fw-bold">ร่วมบริจาคเงินสมทบทุนได้ที่นี่</a></p>
                  </div>
              </div>
            </article>

        </div>

        <div class="col-md-4">
            <div class="position-sticky" style="top: 2rem;">
                <div class="p-4 mb-3 bg-body-tertiary rounded">
                <h4 class="fst-italic">About</h4>
                <p class="mb-0">Customize this section to tell your visitors a little bit about your publication, writers, content, or something else entirely. Totally up to you.</p>
                </div>

                <div>
                <h4 class="fst-italic">Recent posts</h4>
                <ul class="list-unstyled">
                    <li>
                    <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top" href="#">
                        <svg class="bd-placeholder-img" width="100%" height="96" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>
                        <div class="col-lg-8">
                        <h6 class="mb-0">Example blog post title</h6>
                        <small class="text-body-secondary">January 15, 2024</small>
                        </div>
                    </a>
                    </li>
                </ul>
                </div>
            </div>
        </div>
    </div>

    </main>

    <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
