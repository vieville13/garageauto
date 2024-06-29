<body>
<div class="container mt-5">
    <h2 class="mb-4">Modifier l'annonce</h2>
    <form method="POST" action="../../index.php?page=annonce&action=deleteImages&id=<?php echo $annonce->getId()?>">
        <div class="row">
            <?php foreach ($images as $image) { ?>
                <div class="col-md-3">
                    <div class="card mb-3">
                        <input id="<?php echo $image->getId(); ?>" type="checkbox" name="supprime[]" value="<?php echo $image->getId(); ?>" class="form-check-input"/>
                        <img src="<?php echo htmlspecialchars($image->getLien()); ?>" class="card-img-top" alt="Image <?php echo htmlspecialchars($annonce->getModele()); ?>">
                    </div>
                </div>
            <?php } ?>
        </div>
        <button type="submit" class="btn btn-danger mt-3">Supprimer les images sélectionnées</button>
    </form>

    <form method="POST" id="formAnnonce<?php $annonce->getId() ?>" enctype="multipart/form-data" action="../../index.php?page=annonce&action=update">
        <div class="form-group">>
            <input type="number" class="form-control hidden" id="idAnnnonce" name="idAnnonce" value="<?php $annonce->getId() ?>">
        </div>
        <div class="form-group">
            <label for="modele">Modèle :</label>
            <input type="text" class="form-control" id="modele" name="modele" value="<?php echo htmlspecialchars($annonce->getModele()); ?>" required>
        </div>

        <div class="form-group">
            <label for="kilometrage">Kilométrage :</label>
            <input type="number" class="form-control" id="kilometrage" name="kilometrage" value="<?php echo htmlspecialchars($annonce->getKilometrage()); ?>" required>
        </div>

        <div class="form-group">
            <label for="annee">Année :</label>
            <input type="text" class="form-control" id="annee" name="annee" value="<?php echo htmlspecialchars($annonce->getAnnee()); ?>" required>
        </div>

        <div class="form-group">
            <label for="prix">Prix :</label>
            <input type="number" class="form-control" id="prix" name="prix" value="<?php echo htmlspecialchars($annonce->getPrix()); ?>" required>
        </div>

        <div class="form-group">
            <label for="corps">Corps :</label>
            <textarea class="form-control" id="corps" name="corps" ><?php echo htmlspecialchars($annonce->getCorps()); ?></textarea>
        </div>

        <div class="form-group">
            <label for="numDossier">Numéro de Dossier :</label>
            <input type="text" class="form-control" id="numDossier" name="numDossier" value="<?php echo htmlspecialchars($annonce->getNumDossier()); ?>" required>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="isDiffuse" name="isDiffuse" <?php echo $annonce->isDiffuse() ? 'checked' : ''; ?>
            <label class="form-check-label" for="isDiffuse">Diffuser cette annonce</label>
        </div>
      <div class="form-group">
      <label for="photo">Ajouter des photos :</label>
              <input type="hidden" name="MAX_FILE_SIZE" value="300000">
              <input name="photo1" type="file" class="form-control photo" id="photo1" accept="image/png, image/jpeg" onchange="addFormPhoto(); previewImage();">
          </div>
      <div id="previewImageContainer" class="mt-4"></div>
        <button type="submit" class="btn btn-primary mt-3">Mettre à jour l'annonce</button>
    </form>
    <script>
        function previewImage() {
            const fileInput = document.getElementsByClassName("photo")[document.getElementsByClassName("photo").length - 2];
            const file = fileInput.files[0];
            const imagePreviewContainer = document.getElementById('previewImageContainer');

            if (file.type.match('image.*')) {
                const reader = new FileReader();

                reader.addEventListener('load', function (event) {
                    const imageUrl = event.target.result;
                    const image = new Image();

                    image.addEventListener('load', function () {
                        imagePreviewContainer.appendChild(image);
                    });

                    image.src = imageUrl;
                    image.style.width = '200px';
                    image.style.height = '300px';
                });

                reader.readAsDataURL(file);
            }
        }

        function addFormPhoto() {
            var numberPhoto = document.getElementsByClassName("photo").length + 1;
            var lastImg = document.getElementsByClassName("photo")[document.getElementsByClassName("photo").length - 1];
            if (lastImg.value != "") {
                lastImg.insertAdjacentHTML('afterend', `<div class="form-group"><input name="photo` + numberPhoto + `" type="file" class="form-control photo" id="photo` + numberPhoto + `" accept="image/png, image/jpeg" onchange="addFormPhoto(); previewImage()"></div>`);
                lastImg.classList.add("d-none");
            }
        }

        document.querySelector('#corps').addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
      function 
    </script>
</div>
</body>