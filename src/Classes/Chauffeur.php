<?php
namespace App\Classes;

use DateTime;

class Chauffeur
{
    private $id;

    private $prenom;

    private $nom;

    private $adresse;

    private $telephone1;

    private $telephone2;

    private $debut_at;

    private $fin_at;

    private $katakatani_id;


    
    public function getId() : ?int
    {
        return $this->id;
    }

    public function setId(int $id) : self
    {
        $this->id = $id;

        return $this;
    }

    public function getPrenom() : ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom) : self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom() : ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom) : self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse() : ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse) : self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone1() : ?string
    {
        return $this->telephone1;
    }

    public function setTelephone1(string $telephone1) : self
    {
        $this->telephone1 = $telephone1;

        return $this;
    }

    public function getTelephone2() : ?string
    {
        return $this->telephone2;
    }

    public function setTelephone2(string $telephone2) : self
    {
        $this->telephone2 = $telephone2;

        return $this;
    }

    public function getDebutAt() : ?DateTime
    {
        return new DateTime($this->debut_at);
    }

    public function setDebutAt(string $debut_at) : self
    {
        $this->debut_at = $debut_at;

        return $this;
    }

    public function getFinAt() : ?DateTime
    {
        return new DateTime($this->fin_at);
    }

    public function setFinAt(string $fin_at) : self
    {
        $this->fin_at = $fin_at;

        return $this;
    }

    public function getKatakataniId() : ?int
    {
        return $this->katakatani_id;
    }

    public function setKatakataniId(int $katakatani_id) : self
    {
        $this->katakatani_id = $katakatani_id;

        return $this;
    }

}
