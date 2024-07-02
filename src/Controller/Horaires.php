<?php

namespace Root\Garageauto\Controller;

use Root\Garageauto\Views;
use Root\Garageauto\Entity\Horaires as Horaire;

class Horaires
{

    private ?string $page = 'horaires';

    private ?string $action = null;

    public function __construct()
    {
        if (isset($_GET['action'])) {
            $this->action = $_GET['action'];
        }

        if ($this->action == "manage") {

            $this->manage();
        }
    }

    public function manage()
    {
        if ($_SESSION['logged'] !== true || $_SESSION['admin'] !== true) {
            header("Location: index.php");
        }

        $horaire = new Horaire();
        $horaires = $horaire->getAll();

        if (count($_POST) !== 0) {

            $jour = $_POST['jour'];
            $heure = "heure" . $_POST['heure'];
            $change = $_POST['change'];
            foreach ($horaires as $key => $value) {
                if ($value->jour === $jour) {
                    $idToChange = $value->id;
                    $jourToChange = $horaire->getById($idToChange);
                    if ($heure === "heurematin") {
                        $jourToChange->setHeureMatin($change);
                    }
                    if ($heure === "heuresoir") {
                        $jourToChange->setHeureSoir($change);
                    }
                    $jourToChange->update();
                }
            }
        }

        $view = new Views('horaires/manage');
        $view->setVar('page', $this->page);
        $view->render();
    }
}
