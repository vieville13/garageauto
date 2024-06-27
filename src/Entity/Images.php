<?php
namespace Root\Garageauto\Entity;

use Root\Garageauto\Model;

class Images extends Model
{
    private int $id;
    private int $idAnnonce;
    private ?bool $isMiseEnAvant;
    private ?string $lien;
    // public function __construct($id = null, $idAnnonce = null, $isMiseEnAvant = null, $lien = null)
    // {
    //     $this->id = $id;
    //     $this->idAnnonce = $idAnnonce;
    //     $this->isMiseEnAvant = $isMiseEnAvant;
    //     $this->lien = $lien;
    // }
    public function get_object_vars()
    {
        return get_object_vars($this);
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): void
    {
        $this->id = $id;
    }
    public function getIdAnnonce(): ?int
    {
        return $this->idAnnonce;
    }
    public function setIdAnnonce(?int $idAnnonce): void
    {
        $this->idAnnonce = $idAnnonce;
    }
    public function isMiseEnAvant(): ?bool
    {
        return $this->isMiseEnAvant;
    }
    public function setIsMiseEnAvant(?bool $isMiseEnAvant): void
    {
        $this->isMiseEnAvant = $isMiseEnAvant;
    }
    public function getLien(): ?string
    {
        return $this->lien;
    }
    public function setLien(?string $lien): void
    {
        $this->lien = $lien;
    }
}