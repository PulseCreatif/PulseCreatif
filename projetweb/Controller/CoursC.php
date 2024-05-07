<?php
//require '..\config.php';
require_once 'c:/xampp/htdocs/projetweb/config.php';

class CoursC
{


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
    public function searchC($search_query)
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



    public function searchCours($filter_options, $course_names)
    {
        // Connect to the database
        $db = config::getConnexion();

        // Prepare the base SQL query
        $query = "SELECT * FROM cours WHERE 1";

        // Add conditions for filtering based on type_cours
        if (isset($filter_options['type_free']) && isset($filter_options['type_premium'])) {
            // Both types selected, include both in the query
            $query .= " AND (Type_cours = 0 OR Type_cours = 1)";
        } elseif (isset($filter_options['type_free'])) {
            // Only free type selected
            $query .= " AND Type_cours = 0";
        } elseif (isset($filter_options['type_premium'])) {
            // Only premium type selected
            $query .= " AND Type_cours = 1";
        }

        // Add conditions for filtering based on course names
        foreach ($course_names as $course_name) {
            if (isset($filter_options['course_' . $course_name])) {
                // Ensure that the course name condition is properly added
                $query .= " AND Nom_cours = :course_" . $course_name;
            }
        }

        // Prepare the statement
        $stmt = $db->prepare($query);

        // Bind parameters for course names
        foreach ($course_names as $course_name) {
            if (isset($filter_options['course_' . $course_name])) {
                // Bind the course name parameter
                $stmt->bindValue(':course_' . $course_name, $course_name, PDO::PARAM_STR);
            }
        }

        // Execute the query
        $stmt->execute();

        // Fetch the results
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return the filtered results
        return $result;
    }




    public function sortByCriteria($criteria)
    {
        // Connectez-vous à votre base de données
        $db = config::getConnexion();

        // Définissez la requête SQL de base
        $sql = "SELECT * FROM cours";

        // Ajoutez la clause ORDER BY en fonction du critère sélectionné
        switch ($criteria) {
            case "Id_cours":
                $sql .= " ORDER BY Id_cours";
                break;
            case "Nom_cours":
                $sql .= " ORDER BY Nom_cours";
                break;
            case "Nom_Ens":
                $sql .= " ORDER BY Nom_Ens";
                break;
            default:
                // Si le critère n'est pas reconnu, ne faites rien
                break;
        }

        // Exécutez la requête SQL
        $stmt = $db->prepare($sql);
        $stmt->execute();

        // Récupérez les résultats
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retournez les résultats triés
        return $result;
    }
    public function getCoursesNames()
    {
        $sql = "SELECT DISTINCT Nom_cours FROM cours";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $course_names = $query->fetchAll(PDO::FETCH_COLUMN);
            return $course_names;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}
