<?php

namespace Root\Garageauto\Entity;

use Root\Garageauto\Model;

class Annonces extends Model
{

    private ?int $id;
    private ?int $prix;
    private ?string $image;
    private ?int $annee;
    private ?int $kilometrage;
    private ?int $idUser;

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
        $this->id = $id;

        return $this;
    }

    public function getPrix()
    {
        return $this->prix;
    }


    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }


    public function getImage()
    {
        return $this->image;
    }


    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getAnnee()
    {
        return $this->annee;
    }

    public function setAnnee($annee)
    {

        $this->annee = $annee;

        return $this;
    }

    public function getKilometrage()
    {
        return $this->kilometrage;
    }

    public function setKilometrage($kilometrage)
    {

        $this->kilometrage = $kilometrage;

        return $this;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function setIdUser($idUser)
    {

        $this->idUser = $idUser;

        return $this;
    }
}
