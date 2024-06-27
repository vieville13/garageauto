<main>
    <h2 class="d-flex justify-content-center">Vous êtes connecté en tant que <span onclick="visible()">
            <?php echo $_SESSION['email'] ?></span>
    </h2>

    <div class="d-flex justify-content-center mt-5">
        <a class=" btn btn-danger mr-5" href="index.php?page=annonce&action=add">Ajouter une annonce</a>
    </div>
    <div class="d-flex justify-content-center mt-5">
        <a class=" btn btn-danger mr-5" href="index.php?page=annonce&action=manage">Gérer vos annonces</a>
    </div>
    <?php if ($_SESSION["admin"] == true) {
        echo "
        <div class='d-flex justify-content-center mt-5'>
            <a class='btn btn-danger mr-5' href='index.php?page=horaires&action=manage'>Modifier les horaires d'ouverture</a>
            <a class=' btn btn-danger mr-5' href='index.php?page=users&action=add'>Ajouter un utilisateur</a>;
        </div>";
    }
    var_dump($_SESSION); ?>
</main>