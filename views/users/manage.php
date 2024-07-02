<body>
    <div class="container text-center mt-5">
        <h2>Vous êtes connecté en tant que <span class="text-primary"><?php echo $_SESSION['email']; ?></span></h2>

        <div class="d-flex justify-content-center mt-5">
            <h3 class="mr-3">Mes annonces :</h3>
            <a class="btn btn-primary mr-3" href="index.php?page=annonce&action=add">Ajouter une annonce</a>
            <a class="btn btn-primary" href="index.php?page=annonce&action=manage">Gérer vos annonces</a>
        </div>

        <?php if ($_SESSION["admin"] == true): ?>
            <div class="mt-5">
                <h3 class="mb-3">Les horaires :</h3>
                <a class="btn btn-primary mr-3" href="index.php?page=horaires&action=manage">Modifier les horaires d'ouverture</a>
            </div>
            <div class="mt-5">
                <h3 class="mb-3">Les Formulaires :</h3>
                <a class="btn btn-primary mr-3" href="index.php?page=formulaire&action=manage">Voir mes formulaires</a>
            </div>

            <div class="mt-5">
                <h3 class="mb-3">Les utilisateurs :</h3>
                <div class="d-flex justify-content-center">
                    <a class="btn btn-primary mr-3" href="index.php?page=users&action=add">Ajouter un utilisateur</a>
                    <a class="btn btn-primary" href="index.php?page=users&action=delete">Supprimer un utilisateur</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>