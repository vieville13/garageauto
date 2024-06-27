<footer class="bg-dark text-light py-4 fixed-navbar-bottom">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h5 class="mb-3">Garage V.Parrot</h5>
        <p>Le meilleur site de ventes de voiture d'occasion</p>
      </div>
      <div class="col-md-6">
        <h5 class="mb-3">Liens rapides</h5>
        <ul class="list-unstyled">
          <li><a class="text-light" href="index.php">Accueil</a></li>
        </ul>
      </div>
      <div class="col-md-6">
        <h5 class="mb-3">Horaires d'ouverture</h5>
        <ul class="list-unstyled">
          <?php

          use Root\Garageauto\Entity\Horaires;

          $horaire = new Horaires();
          $horaires = $horaire->getAll();
          var_dump($horaires);
          foreach ($horaires as $key) {
            echo '<li class="text-light">' . $key->getJour() . ' : ' . $key->getHeureMatin() . ', ' . $key->getHeureSoir() . '</li>';
          }
          ?>
        </ul>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col text-center">
        <p class="small">&copy; 2024 GarageVParoot.net Tous droits réservés.</p>
      </div>
    </div>
  </div>
</footer>

</body>

</html>