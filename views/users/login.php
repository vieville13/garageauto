<main>
    <div class="container">
        <h2>Connexion </h2>
        <form method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" id="email" required>
            </div>
            <div class="form-group">
                <label for="mpd">Mot de passe</label>
                <input type="password" name="mdp" class="form-control" id="mdp" required>
            </div>
            <button type="submit" class="btn btn-primary">Valider</button>
            <a href="index.php?page=users&action=add" class="btn btn-danger m-4">S'inscrire</a>
        </form>
    </div>
</main>