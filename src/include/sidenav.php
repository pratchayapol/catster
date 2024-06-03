<div class="sidenav d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="width: 280px;">
    <a href="admin.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
      <i class="fa-solid fa-user"></i>
      <span class="fs-4 ms-2">Catster</span>
    </a>
    <hr>
    <ul class="list-unstyled ps-0">
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
          <i class="fa-solid fa-palette me-2"></i>Dashboard
        </button>
        <div class="collapse show" id="dashboard-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="admin.php" class="link-body-emphasis d-inline-flex text-decoration-none rounded ms-4"><i class="fa-solid fa-shield-cat me-2"></i>Cats</a></li>
            <li><a href="db_sales.php" class="link-body-emphasis d-inline-flex text-decoration-none rounded ms-4"><i class="fa-solid fa-arrow-trend-up me-2"></i>Sales</a></li>
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
          <i class="fa-solid fa-table-list me-2"></i>Tables
        </button>
        <div class="collapse" id="home-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded ms-4"><i class="fa-solid fa-house me-2"></i>Shelter</a></li>
            <li><a href="employees.php" class="link-body-emphasis d-inline-flex text-decoration-none rounded ms-4"><i class="fa-solid fa-user-group me-2"></i>Employees</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded ms-4"><i class="fa-solid fa-font me-2" ></i>Types</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded ms-4"><i class="fa-solid fa-cubes-stacked me-2"></i>Products</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded ms-4"><i class="fa-solid fa-syringe me-2"></i>Vaccine</a></li>
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <a class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
          <i class="fa-solid fa-list me-2"></i>Orders
        </a>
      </li>
      <li class="mb-1">
        <a href="#" class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
          <i class="fa-solid fa-bullhorn me-2"></i>Reports
        </a>
      </li>
    </ul>
    <hr>
    <div class="dropdown">
      <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="images/logo.png" alt="mdo" width="32" height="32" class="rounded-circle">
        <strong><?php echo $_SESSION['username']; ?></strong>
      </a>
      <ul class="dropdown-menu text-small shadow">
        <li><a class="dropdown-item" href="#">New project...</a></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item text-danger" href="logout.php">Sign out</a></li>
      </ul>
    </div>
  </div>