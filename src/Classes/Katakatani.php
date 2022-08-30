<?php
namespace App\Classes;

use DateTime;

class Katakatani
{
    private $id;

    private $matricule;

    private $acheter_at;

    private $prix_achat;


    
    public function getId() : ?int
    {
        return $this->id;
    }

    public function setId(int $id) : self
    {
        $this->id = $id;

        return $this;
    }

    public function getMatricule() : ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule) : self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getAcheterAt() : ?DateTime
    {
        return new DateTime($this->acheter_at);
    }

    public function setAcheterAt(string $acheter_at) : self
    {
        $this->acheter_at = $acheter_at;

        return $this;
    }

    public function getPrixAchat() : ?int
    {
        return $this->prix_achat;
    }

    public function setPrixAchat(int $prix_achat) : self
    {
        $this->prix_achat = $prix_achat;

        return $this;
    }

    public function Prix(string $sigle = 'FCFA') : ?string
    {
        return number_format($this->getPrixAchat(), 0, '', ' ') . ' ' . $sigle;
    }

}
