<?php

namespace Root\Garageauto\Entity;

use Root\Garageauto\Model;
use Root\Garageauto\Entity\Images;

class Annonces extends Model
{

    private ?int $id;
    private ?int $prix;
    private ?string $image;
    private ?string $annee;
    private ?int $kilometrage;
    private ?int $idUser;
    private ?string $modele;
    private bool $isDiffuse;
    private ?string $corps;
    private ?string $numDossier;

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

    public function getModele(){
        
        return $this->modele;
    }

    public function setModele($modele){
        $this->modele = $modele;

        return $this;
    }
    
    /**
     * Définit l'état de diffusion de l'annonce.
     *
     * @param bool $isDiffuse True si l'annonce est diffusée, False sinon.
     * @return void
     */
    public function setIsDiffuse(?bool $isDiffuse): void
    {
        if ($isDiffuse === null) {
            $this->isDiffuse = false;
        }
        else {    
        $this->isDiffuse = $isDiffuse;
        }
    }
    
    
    public function getCorps(): ?string
    {
        return $this->corps;
    }
    
    public function setCorps(?string $corps): void
    {
        $this->corps = $corps;
    }
    
    public function getNumDossier(): ?string
    {
        return $this->numDossier;
    }
    
    public function setNumDossier(?string $numDossier): void
    {
        $this->numDossier = $numDossier;
    }
    /**
     * Retourne l'état de diffusion de l'annonce.
     *
     * @return bool True si l'annonce est diffusée, False sinon.
     */
    public function isDiffuse(): bool
    {
        return $this->isDiffuse;
    }

    public function getIdByModeleKilometrageAnnee($modele, $kilometrage, $annee) {
        $annonce = $this->getAll();
        foreach ($annonce as $annonce) {
            if ($annonce->getModele() == $modele && $annonce->getKilometrage() == $kilometrage && $annonce->getAnnee() == $annee) {
                return $annonce->getId();
            }
            
        }
        return null;
    }

    public function getImagesbyIdAnnonce($idAnnonce)
    {
        $images = new Images();
        $images = $images->getByAttribute("idAnnonce", $idAnnonce);
        return $images;
    }
}
