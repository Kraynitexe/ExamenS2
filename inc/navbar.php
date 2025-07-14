<?php
require_once "header.php";
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="../pages/index.php">BORROW</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <?php if (isset($_SESSION['nom'])) { ?>
        <span class="navbar-text ms-3 text-white fw-bold">
          <?php echo $_SESSION['nom']; ?>
        </span>
      <?php } ?>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="../pages/index.php">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../inc/deconnexion.php">Deconnexion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="liste.php">Liste des objets</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="formulaire-ajout.php">Ajouter</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/fiche-personne.php">Profil</a>
        </li>
      </ul>
     
    </div>
  </div>
</nav>
