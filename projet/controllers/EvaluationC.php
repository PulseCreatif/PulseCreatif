<?php

require_once(__DIR__."/../config.php");

class EvaluationController {
    // Lister toutes les évaluations
    public static function listEvaluations() {
        $db = config::getConnexion();
        
        $sql = "SELECT * from myapp.TABLE_EVALUATION"; // Mise à jour du nom de la table
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $result = $query->fetchAll();
        }
        catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }

        return $result;
    }

    // Supprimer une évaluation spécifique
    public function deleteEvaluation($id)
    {
        $sql = "DELETE FROM myapp.TABLE_EVALUATION WHERE ID_EVALUATION = :id"; // Mise à jour du nom de la colonne
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    // Ajouter une nouvelle évaluation
    public function addEvaluation($evaluation)
    {
        $sql = "INSERT INTO myapp.TABLE_EVALUATION (ID_DEPOT, ID_ENSEIGNANT, NOTE, COMMENTAIRE, REPONSE_ETUD)
        VALUES (:id_depot, :id_enseignant, :note, :commentaire, :reponse_etud)"; // Mise à jour des colonnes
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_depot' => $evaluation->getIdDepot(),
                'id_enseignant' => $evaluation->getIdEnseignant(),
                'note' => $evaluation->getNote(),
                'commentaire' => $evaluation->getCommentaire(),
                'reponse_etud' => $evaluation->getReponseEtud() // Ajout du champ REPONSE_ETUD
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Mettre à jour une évaluation existante
    public function updateEvaluation($evaluation, $id)
    {
        $sql = "UPDATE myapp.TABLE_EVALUATION
                SET ID_DEPOT = :id_depot, 
                    ID_ENSEIGNANT = :id_enseignant, 
                    NOTE = :note, 
                    COMMENTAIRE = :commentaire,
                    REPONSE_ETUD = :reponse_etud
                WHERE ID_EVALUATION = :id"; // Mise à jour des colonnes et de la condition


        //$db = config::getConnexion();
        
        $user = "root";
        $pass = "";
        $db = new PDO('mysql:host=localhost;dbname=myapp', $user, $pass);
        

        try {
            $query = $db->prepare($sql);
            var_dump($query);
            $query->execute([
                'id' => $id,
                'id_depot' => (int) $evaluation->getIdDepot(),
                'id_enseignant' => (int) $evaluation->getIdEnseignant(),
                'note' => $evaluation->getNote(),
                'commentaire' => (string) $evaluation->getCommentaire(),
                'reponse_etud' => (string) $evaluation->getReponseEtud() // Ajout du champ REPONSE_ETUD
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Afficher une évaluation spécifique
    function showEvaluation($id)
    {
        $sql = "SELECT * from myapp.TABLE_EVALUATION where ID_EVALUATION = :id"; // Mise à jour de la condition
        $db = config::getConnexion();
        try {
            $user = "root";
            $pass = "";
            $db = new PDO('mysql:host=localhost;dbname=myapp', $user, $pass);
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();

            $evaluation = $query->fetch();
            return $evaluation;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
?>
