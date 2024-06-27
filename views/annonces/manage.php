<main>
  <h1>Gérer vos annonces</h1>
  <h2>Vos Annonces diffusé</h2>

  <?php foreach ($annoncesNonDiffusees as $annonce) { ?>
    <div class="card">
      <div class="card-header">
        Numéro de dossier: <?= $annonce->getNumDossier() ?>
      </div>
      <div class="card-body">
        <h5 class="card-title"><?= $annonce->getModele() ?></h5>
        <?php
        $images = $annonce->getImagesbyIdAnnonce($annonce->getId());
        // Affiche les images directement dans le HTML
        foreach ($images as $photo) {
          echo "<img src='{$photo->getLien()}' class='card-img-top'>";
        }
        ?>
        <p class="card-text"><?= $annonce->getCorps() ?>.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  <?php } ?>
 
</main>