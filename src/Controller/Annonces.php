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
    private  ?int $id = null;

    public function __construct()
    {
        $this->action = isset($_GET['action']) ? $_GET['action'] : null;
        $this->id = isset($_GET['id']) ? (int) $_GET['id'] : null;
        $loggedIn = isset($_SESSION['logged']) ? $_SESSION['logged'] : false;
        switch (true) {
            case $this->action === 'acceuil':
            $this->acceuil();
                break;
            case $this->action === 'manage' && $loggedIn:
                $this->manage();
                break;
            case $this->action === 'add' && $loggedIn:
                $this->add();
                break;
            case $this->action === 'modify' && $loggedIn && isset($this->id):
            $this->modify();
                break;
            case $this->action === 'delete' && $loggedIn && isset($this->id):
            $this->delete();
                break;
            case $this->action === 'deleteImages' && $loggedIn && isset($this->id):
            $this->deleteImages();
                break;
            case $this->action === 'update' && $loggedIn:
            $this->update();
                break;
            default:
                $this->acceuil();
                break;
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
    {   
        $annonce = new Annonce();
        if (isset($_POST['numDossier'])){
            
        $this->formManagerAdd($annonce);
        $this->addPhotos($annonce->getByNumDossier($annonce->getNumDossier()));
        }
        $this->callViewManage($annonce);
        
    }

    public function formManagerAdd(Annonce $annonce)
    {
        if (count($_POST) !== 0) {
            $user = new Users();
            $kilometrage = isset($_POST['kilometrage']) && is_numeric($_POST['kilometrage']) ? (int)$_POST['kilometrage'] : null;
            $prix = isset($_POST['prix']) && is_numeric($_POST['prix']) ? (int)$_POST['prix'] : null;
            $diffuse = isset($_POST['isDiffuse']) && $_POST['isDiffuse'] == 'on' ? true : false;
            $modele = isset($_POST['modele']) ? $_POST['modele'] : null;
            $annonce->setIdUser($_SESSION['id']);
            $annonce->setKilometrage($kilometrage);
            $annonce->setAnnee($_POST['annee']);
            $annonce->setPrix($prix);
            $annonce->setModele($modele);
            $annonce->setIsDiffuse($diffuse);
            $annonce->setCorps($_POST['corps']);
            $annonce->setNumDossier($_POST['numDossier']);
            $annonce->save();
            $_POST=[];
        } 
    }
    
    public function formManagerUpdate(Annonce $annonce)
    {
        if (count($_POST) !== 0) {
            $user = new Users();
            $kilometrage = isset($_POST['kilometrage']) && is_numeric($_POST['kilometrage']) ? (int)$_POST['kilometrage'] : null;
            $prix = isset($_POST['prix']) && is_numeric($_POST['prix']) ? (int)$_POST['prix'] : null;
            $diffuse = isset($_POST['isDiffuse']) && $_POST['isDiffuse'] == 'on' ? true : false;
            $annonce->setIdUser($user->getIdByEmail($_SESSION['email']));
            $annonce->setKilometrage($kilometrage);
            $annonce->setAnnee($_POST['annee']);
            $annonce->setPrix($prix);
            $annonce->setModele($_POST['modele']);
            $annonce->setIsDiffuse($diffuse);
            $annonce->setCorps($_POST['corps']);
            $annonce->setNumDossier($_POST['numDossier']);
            $annonce->update();
            $_POST=[];

        }
    }

    public function modify() {
        $this->callViewModify();
    }

    public function update() {
        
        if (isset($_SESSION['logged']) && isset($_GET['id'])) {
        $idAnnonce = (int) $_GET['id'];
        $annonce = new Annonce();
        $annonce=$annonce->getById($idAnnonce);
        $this->addPhotos($annonce);
        $this->formManagerUpdate($annonce);
        $this->callViewManage($annonce);
        }
    }

    public function addPhotos( Annonce $annonce) {
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
                    if (isset($file) && $file['error'] == 0) {
                        if ($file['size'] <= 3145728) {
                            $infosfichier = pathinfo($file['name']);
                            $extension_upload = $infosfichier['extension'];
                            $extensions_autorisees = ['jpg', 'jpeg', 'gif', 'png'];
                            
                            if (in_array($extension_upload, $extensions_autorisees)) {
                                move_uploaded_file($file['tmp_name'], 'upload/' . basename($file['name']));
                                $state = "L'envoi a bien été effectué !";
                                $image = new Images();
                                $image->setIdAnnonce($annonce->getId());
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
    }
    /**
     * Appelle la vue pour modifier une annonce
     *
     * @param Annonce $annonce Une instance de la classe Annonce
     * @param Image[] $images Un tableau d'objets Image
     */
    public function callViewModify()
    {
        $annonceId = isset($_GET['id']) ? $_GET['id'] : null;
    
        if ($annonceId) {
            $annonce = new Annonce();
            $annonce = $annonce->getById($annonceId);
            $images = $annonce->getImagesbyIdAnnonce($annonceId);
        }
    
        $view = new Views('annonces/modify');
        $view->setVar('images', $images);
        $view->setVar('page', $this->page);
        $view->setVar('annonce', $annonce);
        $view->render();
    }

    public function callViewManage(Annonce $annonce) {
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
        $view = new Views('annonces/manage');
        $view->setVar('image', $image);
        $view->setVar('page', $this->page);
        $view->setVar('annoncesDiffusees', $annoncesDiffusees);
        $view->setVar('annoncesNonDiffusees', $annoncesNonDiffusees);
        $view->render();
    }

    public function deleteImages()
    {
        if (isset($_POST['supprime'])) {
            $imageIds = $_POST['supprime'];
    
            foreach ($imageIds as $imageId) {
                $image = new Images();
                $image= $image->getById($imageId);
                $image->deleteById($imageId);
            }
        }
        $this->callViewModify();
    }

    public function acceuil() {
        $annonces = new Annonce();
        $annonces =$annonces->getbyAttribute('isDiffuse', true);
        $view = new Views('annonces/acceuil');
            $view->setVar('annonces', $annonces);
            $view->setVar('page', $this->page);
            $view->render();
        
    }

    public function delete() {
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $annonce = new Annonce();
            $annonce = $annonce->getById($id);
            $annonce->deletebyId();
        }
            $this->manage();
    }
}