<main>
    <div class="container">
        <h2>Ajouter une nouvelle annonce</h2>
        <form method="POST" id = "formAnnonce">
            <div class="form-group">
                <label for="numDossier">Numéros de dossier</label>
                <input name="numDossier" type="text" class="form-control" id="numDossier" required>
            </div>
            <div class="form-group">
                <label for="model">Modèle</label>
                <input name="model" type="text" class="form-control" id="model">
            </div>
            <div class="form-group">
                <label for="prix">Prix</label>
                <input name="prix" type="number" class="form-control" id="prix" required>
            </div>
            <div class="form-group">
                <label for="annee">Année</label>
                <input name="annee" type="number" class="form-control" id="annee">
            </div>
            <div class="form-group">
                <label for="kilometrage">Kilometrages</label>
                <input name="kilometrage" type="number" class="form-control" id="kilometrage" required>
            </div>
            <div class="form-group">
                <label for="corps">Description de l'annonce</label>
                <textarea name="corps" style="" type="text" class="form-control" id="corps" ></textarea>
            </div>
            <div> AJoutez des photos
            <div id="previewImageContainer"></div>
            
                <label for="photo">
                <input name="photo1" type="file" class="form-control photo"  id="photo1" accept="image/png, image/jpeg" onchange = "addFormPhoto(); previewImage();">
                </label>
            <button type="submit" class="btn btn-primary">Valider</button>
        </form>
    </div>
    </div>
    <script>
        function previewImage() {
          const fileInput = document.getElementsByClassName("photo")[document.getElementsByClassName("photo").length - 2];
          const file = fileInput.files[0];
          const imagePreviewContainer = document.getElementById('previewImageContainer');

          if(file.type.match('image.*')){
            const reader = new FileReader();

            reader.addEventListener('load', function (event) {
              const imageUrl = event.target.result;
              const image = new Image();

              image.addEventListener('load', function() {
                imagePreviewContainer.appendChild(image);
              });

              image.src = imageUrl;
              image.style.width = '200px';
              image.style.height = '300px';
            });

            reader.readAsDataURL(file);
          }
        }
      function addFormPhoto(){
          var numberPhoto = document.getElementsByClassName("photo").length + 1
          var lastImg =document.getElementsByClassName("photo")[document.getElementsByClassName("photo").length - 1];
          if(lastImg.value != ""){
                       lastImg.insertAdjacentHTML ('afterend',`<div class="form-group">
                           <input name= "photo`+numberPhoto+`"  type="file" class="form-control photo" id="photo`+numberPhoto+`" accept="image/png, image/jpeg" onchange = "addFormPhoto(); previewImage()">
                       </div>`);
              lastImg.classList.add("d-none");
          }
      }
            document.querySelector('#corps').addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
              });
         
       
    </script>
</main>