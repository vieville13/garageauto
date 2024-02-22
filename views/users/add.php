<main>
    <div class="container">
        <h2>Ajouter un nouvel utilisateur</h2>
        <form method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input name="email" type="email" class="form-control" id="email" required>
            </div>
            <div class="form-group">
                <label for="mdp">Mot de Passe</label>
                <input name="mdp" type="password" class="form-control" id="mdp" required>
            </div>
            <button type="submit" class="btn btn-primary">Valider</button>
        </form>
    </div>
</main>