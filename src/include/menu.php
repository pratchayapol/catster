<?php
    $cart_count = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $quantity) {
            $cart_count += $quantity;
        }
    }
?>

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
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Shop
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="shop.php">All Products</a></li>
            <li><a class="dropdown-item" href="#">Food</a></li>
            <li><a class="dropdown-item" href="#">Toy</a></li>
            <li><a class="dropdown-item" href="#">Item</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Catster</a></li>
          </ul>
        </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i>(<?php echo $cart_count; ?>)</a>
          </li> -->
        </ul>
        <div class="d-flex">
          <?php if(isset($_SESSION['username'])): ?>
            <a class="nav-link" href="form_edit_profile.php">Welcome, <?php echo $_SESSION['username']; ?></a>
          <?php else: ?>
            <a role="button" class="btn btn-outline-warning" href="login.php">sign in</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>
</header>
