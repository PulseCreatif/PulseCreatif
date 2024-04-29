<?php
class Certif
{
    private ?int $Id_Cert = null;
    private ?string $Titre_Cert = null;
    private ?DateTime $Date_Cert = null; // Changement de type en DateTime
    private ?string $Duree_Cert = null;
    private ?string $Nom_Etud = null;
    public ?int $Id_Cours;

    // Constructeur
    public function __construct(?string $Titre_Cert, ?DateTime $Date_Cert, ?string $Duree_Cert, ?string $Nom_Etud, ?int $Id_Cours)
    {
        $this->Titre_Cert = $Titre_Cert;
        $this->Date_Cert = $Date_Cert;
        $this->Duree_Cert = $Duree_Cert;
        $this->Nom_Etud = $Nom_Etud;
        $this->Id_Cours = $Id_Cours;
    }

    public function setId_Cert($Id_Cert)
    {
        $this->Id_Cert = $Id_Cert;
    }

    public function getId_Cert()
    {
        return $this->Id_Cert;
    }

    public function setTitre_Cert($Titre_Cert)
    {
        $this->Titre_Cert = $Titre_Cert;
    }

    public function getTitre_Cert()
    {
        return $this->Titre_Cert;
    }

    public function setDate_Cert($Date_Cert)
    {
        $this->Date_Cert = $Date_Cert;
    }

    public function getDate_Cert()
    {
        return $this->Date_Cert;
    }

    public function setDuree_Cert($Duree_Cert)
    {
        $this->Duree_Cert = $Duree_Cert;
    }

    public function getDuree_Cert()
    {
        return $this->Duree_Cert;
    }

    public function setNom_Etud($Nom_Etud)
    {
        $this->Nom_Etud = $Nom_Etud;
    }

    public function getNom_Etud()
    {
        return $this->Nom_Etud;
    }

    public function setId_Cours1($Id_Cours)
    {
        $this->Id_Cours = $Id_Cours;
    }

    public function getId_Cours1()
    {
        return $this->Id_Cours;
    }
}
