<?php

namespace Root\Garageauto\Controller;

use Root\Garageauto\Views;
use Root\Garageauto\Entity\Annonces as Annonce;
use Root\Garageauto\Entity\Users;
use Root\Garageauto\Entity\Images;

class Annonces
{
    private string $page = 'annonce';
    private ?string $action = null;

    public function __construct()
    {
        $this->action = isset($_GET['action']) ? $_GET['action'] : null;
        $loggedIn = isset($_SESSION['logged']) ? $_SESSION['logged'] : false;
        switch (true) {
            
            case $this->action === 'manage' && $loggedIn:
                $this->manage();
                break;
            case $this->action === 'add' && $loggedIn:
                $this->add();
                break;
            case $this->action === 'update' && $loggedIn:
            $this->update();
            break;
            // default:
            //     $this->acceuil();
            //     break;
        }
    }

    // Affiche la page add.php et permet de créer un nouvel utilisateur et le connecte
    // et test si le mail et pseudo ne sont pas déjà utilisés
    // Attention un pseudo avec ou sans majuscule sera considéré comme identique
    public function add()
    {
        $view = new Views('annonces/add');
        $view->setVar('page', $this->page);
        $view->render();
    }

    public function manage()
    {   var_dump($_POST);
        $this->formManager();
        $annonce = new Annonce();
        $annonces = $annonce->getAll();
        $annoncesDiffusees = [];
        $annoncesNonDiffusees = [];
        $image = new Images();

        foreach ($annonces as $annonce) {
            if ($annonce->isDiffuse()) {
                $annoncesDiffusees[] = $annonce;
            } else {
                $annoncesNonDiffusees[] = $annonce;
            }
        }

        if ($_FILES !== null) {
            $filesArray = [];
            if (isset($_FILES['photo1']) && $_FILES["photo1"]["name"] !== "") {
                $filesArray[] = $_FILES['photo1'];
                $i = 2;
                while (isset($_FILES['photo' . $i])) {
                    $filesArray[] = $_FILES['photo' . $i];
                    $i++;
                }
                if ($filesArray[count($filesArray) - 1]["name"] == "") {
                    array_pop($filesArray);
                }
                foreach ($filesArray as $file) {
                    // Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
                    if (isset($file) && $file['error'] == 0) {
                        // Testons si le fichier n'est pas trop gros
                        if ($file['size'] <= 3145728) {
                            // Testons si l'extension est autorisée
                            $infosfichier = pathinfo($file['name']);
                            $extension_upload = $infosfichier['extension'];
                            $extensions_autorisees = ['jpg', 'jpeg', 'gif', 'png'];
                            if (in_array($extension_upload, $extensions_autorisees)) {
                                // On peut valider le fichier et le stocker définitivement
                                move_uploaded_file($file['tmp_name'], 'upload/' . basename($file['name']));
                                $state = "L'envoi a bien été effectué !";
                                $image = new Images();
                                $image->setIdAnnonce($annonce->getIdByModeleKilometrageAnnee(
                                    $annonce->getModele(),
                                    $annonce->getKilometrage(),
                                    $annonce->getAnnee()
                                ));
                                $image->setLien('upload/' . $file['name']);
                                $image->setIsMiseEnAvant(false);
                                $image->save();
                            } else {
                                $state = 'Extension non autorisée';
                            }
                        } else {
                            $state = 'Image trop grosse';
                        }
                    } elseif (isset($file) && $file['error'] == UPLOAD_ERR_NO_FILE) {
                        $state = 'Fichier inexistant';
                    } elseif (isset($file) && $file['error'] == UPLOAD_ERR_PARTIAL) {
                        $state = 'Fichier uploadé partiellement';
                    } elseif (isset($file) && $file['error'] == UPLOAD_ERR_INI_SIZE) {
                        $state = 'Fichier trop gros';
                    } elseif (isset($file) && $file['error'] == UPLOAD_ERR_FORM_SIZE) {
                        $state = 'Fichier trop gros';
                    } elseif (!isset($file)) {
                        $state = 'Pas de variable';
                    } else {
                        $state = 'Problème à l\'envoi';
                    }
                }
                echo $state;
            }
            
        }
        $_FILES =[];
        $view = new Views('annonces/manage');
        $view->setVar('image', $image);
        $view->setVar('page', $this->page);
        $view->setVar('annoncesDiffusees', $annoncesDiffusees);
        $view->setVar('annoncesNonDiffusees', $annoncesNonDiffusees);
        $view->render();
    }

    public function formManager()
    {
        if (isset($_SESSION['logged'])) {
            $annonce = new Annonce();
            if (count($_POST) !== 0) {
                $user = new Users();
                $kilometrage = isset($_POST['kilometrage']) && is_numeric($_POST['kilometrage']) ? (int)$_POST['kilometrage'] : null;
                $prix = isset($_POST['prix']) && is_numeric($_POST['prix']) ? (int)$_POST['prix'] : null;
                $diffuse = $_POST['diffuse'] == 'on' ? true : false;
                $annonce->setIdUser($user->getIdByEmail($_SESSION['email']));
                $annonce->setKilometrage($kilometrage);
                $annonce->setAnnee($_POST['annee']);
                $annonce->setPrix($prix);
                $annonce->setModele($_POST['model']);
                $annonce->setIsDiffuse($diffuse);
                $annonce->setCorps($_POST['corps']);
                $annonce->setNumDossier($_POST['numDossier']);
                $annonce->save();
            }
        }
    }

    public function update() {
        
        $annonceId = isset($_GET['id']) ? $_GET['id'] : null;
        if ($annonceId) {
        $annonce = new Annonce();
        $annonceDetails = $annonce->getById($annonceId);
        $images = $annonce->getImagesbyIdAnnonce($annonceId);
        }
        
        $view = new Views('annonces/update');
        $view->setVar('annonce', $annonceDetails);
        $view->setVar('images', $images);
        $view->setVar('page', $this->page);
        $view->render();
        
       
    }
}