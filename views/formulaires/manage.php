
<body>
    <div class="container mt-5">
        <h2 class="text-center">Liste des Formulaires</h2>
        <?php if (!empty($formulaires)) { ?>
            <form action="index.php?page=formulaire&action=delete" method="post">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>N° doss</th>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Numéro de Téléphone</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($formulaires as $formulaire) { ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="formulaire_ids[]" value="<?= htmlspecialchars($formulaire->getId()); ?>">
                                </td>
                                <td><?= htmlspecialchars($formulaire->getNumDossier($formulaire->getIdAnnonce())) ?></td>
                                <td><?= htmlspecialchars($formulaire->getPrenom()); ?></td>
                                <td><?= htmlspecialchars($formulaire->getNom()); ?></td>
                                <td><?= htmlspecialchars($formulaire->getEmail()); ?></td>
                                <td><?= htmlspecialchars($formulaire->getTelephone()); ?></td>
                                <td><?= htmlspecialchars($formulaire->getMessage()); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-danger">Supprimer les formulaires sélectionnés</button>
            </form>
        <?php } else { ?>
            <p class="text-center">Aucun formulaire trouvé.</p>
        <?php } ?>
    </div>
</body>