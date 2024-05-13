<?php
class Evaluation
{
    public ?int $id_evaluation = null;
    public ?int $id_depot = null;
    public ?int $id_enseignant = null;
    public ?string $note = null;
    public ?string $commentaire = null;
    public ?string $reponse_etud = null;

    public function __construct($id_evaluation, $id_depot, $id_enseignant, $note, $commentaire, $reponse_etud)
    {
        $this->id_evaluation = $id_evaluation;
        $this->id_depot = $id_depot;
        $this->id_enseignant = $id_enseignant;
        $this->note = $note;
        $this->commentaire = $commentaire;
        $this->reponse_etud = $reponse_etud;
    }

    public function getIdEvaluation()
    {
        return $this->id_evaluation;
    }

    public function getIdDepot()
    {
        return $this->id_depot;
    }

    public function getIdEnseignant()
    {
        return $this->id_enseignant;
    }

    public function getNote()
    {
        return $this->note;
    }

    public function getCommentaire()
    {
        return $this->commentaire;
    }

    public function getReponseEtud() {
        return $this->reponse_etud;
    }

    public function setReponseEtud(string $rep) {
        $this->reponse_etud = $rep;
    }

}

function eval_array_construct($eval, $array_etud) {
    $eval->id_evaluation = $array_etud["ID_EVALUATION"];
    $eval->id_depot = $array_etud["ID_DEPOT"];
    $eval->id_enseignant = $array_etud["ID_ENSEIGNANT"];
    $eval->note = $array_etud["NOTE"];
    $eval->commentaire = $array_etud["COMMENTAIRE"];

    if (isset($array_etud["REPONSE_ETUD"])) {
        $eval->reponse_etud = $array_etud["REPONSE_ETUD"];
    }

    return $eval;
}