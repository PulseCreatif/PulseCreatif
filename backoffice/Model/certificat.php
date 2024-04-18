<?php
class certificat
{
    private ?int $Id_Cert = null;
    private ?string $Titre_Cert = null;
    private ?string $Date_Cert = null;
    private ?string $Duree_Cert = null;
    private ?string $Nom_Etud = null;
    private ?int $Id_Cours = null;

    public function __construct($Id_Cert = null, $Titre_Cert, $Date_Cert, $Duree_Cert, $Nom_Etud, $Id_Cours)
    {
        $this->$Id_Cert = $Id_Cert;
        $this->$Titre_Cert =  $Titre_Cert;
        $this->$Date_Cert = $Date_Cert;
        $this->$Duree_Cert = $Duree_Cert;
        $this->$Nom_Etud = $Nom_Etud;
        $this->$Id_Cours = $Id_Cours;
    }

    public function getId_Cert()
    {
        return $this->Id_Cert;
    }
    public function setId_Cert($Id_Cert)
    {
        $this->Id_Cert = $Id_Cert;
    }
}
