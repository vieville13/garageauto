<?php

namespace Root\Garageauto\Controller;

use Root\Garageauto\Views;
use Root\Garageauto\Entity\Users as User;


class Users
{
    private string $page = 'users';

    private ?string $action = null;

    public function __construct()
    {
        $this->action = isset($_GET['action']) ? $_GET['action'] : null;
        $loggedIn = isset($_SESSION['logged']) ? $_SESSION['logged'] : false;
        $isAdmin = isset($_SESSION['admin']) ? (bool)$_SESSION['admin'] : false;
        
        switch (true) {
            case $this->action === 'login' && !$loggedIn:
                $this->login();
                break;
            case $this->action === 'logout' && $loggedIn:
                $this->logout();
                break;
            case $this->action === 'logged' && $loggedIn:
                $this->manage();
                break;
            case $this->action === 'add' && $loggedIn && $isAdmin:
                $this->add();
                break;
            case $this->action === 'delete' && $loggedIn && $isAdmin:
                $this->delete();
            break;
            default:
                if (isset($_SESSION['logged']) && $_SESSION['logged'] === true) {    
                $this->manage();
                    break;
                }
                $this->login();
                break;
        }
    }
    

    public function login()
    {
        if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {

            $user = new User();
            $users = $user->getAll();
            if (count($_POST) !== 0) {
                if (isset($_POST['email'])) {

                    $email = $_POST['email'];
                }
                if (isset($_POST['mdp'])) {

                    $mdp = $_POST['mdp'];
                }

                foreach ($users as $user) {
                    $error = true;

                    if ($email === $user->email && password_verify($mdp, $user->mdp)) {
                        $_SESSION['logged'] = true;
                        $_SESSION['email'] = $email;
                        $_SESSION['id'] = $user->getId();
                        $_SESSION['mdp'] = $user->getMdp();
                        $_SESSION['admin'] = $user->getAdmin();
                        $error = false;
                        $this->manage();
                        exit;
                    }
                }
                if ($error === true) {
                    echo "Mauvais mot de passe ou email";
                
                }
            }
            $view = new Views('users/login');
            $view->setVar('page', $this->page);
            $view->render();
        } else header("Location: index.php?page=users&action=logged");
    }
    //Affiche la page manage.php
    public function manage()
    {
        if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
            header("Location: index.php?page=users&action=login");
        }
        $view = new Views('users/manage');
        $view->setVar('page', $this->page);
        $view->render();
    }


    //affiche la page add.php et permet de creer un nouvel utilisateur et le connecte
    //et test si le mail et pseudo ne sont pas deja utiliser
    //Attention un pseudo avec ou sans majuscule seras considéré comme identique
    public function add()
    {
        if (isset($_SESSION['logged']) && $_SESSION['admin'] == true) {
            $user = new User();
            $users = $user->getAll();
            if (count($_POST) !== 0) {;
                $mdp = $_POST['mdp'];
                $email = $_POST['email'];
                $admin = false;
                $error = false;
                foreach ($users as $user) {
                    if ($email === $user->email) {
                        $error = true;
                    }
                }
                if ($error) {
                    echo "Mail déjà utilisé";
                } else {
                    $newUser = new User();
                    $user = new User();
                    $newUser->email = $email;
                    $newUser->mdp = $mdp;
                    $newUser->admin = $admin;
                    $newUser->save();
                    $newUser = $user->getByAttribute('email', $email)[0];

                    $_SESSION['logged'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['id'] = $newUser->id;
                    $_SESSION['mdp'] = $newUser->mdp;
                    $this->manage();
                    exit;
                }
            }
        } else header("Location: index.php?page=users&action=logged");

        $view = new Views('users/add');
        $view->setVar('page', $this->page);
        $view->render();
    }
    //Affiche la page logout.php et déconnecte l'utilisateur connécté
    public function logout()
    {
        if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
            header("Location: index.php?page=users&action=login");
        }
        $view = new Views('users/logout');
        $view->setVar('page', $this->page);
        $_SESSION = [];
        $view->render();
    }

    public function delete ()
    {    var_dump($_SESSION);
        if (isset($_SESSION['logged']) && $_SESSION['admin'] == true) {
            $user = new User();
            $users = $user->getAll();
            if (count($_POST) !== 0) {;
                $id = $_POST['id'];
                $user = new User();
                $user->delete($id);
                exit;
            }
        } else header("Location: index.php?page=users&action=logged");

        $view = new Views('users/delete');
        $view->setVar('users', $users);
        $view->setVar('page', $this->page);
        $view->render();
    }
}
