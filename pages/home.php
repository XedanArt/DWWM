<?php
$basePath = "../";
include($basePath . "includes/header.php");
include($basePath . "includes/navbar.php");
?>

<!-- Conteneur principal de la page -->
<div class="ms-site-wrapper d-flex flex-column min-vh-100">
  <main class="container mt-5 ms-content-wrap flex-grow-1">
    
    <!-- Conteneur Texte + Intro -->
    <div class="text-center mb-5">
      <h1 class="ms-home-header">Morning Soul - Jeu Indépendant</h1>
      <p class="lead ms-home-intro">- Un espace communautaire pour suivre l’évolution du projet -</p>
      <p class="ms-home-intro-scnd">Chaque âme a son histoire...</p>
    </div>

    <div class="row">

      <!-- Support & Aide -->
      <div class="col-md-4 mb-4">
        <div class="card h-100 ms-transparent-card" style="animation-delay: 0.2s;">
          <div class="card-body">
            <h5 class="card-title ms-card-title-custom">Support & Aide</h5>
            <p class="card-text ms-card-text-custom">Des réponses à vos questions, des tutoriels et une équipe prête à vous aider.</p>
            <a href="<?= $basePath ?>contact/support.php" class="btn ms-btn-custom">Support</a>
          </div>
        </div>
      </div>

      <!-- Actualités & Devblogs -->
      <div class="col-md-4 mb-4">
        <div class="card h-100 ms-transparent-card" style="animation-delay: 0.4s;">
          <div class="card-body">
            <h5 class="card-title ms-card-title-custom">Actualités & Devblogs</h5>
            <p class="card-text ms-card-text-custom">Suivez l’évolution du projet, les changelogs et le devblog de l’équipe.</p>
            <a href="<?= $basePath ?>game/discover.php" class="btn ms-btn-custom">Découvrir</a>
          </div>
        </div>
      </div>

      <!-- Forum & Discussions -->
      <div class="col-md-4 mb-4">
        <div class="card h-100 ms-transparent-card" style="animation-delay: 0.6s;">
          <div class="card-body">
            <h5 class="card-title ms-card-title-custom">Forum & Discussions</h5>
            <p class="card-text ms-card-text-custom">Explorez les derniers sujets, participez aux débats ou posez vos questions.</p>
            <a href="<?= $basePath ?>forum/forum.php" class="btn ms-btn-custom">Accéder au Forum</a>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>

<?php include($basePath . "includes/footer.php"); ?>