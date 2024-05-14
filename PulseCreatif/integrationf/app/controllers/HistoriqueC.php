<?php

require_once '..\Model\HistoriqueDAO.php'; 
class HistoriqueC {
    // Method to add historique entry
    public static function addHistorique($actionType, $tableConcernee, $idLigneModifiee, $utilisateurId) {
        // Call the addHistorique method of HistoriqueDAO and pass the parameters
        HistoriqueDAO::addHistorique($actionType, $tableConcernee, $idLigneModifiee, $utilisateurId);
    }

    // Method to retrieve historique entries
    public static function getHistorique() {
        // Call the getHistorique method of HistoriqueDAO
        return HistoriqueDAO::getHistorique();
    }

   
}
