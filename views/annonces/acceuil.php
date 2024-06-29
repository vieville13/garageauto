<body>
<div class="container mt-5">
    <h2 class="mb-4">Consulter les annonces</h2>
    <div class="row">
        <?php foreach ($annonces as $annonce) { ?>
            <?php var_dump($annonce->getImagesbyIdAnnonce($annonce->id)[0]->getLien())?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="<?php echo htmlspecialchars($annonce->getImagesbyIdAnnonce($annonce->id)[0]->getLien()); ?>" class="card-img-top" alt="Image de l'annonce">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($annonce->getModele()); ?></h5>
                        <p class="card-text">
                            <strong>Kilométrage:</strong> <?php echo htmlspecialchars($annonce->getKilometrage()); ?> km<br>
                            <strong>Année:</strong> <?php echo htmlspecialchars($annonce->getAnnee()); ?><br>
                            <strong>Prix:</strong> <?php echo htmlspecialchars($annonce->getPrix()); ?> €<br>
                            <strong>Description:</strong> <?php echo nl2br(htmlspecialchars($annonce->getCorps())); ?>
                        </p>
                        <a href="index.php?page=annonce&action=view&id=<?php echo $annonce->getId(); ?>" class="btn btn-primary">Voir l'annonce</a>
                        <button type="button" class="btn btn-secondary mt-2" data-toggle="modal" data-target="#messageModal<?php echo $annonce->getId(); ?>">Laisser un message</button>
                    </div>
                </div>
            </div>

            <!-- Modal pour laisser un message -->
            <div class="modal fade" id="messageModal<?php echo $annonce->getId(); ?>" tabindex="-1" aria-labelledby="messageModalLabel<?php echo $annonce->getId(); ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="messageModalLabel<?php echo $annonce->getId(); ?>">Laisser un message</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="index.php?page=message&action=send">
                            <div class="modal-body">
                                <input type="hidden" name="annonceId" value="<?php echo $annonce->getId(); ?>">
                                <div class="form-group">
                                    <label for="message">Message:</label>
                                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-primary">Envoyer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
</body>