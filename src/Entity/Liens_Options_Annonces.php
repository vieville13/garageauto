<?php

namespace Root\Garageauto\Entity;

use Root\Garageauto\Model;

class Liens_Options_Annonces extends Model
{

    private ?int $idAnnonce;
    private ?int $idOption;

    public function get_object_vars()
    {
        return get_object_vars($this);
    }

    public function getIdAnnonce()
    {
        return $this->idAnnonce;
    }


    public function setIdAnnonce($idAnnonce)
    {
        $this->idAnnonce = htmlspecialchars(addslashes($idAnnonce));

        return $this;
    }

    public function getIdOption()
    {
        return $this->idOption;
    }


    public function setIdOption($idOption)
    {
        $this->idOption = htmlspecialchars(addslashes($idOption));

        return $this;
    }

   
}