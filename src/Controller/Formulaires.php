<?php
namespace Root\Garageauto\Controller;

use Root\Garageauto\Views;
use Root\Garageauto\Entity\Formulaires as Formulaire;

class Formulaires
{

  private ?string $page = 'formulaire';
  private ?int $id = null;
  private ?string $action = null;

  public function __construct()
  {
      if (isset($_GET['action'])) {
          $this->action = $_GET['action'];
      }
    
      if(isset($_GET["id"])){
        $this->id = (int) $_GET["id"];
        if ($this->action == "add") {
            $this->add();
        }
      }

    if ($this->action == "manage") {
        $this->manage();
    }
    if ($this->action == "delete") {
      $this->delete();
    }
  }
  
  public function add() {
    if (isset($_POST) && $_POST !== []){
      $formulaire = new Formulaire();
      $formulaire->setNom($_POST['nom']);
      $formulaire->setPrenom($_POST['prenom']);
      $formulaire->setEmail($_POST['email']);
      $formulaire->setTelephone($_POST['telephone']);
      $formulaire->setMessage($_POST['message']);
      $formulaire->setIdAnnonce( (int) $_POST['idAnnonce']);
      $formulaire->save();
      $_POST =[];
      header("Location: index.php?page=annonce&action=acceuil");
    }
    $view = new Views('formulaires/add');
    $view->setVar('idAnnonce', $this->id);
    $view->setVar('page', $this->page);
    $view->render();
  }

  public function manage() {
    if ($_SESSION['admin'] == true) {  
      
      $formulaire = new Formulaire();
      $formulaires = $formulaire->getAll();
      $view = new Views('formulaires/manage');
      $view->setVar('formulaires', $formulaires);
      $view->setVar('page', $this->page);
      $view->render();
    }
    else header("Location: index.php?page=annonce&action=acceuil");
  }

  public function delete() {
      if (!empty($_POST['formulaire_ids'])) {
          $formulaire = new Formulaire();
          foreach ($_POST['formulaire_ids'] as $id) {
              $formulaire->getById($id)->deleteById();;
          }
      }

      header("Location: index.php?page=formulaire&action=manage");
      exit;
  }

  
}