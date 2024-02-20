<?php

namespace Root\Garageauto\Entity;

use Root\Garageauto\Model;

class Users extends Model
{

    private ?int $id;
    private ?string $mail;
    private ?string $mdp;

    public function get_object_vars()
    {
        return get_object_vars($this);
    }

    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = htmlspecialchars(addslashes($id));

        return $this;
    }

    public function getMail()
    {
        return $this->mail;
    }


    public function setMail($mail)
    {
        $this->mail = htmlspecialchars(addslashes($mail));

        return $this;
    }


    public function getMdp()
    {
        return $this->mdp;
    }


    public function setMdp($mdp)
    {
        $this->mdp = password_hash($mdp, PASSWORD_DEFAULT);

        return $this;
    }
}