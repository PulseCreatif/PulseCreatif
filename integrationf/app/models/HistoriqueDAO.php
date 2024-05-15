<?php
require_once(__DIR__ . "/../../config/config.php");

class HistoriqueDAO {
    public static function addHistorique($actionType, $tableConcernee, $idLigneModifiee, $utilisateurId) {
        try {
            // Get database connection
            $db = config::getConnexion();

            // Prepare SQL statement
            $stmt = $db->prepare("INSERT INTO historique (action_type, table_concernee, id_ligne_modifiee, date_action, utilisateur_id) VALUES (:actionType, :tableConcernee, :idLigneModifiee, NOW(), :utilisateurId)");

            // Bind parameters and execute the statement
            $stmt->execute([
                ':actionType' => $actionType,
                ':tableConcernee' => $tableConcernee,
                ':idLigneModifiee' => $idLigneModifiee,
                ':utilisateurId' => $utilisateurId
            ]);
        } catch (PDOException $e) {
            // Handle exception
            die('Error adding historique entry: ' . $e->getMessage());
        }
    }

    public static function getHistorique() {
        try {
            // Get database connection
            $db = config::getConnexion();

            // Prepare SQL statement
            $stmt = $db->prepare("SELECT * FROM historique e inner join table_user u on u.USER_ID = e.utilisateur_id");

            // Execute the statement
            $stmt->execute();

            // Fetch all historique entries as an associative array
            $historiqueEntries = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $historiqueEntries;
        } catch (PDOException $e) {
            // Handle exception
            die('Error fetching historique entries: ' . $e->getMessage());
        }
    }
}
