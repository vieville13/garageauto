<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Consulter les annonces</h2>
        <div class="mb-4">
            <h4>Filtres</h4>
            <form id="filterForm">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="prixMin">Prix Min</label>
                        <input type="number" class="form-control" id="prixMin" placeholder="0">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="prixMax">Prix Max</label>
                        <input type="number" class="form-control" id="prixMax" placeholder="0">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="modele">Modèle</label>
                        <input type="text" class="form-control" id="modele" placeholder="Modèle">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="kilometrageMax">Kilométrage Max</label>
                        <input type="number" class="form-control" id="kilometrageMax" placeholder="Kilométrage Max">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Filtrer</button>
            </form>
        </div>
        <div class="row">
            <?php foreach ($annonces as $annonce) { ?>
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
                            <h5 class="card-title"><?php echo htmlspecialchars($annonce->getModele()); ?></h5>
                            <p class="card-text">
                                <strong>Kilométrage:</strong> <?php echo htmlspecialchars($annonce->getKilometrage()); ?> km<br>
                                <strong>Année:</strong> <?php echo htmlspecialchars($annonce->getAnnee()); ?><br>
                                <strong>Prix:</strong> <?php echo htmlspecialchars($annonce->getPrix()); ?> €<br>
                                <strong>Description:</strong> <?php echo nl2br(htmlspecialchars($annonce->getCorps())); ?>
                            </p>
                            <div class="mt-auto">
                                <a href="index.php?page=formulaire&action=add&id=<?= htmlspecialchars($annonce->getId()); ?>" class="btn btn-primary btn-lg">
                                    Contactez nous
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
        <?php } ?>
        <div class="row" id="annoncesContainer">
        </div>
    </div>
    <script>
        document.getElementById('filterForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const prixMin = document.getElementById('prixMin').value ? parseFloat(document.getElementById('prixMin').value) : undefined;
            const prixMax = document.getElementById('prixMax').value ? parseFloat(document.getElementById('prixMax').value) : undefined;
            const modele = document.getElementById('modele').value ? document.getElementById('modele').value.toLowerCase() : undefined;
            const kilometrageMax = document.getElementById('kilometrageMax').value ? parseFloat(document.getElementById('kilometrageMax').value) : undefined;

            const annonces = document.querySelectorAll('.annonce');
            annonces.forEach(annonce => {
                const annonceModele = annonce.getAttribute('data-modele').toLowerCase();
                const annoncePrix = parseFloat(annonce.getAttribute('data-prix'));
                const annonceKilometrage = parseFloat(annonce.getAttribute('data-kilometrage'));

                let visible = true;

                if (prixMin !== undefined && annoncePrix < prixMin) {
                    visible = false;
                }
                if (prixMax !== undefined && annoncePrix > prixMax) {
                    visible = false;
                }
                if (modele !== undefined && !annonceModele.includes(modele)) {
                    visible = false;
                }
                if (kilometrageMax !== undefined && annonceKilometrage > kilometrageMax) {
                    visible = false;
                }

                annonce.style.display = visible ? 'block' : 'none';
            });
        });
    </script>
</body>