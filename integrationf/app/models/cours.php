<?php
class cours
{
    private ?int $Id_cours = null;
    private ?string $Nom_cours = null;
    private ?int $Nbr_heures = null;
    private ?bool $Type_cours = null;
    private ?string $Nom_Ens = null;

    public function __construct($Nom_cours, $Nbr_heures, $Type_cours, $Nom_Ens)
    {
        // Assurez-vous que les valeurs sont du bon type avant de les attribuer
        $this->Nom_cours = (string) $Nom_cours;
        $this->Nbr_heures = (int) $Nbr_heures;
        $this->Type_cours = (bool) $Type_cours;
        $this->Nom_Ens = (string) $Nom_Ens;
    }



    public function getidcours()
    {
        return $this->Id_cours;
    }
    public function setidcours($Id_cours)
    {
        $this->Id_cours = $Id_cours;
    }
    public function getnomcours()
    {
        return $this->Nom_cours;
    }
    public function setnomcours($Nom_cours)
    {
        $this->Nom_cours = $Nom_cours;
    }

    public function setNbr_heures($Nbr_heures)
    {
        $this->Nbr_heures = $Nbr_heures;
    }

    public function getNbr_heures()
    {
        return $this->Nbr_heures;
    }

    public function setType_cours($Type_cours)
    {
        $this->Type_cours = $Type_cours;
    }

    public function getType_cours()
    {
        return $this->Type_cours;
    }
    public function setNom_Ens($Nom_Ens)
    {
        $this->Nom_Ens = $Nom_Ens;
    }

    public function getNom_Ens()
    {
        return $this->Nom_Ens;
    }
}
