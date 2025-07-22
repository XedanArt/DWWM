<?php
$basePath = "../";
include($basePath . "includes/header.php");
include($basePath . "includes/navbar.php");
?>
<section class="social-section">
  <div class="social-container">
    <h2>Suivez-nous sur les réseaux sociaux</h2>
    <p class="social-note">Restez connectés avec nous pour les dernières nouvelles et mises à jour.</p>

    <div class="social-cards">
      <div class="social-card" id="facebook">
        <a href="https://www.facebook.com" target="_blank">
          <i class="fab fa-facebook-f"></i>
          <h3>Facebook</h3>
          <img src="/assets/images/socials_fb_logo.png" alt="Facebook Image">
        </a>
      </div>

      <div class="social-card" id="instagram">
        <a href="https://www.instagram.com" target="_blank">
          <i class="fab fa-instagram"></i>
          <h3>Instagram</h3>
          <img src="/assets/images/socials_insta_logo.png" alt="Instagram Image">
        </a>
      </div>

      <div class="social-card" id="twitter">
        <a href="https://www.twitter.com" target="_blank">
          <i class="fab fa-twitter"></i>
          <h3>Twitter</h3>
          <img src="/assets/images/socials_x_logo.png" alt="Twitter Image">
        </a>
      </div>
    </div>
  </div>
</section>
<?php include($basePath . "includes/footer.php"); ?>