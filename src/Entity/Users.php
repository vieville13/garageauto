<?php

namespace Root\Garageauto\Entity;

use Root\Garageauto\Model;

class Users extends Model
{

    private ?int $id;
    private ?string $email;
    private ?string $mdp;
    private ?bool $admin;

    public function get_object_vars()
    {
        return get_object_vars($this);
    }

    public function getId()
    {
        return $this->id;
    }


    public function setIdUser($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;

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

    public function getAdmin()
    {
        return $this->admin;
    }


    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }
    public function getIdByEmail($email) {
        $users = $this->getAll();
        foreach ($users as $user) {
            if ($user->getEmail() == $email) {
                return $user->getId();
            }
        }
    }
}
