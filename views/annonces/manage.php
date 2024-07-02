<main>
  <h1>Gérer vos annonces</h1>
  <h2>Vos Annonces diffusé</h2>

  <div class="row">
  <?php foreach ($annoncesDiffusees as $annonce) {
    if (isset($_SESSION['admin']) && $_SESSION['admin'] == true || isset($_SESSION['id']) && $annonce->getIdUser() ===$_SESSION['id']) { ?>
        
      <div class="col-md-6 mb-6 annonce" data-modele="<?= htmlspecialchars($annonce->getModele()) ?>" data-prix="<?= htmlspecialchars($annonce->getPrix()) ?>" 
          data-kilometrage="<?= htmlspecialchars($annonce->getKilometrage()) ?>">
          <div class="card shadow-sm">
              <?php
              $images = $annonce->getImagesbyIdAnnonce($annonce->id);
              $imageLien = 'upload/default.jpg';
              if (!empty($images) && isset($images[0])) {
                  $imageLien = htmlspecialchars($images[0]->getLien());
              }
              ?>
              <img src="<?php echo $imageLien; ?>" class="card-img-top" alt="Image de l'annonce">
              <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Numero de dossier : <?php echo htmlspecialchars($annonce->getNumDossier()); ?></h5>
                    <p class="card-text">
                      <strong>Modele:</strong> <?php echo htmlspecialchars($annonce->getModele()); ?><br>
                      <strong>Kilométrage:</strong> <?php echo htmlspecialchars($annonce->getKilometrage()); ?> km<br>
                      <strong>Année:</strong> <?php echo htmlspecialchars($annonce->getAnnee()); ?><br>
                      <strong>Prix:</strong> <?php echo htmlspecialchars($annonce->getPrix()); ?> €<br>
                      <strong>Description:</strong> <?php echo nl2br(htmlspecialchars($annonce->getCorps())); ?>
                  </p>
                  <div class="mt-4">
                      <a href="index.php?page=annonce&action=modify&id=<?php echo $annonce->getId(); ?>" class="btn btn-primary btn-block">Voir l'annonce</a>
                  </div>
                  <div class="mt-4">
                        <a href="index.php?page=annonce&action=delete&id=<?php echo $annonce->getId(); ?>" class="btn btn-primary btn-block">Supprimer l'annonce</a>
                    </div>
              </div>
          </div>
      </div>
<?php } } ?>
  <h2>Vos Annonces non diffusé</h2>

    <?php foreach ($annoncesNonDiffusees as $annonce) {
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == true || isset($_SESSION['id']) && $annonce->getIdUser() ===$_SESSION['id']) { ?>

          <div class="col-md-6 mb-6 annonce" data-modele="<?= htmlspecialchars($annonce->getModele()) ?>" data-prix="<?= htmlspecialchars($annonce->getPrix()) ?>" 
              data-kilometrage="<?= htmlspecialchars($annonce->getKilometrage()) ?>">
              <div class="card shadow-sm">
                  <?php
                  $images = $annonce->getImagesbyIdAnnonce($annonce->id);
                  $imageLien = 'upload/default.jpg';
                  if (!empty($images) && isset($images[0])) {
                      $imageLien = htmlspecialchars($images[0]->getLien());
                  }
                  ?>
                  <img src="<?php echo $imageLien; ?>" class="card-img-top" alt="Image de l'annonce">
                  <div class="card-body d-flex flex-column">
                      <h5 class="card-title">Numero de dossier :<?php echo htmlspecialchars($annonce->getNumDossier()); ?></h5>
                      <p class="card-text">
                          <strong>Modele:</strong> <?php echo htmlspecialchars($annonce->getModele()); ?><br>
                          <strong>Kilométrage:</strong> <?php echo htmlspecialchars($annonce->getKilometrage()); ?> km<br>
                          <strong>Année:</strong> <?php echo htmlspecialchars($annonce->getAnnee()); ?><br>
                          <strong>Prix:</strong> <?php echo htmlspecialchars($annonce->getPrix()); ?> €<br>
                          <strong>Description:</strong> <?php echo nl2br(htmlspecialchars($annonce->getCorps())); ?>
                      </p>
                      <div class="mt-auto">
                          <a href="index.php?page=annonce&action=modify&id=<?php echo $annonce->getId(); ?>" class="btn btn-primary btn-block">Voir l'annonce</a>
                      </div>
                      <div class="mt-4">
                                  <a href="index.php?page=annonce&action=delete&id=<?php echo $annonce->getId(); ?>" class="btn btn-primary btn-block">Supprimer l'annonce</a>
                              </div>
                        </div>
                  </div>
              </div>
          </div>
    <?php } } ?>
</main>