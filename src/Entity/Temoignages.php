<?php

namespace Root\Garageauto\Entity;

use Root\Garageauto\Model;

class Temoignages extends Model
{

    private ?int $id; 
    private ?string $nom;
    private ?string $commentaire;
    private ?int $note;
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
        $this->id = htmlspecialchars(addslashes($id));

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

    public function getCommentaire()
    {
        return $this->commentaire;
    }


    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getNote()
    {
        return $this->note;
    }


    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }


    public function getIdUser()
    {
        return $this->idUser;
    }

    public function setIdUser($idUser){

        $this->idUser = $idUser;

        return $this;

    }
}