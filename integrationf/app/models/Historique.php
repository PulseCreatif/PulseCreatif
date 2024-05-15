<?php

class Historique {
    private $id;
    private $actionType;
    private $tableConcernee;
    private $idLigneModifiee;
    private $dateAction;
    private $utilisateurId;

    // Constructeur
    public function __construct($id, $actionType, $tableConcernee, $idLigneModifiee, $dateAction, $utilisateurId) {
        $this->id = $id;
        $this->actionType = $actionType;
        $this->tableConcernee = $tableConcernee;
        $this->idLigneModifiee = $idLigneModifiee;
        $this->dateAction = $dateAction;
        $this->utilisateurId = $utilisateurId;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getActionType() {
        return $this->actionType;
    }

    public function getTableConcernee() {
        return $this->tableConcernee;
    }

    public function getIdLigneModifiee() {
        return $this->idLigneModifiee;
    }

    public function getDateAction() {
        return $this->dateAction;
    }

    public function getUtilisateurId() {
        return $this->utilisateurId;
    }
}
