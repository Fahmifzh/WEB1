<nav class="navbar navbar-expand-lg bg-light shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="<?= BASE_URL ?>index.php">
      <img src="<?= BASE_URL ?>assets/img/logo.png" alt="Logo" width="30" height="30"
           class="d-inline-block align-text-top me-1">
      SweetSip Studio
    </a>

    <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">

        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL ?>index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL ?>index.php#resep">Resep</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL ?>index.php#about">Tentang Kami</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL ?>index.php#contact">Kontak</a>
        </li>

        <?php if (!isset($_SESSION['login'])): ?>
          <!-- GUEST -->
          <li class="nav-item ms-lg-3">
            <a class="btn btn-outline-secondary btn-sm me-2"
               href="<?= BASE_URL ?>auth/login.php">
              Login
            </a>
          </li>
          <li class="nav-item">
            <a class="btn btn-aesthetic btn-sm"
               href="<?= BASE_URL ?>auth/register.php">
              Register
            </a>
          </li>

        <?php elseif ($_SESSION['role'] === 'user'): ?>
          <!-- USER -->
          <li class="nav-item ms-lg-3">
            <a class="btn btn-outline-secondary btn-sm me-2"
               href="<?= BASE_URL ?>user/dashboard.php">
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="btn btn-aesthetic btn-sm me-2"
               href="<?= BASE_URL ?>user/favorit.php">
              ❤️ Favorit
            </a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-danger btn-sm"
               href="<?= BASE_URL ?>auth/logout.php">
              Logout
            </a>
          </li>

        <?php elseif ($_SESSION['role'] === 'admin'): ?>
          <!-- ADMIN -->
          <li class="nav-item ms-lg-3">
            <a class="btn btn-outline-secondary btn-sm me-2"
               href="<?= BASE_URL ?>admin/dashboard.php">
              Dashboard Admin
            </a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-danger btn-sm"
               href="<?= BASE_URL ?>auth/logout.php">
              Logout
            </a>
          </li>
        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>
