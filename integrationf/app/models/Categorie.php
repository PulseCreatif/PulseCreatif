<?php

class Categorie
{
    private $ID_Categorie;
    private $Nom_Categorie;
    private $Description_Categorie;

    public function getID_Categorie()
    {
        return $this->ID_Categorie;
    }

    public function setID_Categorie($ID_Categorie)
    {
        $this->ID_Categorie = $ID_Categorie;
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
