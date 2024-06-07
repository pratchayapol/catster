<?php
    $cart_count = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $quantity) {
            $cart_count += $quantity;
        }
    }
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bai+Jamjuree:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

<header data-bs-theme="light">
  <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
        <img src="images/logo.png" alt="Catster" width="40" height="40">
        </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" style="color: #5C3D2E;" href="index.php"><strong>Catster</strong></a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" aria-current="page" style="color: #5C3D2E;" href="cat_list.php">Cats</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" style="color: #5C3D2E;" href="shop.php">Shop</a>
          </li> -->
        </ul>
        <div class="d-flex">
          <?php if(isset($_SESSION['username'])): ?>
            <a class="nav-link" href="form_edit_profile.php">Welcome, <?php echo $_SESSION['username']; ?></a>
          <?php else: ?>
            <a role="button" class="btn btn-outline-light" style="color: #5C3D2E;" href="login.php">sign in</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>
</header>

<style>
    body {
          font-family: "Bai Jamjuree", sans-serif;
      }
      nav {
    background: linear-gradient(125deg, #D79771, #D79771);
    }
</style>