<?php
//require '..\config.php';
require_once '../config.php';

class CoursC
{


    public function getCoursById($Id_cours)
    {
        $sql = "SELECT * FROM cours WHERE Id_cours = :Id_cours";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->bindValue(':Id_cours', $Id_cours);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function listcours()
    {
        $tab = array();

        $sql = "SELECT * FROM cours";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute();
            $tab = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }

        return $tab;
    }

    public function deletecours($Id_cours)
    {
        $sql = "DELETE FROM cours WHERE Id_cours = :Id_cours";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':Id_cours', $Id_cours);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addcours($cours)
    {
        $sql = 'INSERT INTO cours (Nbr_heures, Type_cours, Nom_Ens) VALUES (:Nbr_heures, :Type_cours, :Nom_Ens)';
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            // Utilisez les méthodes set pour définir les valeurs
            $query->execute([
                'Nbr_heures' => $cours->getNbr_heures(),
                'Type_cours' => $cours->getType_cours(),
                'Nom_Ens' => $cours->getNom_Ens(),
            ]);
            echo "Success " . $cours->getNbr_heures() . " " . $cours->getNom_Ens(); // Utilisez le point pour concaténer
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
            echo $e->getMessage();
        }
    }
}
