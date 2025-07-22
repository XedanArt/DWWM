<?php
$basePath = "../";
include($basePath . "includes/header.php");
include($basePath . "includes/navbar.php");
?>

<div class="container mt-5 lr-wrapper">
  <div class="row">
    <!-- Connexion -->
    <div class="col-md-6">
      <div class="card lr-card">
        <div class="card-header lr-card-header">Se connecter</div>
        <div class="card-body lr-card-body">
          <form>
            <div class="mb-3 lr-form-group">
              <label for="loginEmail" class="form-label lr-label">Email</label>
              <input type="email" class="form-control lr-input" id="loginEmail" placeholder="nom@email.com">
            </div>
            <div class="mb-3 lr-form-group">
              <label for="loginPassword" class="form-label lr-label">Mot de passe</label>
              <input type="password" class="form-control lr-input" id="loginPassword" placeholder="Mot de passe">
            </div>
            <button type="submit" class="btn btn-primary w-100 lr-btn">Connexion</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Inscription -->
    <div class="col-md-6">
      <div class="card lr-card">
        <div class="card-header lr-card-header">S'inscrire</div>
        <div class="card-body lr-card-body">
          <form>
            <div class="mb-3 lr-form-group">
              <label for="registerEmail" class="form-label lr-label">Email</label>
              <input type="email" class="form-control lr-input" id="registerEmail" placeholder="nom@email.com">
            </div>
            <div class="mb-3 lr-form-group">
              <label for="registerPassword" class="form-label lr-label">Mot de passe</label>
              <input type="password" class="form-control lr-input" id="registerPassword" placeholder="Mot de passe">
            </div>
            <div class="mb-3 lr-form-group">
              <label for="confirmPassword" class="form-label lr-label">Confirmer le mot de passe</label>
              <input type="password" class="form-control lr-input" id="confirmPassword" placeholder="Confirmer">
            </div>
            <button type="submit" class="btn btn-success w-100 lr-btn">Inscription</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include($basePath . "includes/footer.php"); ?>