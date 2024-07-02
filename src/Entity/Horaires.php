<?php

namespace Root\Garageauto\Entity;

use Root\Garageauto\Model;

class Horaires extends Model
{

    private ?int $id;
    private ?string $jour;
    private ?string $heureMatin;
    private ?string $heureSoir;


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

    public function getJour()
    {
        return $this->jour;
    }


    public function setjour($jour)
    {
        $this->jour = $jour;

        return $this;
    }

    public function getHeureMatin()
    {
        return $this->heureMatin;
    }


    public function setHeureMatin($heureMatin)
    {
        $this->heureMatin = $heureMatin;

        return $this;
    }

    public function getHeureSoir()
    {
        return $this->heureSoir;
    }


    public function setHeureSoir($heureSoir)
    {
        $this->heureSoir = $heureSoir;

        return $this;
    }
}
