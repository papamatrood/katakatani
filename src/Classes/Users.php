<?php
namespace App\Classes;

class Users
{
    private $id;

    private $username;

    private $password;

    private $roles;


    
    public function getId() : ?int
    {
        return $this->id;
    }

    public function setId(int $id) : self
    {
        $this->id = $id;

        return $this;
    }

    public function getUsername() : ?string
    {
        return $this->username;
    }

    public function setUsername(string $username) : self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword() : ?string
    {
        return $this->password;
    }

    public function setPassword(string $password) : self
    {
        $this->password = $password;

        return $this;
    }

    public function getroles() : ?string
    {
        return $this->roles;
    }

    public function setroles(string $roles) : self
    {
        $this->roles = $roles;

        return $this;
    }

}
