<?php

namespace Root\Garageauto\Entity;

use Root\Garageauto\Model;
use Root\Garageauto\Entity\Annonces;

class Formulaires extends Model
{

    private ?int $id;
    private ?string $email;
    private ?string $nom;
    private ?string $prenom;
    private ?string $telephone;
    private ?string $message;
    private ?int $idAnnonce;

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

    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getNom()
    {
        return $this->nom;
    }


    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }


    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }


    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }


    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }


    public function getIdAnnonce()
    {
        return $this->idAnnonce;
    }

    public function setIdAnnonce($idAnnonce)
    {

        $this->idAnnonce = $idAnnonce;

        return $this;
    }

    public function getNumDossier(int $annonceId) {
        $annonce = new Annonces();
        return  $annonce->getNumDossierById($annonceId);
    }

}
