<?php

namespace Root\Garageauto\Controller;

use Root\Garageauto\Views;
use Root\Garageauto\Entity\Annonces as Annonce;
use Root\Garageauto\Entity\Users;
// use \Root\Garageauto\Entity\Photos();

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
            // case 'acceuil':
            //     $this->acceuil();
                // break;
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
    {   var_dump($_POST);
        if (isset($_SESSION['logged'])) {
            $annonce = new Annonce();
            if (count($_POST) !== 0) {
                $user = new Users();
                $annonce->setIdUser($user->getIdByEmail($_SESSION['email']));
                $annonce->setKilometrage($_POST['kilometrage']);
                $annonce->setAnnee($_POST['annee']);
                $annonce->setPrix($_POST['prix']);
                $annonce->setModele($_POST['model']);
                $annonce->save();
                // if (isset($_POST['photo1'])){
                //     $photosArray = [$_POST['photo1']];
                //     $i = 2;
                //     while (isset($_POST['photo'.$i])) {
                //         $photosArray +=$_POST['photo'.$i];
                //         $i++;
                //     }
                //     foreach ($photosArray as $photo) {
                //         $photo = new \Root\Garageauto\Entity\Photos();
                //     }
                    
                // }
                
        }
       

        $view = new Views('annonces/add');
        $view->setVar('page', $this->page);
        $view->render();
    }

}
