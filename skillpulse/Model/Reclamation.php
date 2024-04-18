<?php

class Reclamation
{
    private $idR;
    private $Type;
    private $Etat;
    private $Description;
    private $Email;
    private $Name; // New variable for name
    private $Subject; // New variable for subject




    public function getIdR()
    {
        return $this->idR;
    }

    public function setIdR($idR)
    {
        $this->idR = $idR;
    }

    public function getType()
    {
        return $this->Type;
    }

    public function setType($Type)
    {
        $this->Type = $Type;
    }

    public function getEtat()
    {
        return $this->Etat;
    }

    public function setEtat($Etat)
    {
        $this->Etat = $Etat;
    }

    public function getDescription()
    {
        return $this->Description;
    }

    public function setDescription($Description)
    {
        $this->Description = $Description;
    }

    public function getEmail()
    {
        return $this->Email;
    }

    public function setEmail($Email)
    {
        $this->Email = $Email;
    }

    public function getName()
    {
        return $this->Name;
    }

    public function setName($Name)
    {
        $this->Name = $Name;
    }

    public function getSubject()
    {
        return $this->Subject;
    }

    public function setSubject($Subject)
    {
        $this->Subject = $Subject;
    }
}

?>