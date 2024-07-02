<body>
    <div class="container mt-5">
        <h2 class="text-center">Laisser un message</h2>
        <form action="index.php?page=formulaire&action=add&id=<?= htmlspecialchars($idAnnonce); ?>" method="POST">
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre prénom" required>
            </div>
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Votre email" required>
            </div>
            <div class="form-group">
                <label for="telephone">Numéro de téléphone</label>
                <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Votre numéro de téléphone" required>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" name="message" rows="4" placeholder="Votre message" required></textarea>
            </div>
            <input type="hidden" id="idAnnonce" name="idAnnonce" value="<?= htmlspecialchars($idAnnonce); ?>">
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
</body>