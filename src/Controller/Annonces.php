<?php

namespace Root\Garageauto\Controller;

use Root\Garageauto\Views;
use Root\Garageauto\Entity\Annonces as Annonce;
use Root\Garageauto\Entity\Users;
use \Root\Garageauto\Entity\Images;

class Annonces
{
    private string $page = 'annonce';

    private ?string $action = null;

    public function __construct()
    {
        if (isset($_GET['action'])) {
            $this->action = $_GET['action'];
        }
        switch ($this->action) {
            case 'manage':
                $this->manage();
                break;
            case 'add':
                $this->add();
                break;
            // default:
            //     $this->acceuil();
            //     break;
        }
    }




    //affiche la page add.php et permet de creer un nouvel utilisateur et le connecte
    //et test si le mail et pseudo ne sont pas deja utiliser
    //Attention un pseudo avec ou sans majuscule seras considéré comme identique
    public function add()
    {   
        if (isset($_SESSION['logged'])) {
            $annonce = new Annonce();
            if (count($_POST) !== 0) {
                $user = new Users();
                $annonce->setIdUser($user->getIdByEmail($_SESSION['email']));
                $annonce->setKilometrage($_POST['kilometrage']);
                $annonce->setAnnee($_POST['annee']);
                $annonce->setPrix($_POST['prix']);
                $annonce->setModele($_POST['model']);
                $annonce->setIsDiffuse(false);
                $annonce->setCorps($_POST['corps']);
                $annonce->setNumDossier($_POST['numDossier']);
                $annonce->save();
                if (isset($_POST['photo1'])){
                    $photosArray[] = $_POST['photo1'];
                    $i = 2;
                    while (isset($_POST['photo'.$i])) {
                        $photosArray[] = $_POST['photo'.$i];
                        $i++;
                    }
                    if ($photosArray[count($photosArray)-1]==""){    
                    array_pop($photosArray);
                    }
                    foreach ($photosArray as $photo) {
                        $image = new Images();
                        $image->setIdAnnonce($annonce->getIdByModeleKilometrageAnnee($annonce->getModele(), $annonce->getKilometrage(), $annonce->getAnnee()));
                        $image->setLien($photo);
                        $image->setIsMiseEnAvant(false);
                        $image->save();
                    }
                }
                $this->manage();
            }
             
        }
        $view = new Views('annonces/add');
        $view->setVar('page', $this->page);
        $view->render();
    }

    public function manage() 
    {
        $annonce = new Annonce();
        $annonces = $annonce->getAll();
        $annoncesDiffusees = [];
        $annoncesNonDiffusees = [];
        $image = new Images();
       foreach ($annonces as $annonce) {
           if($annonce->isDiffuse()){
               $annoncesDiffusees[] = $annonce;
           }
           else {
               $annoncesNonDiffusees[] = $annonce;
           }
       }
        
        
        $view = new Views('annonces/manage');
        $view->setVar('image', $image);
        $view->setVar('page', $this->page);
        $view->setVar('annoncesDiffusees' , $annoncesDiffusees);
        $view->setVar('annoncesNonDiffusees' , $annoncesNonDiffusees);
        $view->render();
    }

}
