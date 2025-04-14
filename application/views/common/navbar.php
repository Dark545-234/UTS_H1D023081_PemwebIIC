<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= base_url() ?>">KAMPUS PUNYA CERITA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= base_url() ?>">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Halaman
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?= base_url('event') ?>">Nama Event</a></li>
            <li><a class="dropdown-item" href="<?= base_url('Pendaftaran') ?>">Pendaftaran</a></li>
          </ul>
        </li>
      </ul>
      <div class="d-flex" role="search">
      <?php if(!$this->session->userdata('user')): ?>
      <ul class="navbar-nav">
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Sign Up
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?= base_url('user/loginPage') ?>">Login</a></li>
            <li><a class="dropdown-item" href="<?= base_url('user/registerPage') ?>">Register</a></li>
          </ul>
        </li>
        </ul>
        <?php else :?>
        <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <b><?= htmlspecialchars($this->session->userdata('user')['email']) ?></b>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?= base_url('user/logout') ?>">Logout</a></li>
          </ul>
          <?php endif; ?>
      </div>
    </div>
  </div>
</nav>