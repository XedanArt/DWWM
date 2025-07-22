<?php
$basePath = "../";
include($basePath . "includes/header.php");
include($basePath . "includes/navbar.php");
?>

<section class="forum-section">
        <div class="forum-topics-container">
            <!-- Contenu principal -->
            <div class="forum-main">
                <div class="forum-title">
                    <div class="forum-title-header">
                      <img src="/assets/images/favicon_ms_00.png" alt="Logo Morning Soul" class="forum-logo">
                      <h2>BIENVENUE SUR MORNING SOUL - FORUM</h2>
                    </div>
                </div>
                <div class="forum-annoucement">
                  <h2>ANNONCE</h2>
                  <p>ANNONCE ANNONCE ANNONCE</p>
                </div>
                <div class="forum-informations">
                  <h2>INFORMATIONS</h2>
                  <ul class="topic-list">
                    <li><a href="#">[Sujet 1] Communauté : Rejoignez le serveur Discord de la communauté !</a></li>
                    <li><a href="#">[Sujet 2] Votes : pour l'ajout de la nouvelle monture [Clôturé] </a></li>
                    <li><a href="#">[Sujet 3] Staff : L'équipe accueil de nouveaux membres </a></li>
                  </ul>
                </div>
                <div class="forum-morningsoul">
                  <h2>MORNING SOUL</h2>
                  <ul class="topic-list">
                    <li><a href="#">[Sujet 1] BUG : JE SUIS BLOQUÉ DANS UN MUR !!!</a></li>
                    <li><a href="#">[Sujet 2] Trop bien le jeu vivement l'Alpha ouverte</a></li>
                    <li><a href="#">[Sujet 3] [MAINTENANCE] : Prévue le 22/07/2025 </a></li>
                  </ul>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="forum-sidebar-container">
                <div class="forum-search">
                    <h2>Rechercher sur le forum</h2>
                    <form action="/recherche" method="post" class="forum-search-form">
                      <input type="text" name="q" placeholder="Rechercher un sujet..." class="forum-search-input">
                      <button type="submit" class="forum-search-button">🔍</button>
                    </form>
                </div>
                <div class="forum-toc">
                    <h2>Table des matières</h2>
                    <p>Liste des sections à insérer ici.</p>
                </div>
                <div class="forum-allcategory">
                    <h2>Derniers sujets créés</h2>
                    <p>Liens vers les catégories à insérer ici.</p>
                </div>
            </div>
        </div>
</section>

<?php include($basePath . "includes/footer.php"); ?>