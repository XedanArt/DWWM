<?php
  $basePath = "../";
  include($basePath . "includes/header.php");
  include($basePath . "includes/navbar.php");
?>

<div class="container changelog-main-container my-5">
  <div class="row">

    <!-- Section principale -->
    <div class="col-lg-8 changelog-patchs-container">

      <!-- Titre principal -->
      <div class="changelog-title mb-4">
        <h1>NOTES DE MISE À JOUR</h1>
      </div>

      <!-- Dernier patch mis en avant -->
      <div class="changelog-last-patch mb-5" id="entry-2025-07-20">
        <div class="changelog-last-title text-center">
          <h2>MÀJ 1.5 : 20/07/2025 : Post-Production</h2>
        </div>
        <div class="changelog-last-image-wrapper">
          <img src="/assets/images/changelog_01.png" alt="Dernier patch illustration" class="changelog-last-image">
          <div class="changelog-last-content">
            <h4>20 juillet 2025</h4>
            <p><strong>Ajout :</strong> Création du site et de la BDD</p>
            <p><strong>Correction :</strong> Problème d'affichage sur mobile réglé (responsive)</p>
          </div>
        </div>
      </div>

      <!-- Liste des patchs précédents -->
      <div class="changelog-patch-list">
        <div class="patch-entry mb-4" id="entry-2025-07-17">
          <h5>MÀJ 1.4 - 17 juillet 2025</h5>
          <p><strong>Changelog :</strong> Rajout d'une classe</p>
        </div>
        <div class="patch-entry mb-4" id="entry-2025-07-15">
          <h5>MÀJ 1.3 - 15 juillet 2025</h5>
          <p><strong>Changelog :</strong> Modification du système d'inventaire</p>
        </div>
        <div class="patch-entry mb-4" id="entry-2025-07-12">
          <h5>MÀJ 1.2 - 12 juillet 2025</h5>
          <p><strong>Changelog :</strong> Ajout des icônes</p>
        </div>
        <div class="patch-entry mb-4" id="entry-2025-07-15">
          <h5>MÀJ 1.3 - 15 juillet 2025</h5>
          <p><strong>Changelog :</strong> Modification du système d'inventaire</p>
        </div>
        <div class="patch-entry mb-4" id="entry-2025-07-12">
          <h5>MÀJ 1.2 - 12 juillet 2025</h5>
          <p><strong>Changelog :</strong> Ajout des icônes</p>
        </div>
      </div>

      <!-- Pagination -->
      <div class="changelog-pagination">
        <a href="#">«</a>
        <a href="#" class="active">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">»</a>
      </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4 changelog-sidebar-container">
      <div class="changelog-patch-nav">
        <h5>Correctifs</h5>
        <div class="changelog-patch-items-container">
          <a class="changelog-patch-items" href="#entry-2025-07-31">MÀJ - 1.10 : 31/07/2025</a><br>
          <a class="changelog-patch-items" href="#entry-2025-07-30">MÀJ - 1.9 :  30/07/2025</a><br>
          <a class="changelog-patch-items" href="#entry-2025-07-29">MÀJ - 1.8 :  29/07/2025</a><br>
          <a class="changelog-patch-items" href="#entry-2025-07-28">MÀJ - 1.7 :  28/07/2025</a><br>
          <a class="changelog-patch-items" href="#entry-2025-07-27">MÀJ - 1.6 :  27/07/2025</a><br>
          <a class="changelog-patch-items" href="#entry-2025-07-26">MÀJ - 1.5 :  26/07/2025</a><br>
          <a class="changelog-patch-items" href="#entry-2025-07-25">MÀJ - 1.4 :  25/07/2025</a><br>
          <a class="changelog-patch-items" href="#entry-2025-07-24">MÀJ - 1.3 :  24/07/2025</a><br>
          <a class="changelog-patch-items" href="#entry-2025-07-23">MÀJ - 1.2 :  23/07/2025</a><br>
          <a class="changelog-patch-items" href="#entry-2025-07-22">MÀJ - 1.1 :  22/07/2025</a><br>
        </div>
      </div>
    </div>

  </div>
</div>

<?php include($basePath . "includes/footer.php"); ?>