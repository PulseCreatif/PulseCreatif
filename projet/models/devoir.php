<?php
class Devoir
{
    private ?int $depot_id = null;
    private ?int $cours_id = null;
    private ?string $date_limite = null;
    private ?string $fichier = null;
    private ?string $commentaire = null;
    private ?int $etat = null;

    

    public function __construct($depot_id, $cours_id, $date_limite, $fichier, $commentaire, $etat)
    {
        $this->depot_id = $depot_id;
        $this->cours_id = $cours_id;
        $this->date_limite = $date_limite;
        $this->fichier = $fichier;
        $this->commentaire = $commentaire;
        $this->etat = $etat;
    }

    public function getDepot_Id()
    {
        return $this->depot_id;
    }

    public function getCours_Id()
    {
        return $this->cours_id;
    }

    public function getDate_Limite()
    {
        return $this->date_limite;
    }

    public function getFichier()
    {
        return $this->fichier;
    }

    public function getCommentaire()
    {
        return $this->commentaire;
    }

    public function getEtat() {
        return $this->etat;
    }

    
}

