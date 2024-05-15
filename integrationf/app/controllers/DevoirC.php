<?php

require_once(__DIR__."/../../config/config.php");

class DevoirController {
    public static function listDevoirs() {
        $db = config::getConnexion();
        $sql = "SELECT * from myapp.TABLE_DEVOIR";
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

    public function deleteDevoir($id)
    {
        $sql = "DELETE FROM myapp.TABLE_DEVOIR WHERE DEPOT_ID = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addDevoir($devoir)
    {
        $sql = "INSERT INTO myapp.TABLE_DEVOIR (COURS_ID, DATE_LIMITE, FICHIER, COMMENTAIRE, ETAT)
        VALUES (:cours_id, :date_limite, :fichier, :commentaire, :etat)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'cours_id' => $devoir->getCours_Id(),
                'date_limite' => $devoir->getDate_Limite(),
                'fichier' => $devoir->getFichier(),
                'commentaire' => $devoir->getCommentaire(),
                'etat' => $devoir->getEtat()

            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updateDevoir($devoir, $id)
    {
        $sql = "UPDATE myapp.TABLE_DEVOIR 
                SET COURS_ID = :cours_id, 
                    DATE_LIMITE = :date_limite, 
                    FICHIER = :fichier, 
                    COMMENTAIRE = :commentaire, 
                    ETAT = :etat 
                WHERE DEPOT_ID = :id";
    
        $db = config::getConnexion();
    
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id,
                'cours_id' => $devoir->getCours_Id(),
                'date_limite' => $devoir->getDate_Limite(),
                'fichier' => $devoir->getFichier(),
                'commentaire' => $devoir->getCommentaire(),
                'etat' => $devoir->getEtat()
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    

    function showDevoir($id)
    {
        $sql = "SELECT * from myapp.TABLE_DEVOIR where DEPOT_ID = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $user = $query->fetch();
            return $user;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}










