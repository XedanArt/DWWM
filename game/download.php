<?php
$basePath = "../";
include($basePath . "includes/header.php");
include($basePath . "includes/navbar.php");
?>

<section class="install-section">
  <div class="install-container">
    <h2>Téléchargez Morning Soul</h2>
    <p class="install-intro">Accédez à la dernière version du jeu et commencez votre aventure.</p>

    <div class="install-block">
      <a href="/assets/downloads/MorningSoul_Setup.exe" class="btn btn-install">Télécharger (Windows)</a>
    </div>

    <div class="system-reqs-dual">
      <div class="system-req-column">
        <h3>Configuration minimale</h3>
        <ul>
          <li><strong>OS :</strong> Microsoft® Windows 10 (64bit)</li>
          <li><strong>Processeur :</strong> Intel Core i3-4340 ou mieux</li>
          <li><strong>Mémoire :</strong> 8 GB RAM</li>
          <li><strong>Graphiques :</strong> Carte compatible OpenGL 4.4</li>
          <li><strong>Stockage :</strong> 8 GB d’espace disponible</li>
          <li><strong>Notes :</strong> Non compatible en environnement virtuel (ex. Nahimic à désactiver)</li>
        </ul>
      </div>

      <div class="system-req-column">
        <h3>Configuration recommandée</h3>
        <ul>
          <li><strong>OS :</strong> Microsoft® Windows 10 (64bit)</li>
          <li><strong>Processeur :</strong> Core i5-8400 / Ryzen 5 1500X ou mieux</li>
          <li><strong>Mémoire :</strong> 16 GB RAM</li>
          <li><strong>Graphiques :</strong> GTX 1650 / Radeon RX570</li>
          <li><strong>Stockage :</strong> 8 GB d’espace disponible</li>
          <li><strong>Notes :</strong> Non compatible en environnement virtuel (ex. Nahimic à désactiver)</li>
        </ul>
      </div>
    </div>

    <div class="install-notes">
      <p><strong>Note :</strong> cette version est une démo jouable, susceptible d’évoluer rapidement. Si vous avez des retours ou des bugs à signaler, <a href="/contact/support.php">contactez le support</a>.</p>
    </div>
  </div>
</section>
<?php include($basePath . "includes/footer.php"); ?>