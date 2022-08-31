<?php
namespace App\Classes;

use DateTime;

class Comptabilite
{
    private $id;

    private $motif;

    private $date_at;

    private $montant;

    private $details;

    private $katakatani_id;

    private $prenom;

    private $nom;


    
    public function getId() : ?int
    {
        return $this->id;
    }

    public function setId(int $id) : self
    {
        $this->id = $id;

        return $this;
    }

    public function getMotif() : ?string
    {
        return $this->motif;
    }

    public function setMotif(string $motif) : self
    {
        $this->motif = $motif;

        return $this;
    }

    public function getMontant() : ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant) : self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDetails() : ?string
    {
        return $this->details;
    }

    public function setDetails(string $details) : self
    {
        $this->details = $details;

        return $this;
    }

    public function getDateAt() : ?DateTime
    {
        return new DateTime($this->date_at);
    }

    public function setDateAt(string $date_at) : self
    {
        $this->date_at = $date_at;

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

    public function getNomComplet() : ?string
    {
        return $this->prenom . ' ' . $this->nom;
    }

}
