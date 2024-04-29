<?php
//require '..\config.php';
require_once 'c:/xampp/htdocs/projetweb/config.php';

class CoursC
{


    /*public function getCoursById($Id_cours)
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
    }*/
    function recuperercours($Id_cours)
    {
        $sql = "SELECT * FROM cours where Id_cours=$Id_cours";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $Cours = $query->fetch();
            return $Cours;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
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
        $sql = 'INSERT INTO cours (Nom_cours, Nbr_heures, Type_cours, Nom_Ens) VALUES (:Nom_cours, :Nbr_heures, :Type_cours, :Nom_Ens)';
        $db = config::getConnexion();
        try {

            $query = $db->prepare($sql);
            // Utilisez les méthodes set pour définir les valeurs
            $query->execute([
                'Nom_cours' => $cours->getnomcours(),
                'Nbr_heures' => $cours->getNbr_heures(),
                'Type_cours' => $cours->getType_cours(),
                'Nom_Ens' => $cours->getNom_Ens(),
            ]);
            //echo "Success " . $cours->getnomcours() . " " . $cours->getNom_Ens(); // Utilisez le point pour concaténer
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
            //echo $e->getMessage();
        }
    }
    function modifiercours($cours, $Id_cours)
    {

        try {

            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE cours SET 
						Nom_cours= :Nom_cours, 
						Nbr_heures= :Nbr_heures,
						Type_cours= :Type_cours,
						Nom_Ens= :Nom_Ens
					WHERE Id_cours= :Id_cours'
            );
            var_dump($cours->getnomcours());
            $query->execute([
                'Nom_cours' => $cours->getnomcours(),
                'Nbr_heures' => $cours->getNbr_heures(),
                'Type_cours' => $cours->getType_cours(),
                'Nom_Ens' => $cours->getNom_Ens(),
                'Id_cours' => $Id_cours
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
            var_dump($db);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function searchCours($search_query)
    {
        // Connect to your database (replace with your database connection code)
        $db = config::getConnexion();

        // Determine if the search query is "free" or "premium"
        $type_cours = null;
        if ($search_query == "free") {
            $type_cours = 0;
        } elseif ($search_query == "premium") {
            $type_cours = 1;
        }

        // Prepare the SQL query to search for courses
        $query = "SELECT * FROM cours WHERE Nom_cours LIKE :search_query OR Nom_Ens LIKE :search_query OR Type_cours = :type_cours";
        $stmt = $db->prepare($query);

        // Bind the search query parameter
        $stmt->bindValue(':search_query', '%' . $search_query . '%', PDO::PARAM_STR);
        // Bind the type_cours parameter
        $stmt->bindValue(':type_cours', $type_cours, PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Fetch the results
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return the filtered results
        return $result;
    }
}
