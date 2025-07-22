<nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top">
  <div class="container-fluid">
    <!-- Logo -->
    <a class="navbar-brand" href="<?= $basePath ?>pages/home.php">
      <img src="<?= $basePath ?>assets/images/favicon_ms_00.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top logo">
    </a>

    <!-- Bouton burger : visible seulement en mobile -->
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Contenu du menu -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <!-- Menu déroulant Jeu -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle link-custom" href="#" id="siteDropdown" data-bs-toggle="dropdown">Jeu</a>
          <ul class="dropdown-menu dropdown-custom">
            <li><a class="dropdown-item" href="<?= $basePath ?>game/discover.php">Découvrir</a></li>
            <li><a class="dropdown-item" href="<?= $basePath ?>game/download.php">Télécharger</a></li>
          </ul>
        </li>

        <!-- Menu déroulant Contact -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle link-custom" href="#" id="siteDropdown" data-bs-toggle="dropdown">Contact</a>
          <ul class="dropdown-menu dropdown-custom">
            <li><a class="dropdown-item" href="<?= $basePath ?>contact/support.php">Support</a></li>
            <li><a class="dropdown-item" href="<?= $basePath ?>contact/socials.php">Réseaux</a></li>
          </ul>
        </li>

        <!-- Menu déroulant Actualités -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle link-custom" href="#" id="newsDropdown" data-bs-toggle="dropdown">Actualités</a>
          <ul class="dropdown-menu dropdown-custom">
            <li><a class="dropdown-item" href="<?= $basePath ?>news/changelog.php">Changelog</a></li>
            <li><a class="dropdown-item" href="<?= $basePath ?>news/devblog.php">Devblog</a></li>
          </ul>
        </li>

        <!-- Lien Forum -->
        <li class="nav-item">
          <a class="nav-link link-custom" href="<?= $basePath ?>forum/forum.php">Forum</a>
        </li>
      </ul>

      <!-- Bouton Nous Rejoindre -->
      <a class="btn btn-primary custom-login-btn ms-auto" href="/auth/login-register.php">Nous Rejoindre</a>
    </div>
  </div>
</nav>