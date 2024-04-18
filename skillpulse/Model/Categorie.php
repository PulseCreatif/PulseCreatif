<?php

class Categorie
{
    private $ID_Categorie_Primaire;
    private $Nom_Categorie;
    private $Description_Categorie;

    public function getID_Categorie_Primaire()
    {
        return $this->ID_Categorie_Primaire;
    }

    public function setID_Categorie_Primaire($ID_Categorie_Primaire)
    {
        $this->ID_Categorie_Primaire = $ID_Categorie_Primaire;
    }

    public function getNom_Categorie()
    {
        return $this->Nom_Categorie;
    }

    public function setNom_Categorie($Nom_Categorie)
    {
        $this->Nom_Categorie = $Nom_Categorie;
    }

    public function getDescription_Categorie()
    {
        return $this->Description_Categorie;
    }

    public function setDescription_Categorie($Description_Categorie)
    {
        $this->Description_Categorie = $Description_Categorie;
    }
}

?>
