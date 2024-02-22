<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5">
                <h1 class="text-center mb-4">Changement d'information</h1>
                <div class="card">
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="champ" class="form-label">Quel jour souhaitez vous modifier :</label>
                                <select name="jour" id="jour" class="form-select">
                                    <?php

                                    use Root\Garageauto\Entity\Horaires;

                                    $horaire = new Horaires;
                                    $horaires = $horaire->getAll();
                                    var_dump($horaires);

                                    foreach ($horaires as $key => $value) {
                                        echo '<option value="' . $value->jour . '">' . $value->getJour();
                                        '</option>';
                                    }

                                    ?>
                                </select>

                            </div>
                            <div class="mb-3">
                                <label for="champ" class="form-label">Selectionez une periode:</label>
                                <select name="heure" id="heure" class="form-select">
                                    <option value="matin">Matin</option>
                                    <option value="soir">Après-Midi</option>
                                </select>

                            </div>
                            <div class="mb-3">
                                <label for="change" class="form-label">Nouvelle valeur :</label>
                                <input type="text" name="change" id="change" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>