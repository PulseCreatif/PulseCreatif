<?php

require_once(__DIR__ . "/../../config/config.php");



class ReclamationsC
{

    public function countReclamationsByType() {
        $sql = "SELECT Type, COUNT(*) AS count FROM reclamation GROUP BY Type";
        $db = config::getConnexion();
        try {
            $query = $db->query($sql);
            $reclamationsByType = $query->fetchAll(PDO::FETCH_ASSOC);
            return $reclamationsByType;
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
    
    function listReclamations() 
    {
        $sql = "SELECT * FROM reclamation";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $res = $query->fetchAll();
            return $res;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    
    
    

   
    function listResearcher($researcher)
    {
        $sql = "SELECT * FROM reclamation WHERE Description LIKE :researcher OR Email LIKE :researcher";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':researcher', '%' . $researcher . '%');
            $query->execute();
            $res = $query->fetchAll();
            return $res;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function countReclamations()
    {
        $sql = "SELECT count(idR) FROM reclamation";
        $db = config::getConnexion();
        try {
            $query = $db->query($sql);
            $prog_number = $query->fetchColumn();
            return $prog_number;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    function getReclamationById($idR)
    {
        $sql = "SELECT * FROM reclamation WHERE idR=:idR";
        $config = config::getConnexion();
        try {
            $querry = $config->prepare($sql);
            $querry->execute(['idR' => $idR]);
            $result = $querry->fetch();
            return $result;
        } catch (PDOException $th) {
            $th->getMessage();
        }
    }

    function addReclamation($reclamation)
    {
        $config = config::getConnexion();
        try {
            $querry = $config->prepare('INSERT INTO reclamation (Type, Etat, Description, Email) VALUES (:Type, :Etat, :Description, :Email)');
            $querry->execute([
                'Type' => $reclamation->getType(),
                'Etat' => $reclamation->getEtat(),
                'Description' => $reclamation->getDescription(),
                'Email' => $reclamation->getEmail()
            ]);
            $reclamation->setIdR($config->lastInsertId());
            
            // Define utilisateurId (replace 123 with actual user ID)
            $utilisateurId = $_SESSION["user_id"];
    
            // Add historique entry
            HistoriqueDAO::addHistorique('ajout', 'reclamation', $reclamation->getIdR(), $utilisateurId); // Adjust $utilisateurId according to your application logic
        } catch (PDOException $th) {
            $th->getMessage();
        }
    }
    



// FRONT CODE 

public function addReclamationWithDetails($reclamation)
{
    $config = config::getConnexion();
    try {
        // Prepare the SQL query with a placeholder for the category ID
        $query = $config->prepare('INSERT INTO reclamation (Name, Email, Subject, Description, ID_Categorie) VALUES (:Name, :Email, :Subject, :Description, :ID_Categorie)');
        
        // Execute the query with values including the category ID
        $query->execute([
            'Name' => $reclamation->getName(),
            'Email' => $reclamation->getEmail(),
            'Subject' => $reclamation->getSubject(),
            'Description' => $reclamation->getDescription(),
            'ID_Categorie' => $reclamation->getIdCategorie() // Assuming this method exists to retrieve the category ID from the $reclamation object
        ]);
        
        // Set the ID of the inserted reclamation
        $reclamation->setIdR($config->lastInsertId());

        // Trigger historique entry for the addition
        $actionType = 'ajout';
        $tableConcernee = 'reclamation';
        $idLigneModifiee = $reclamation->getIdR(); // ID of the added reclamation
        $utilisateurId = $_SESSION["user_id"]; // Replace with actual user ID
        HistoriqueDAO::addHistorique($actionType, $tableConcernee, $idLigneModifiee, $utilisateurId);
    } catch (PDOException $th) {
        // Return the error message
        return $th->getMessage();
    }
}




function modifyReclamation($reclamation)
{
    $config = config::getConnexion();
    try {
        // Get the reclamation before modifying it
        $reclamationBeforeModification = $this->getReclamationById($reclamation->getIdR());

        // Perform the reclamation modification
        $querry = $config->prepare('UPDATE reclamation SET Type=:Type, Etat=:Etat, Description=:Description, Email=:Email WHERE idR=:idR');
        $querry->execute([
            'idR' => $reclamation->getIdR(),
            'Type' => $reclamation->getType(),
            'Etat' => $reclamation->getEtat(),
            'Description' => $reclamation->getDescription(),
            'Email' => $reclamation->getEmail()
        ]);

        // Trigger historique entry
        $actionType = 'modification';
        $tableConcernee = 'reclamation';
        $idLigneModifiee = $reclamation->getIdR(); // ID of the modified reclamation
        $utilisateurId = $_SESSION["user_id"]; // Replace with actual user ID
        HistoriqueDAO::addHistorique($actionType, $tableConcernee, $idLigneModifiee, $utilisateurId);

        // Return the reclamation before modification in case it's needed
        return $reclamationBeforeModification;
    } catch (PDOException $th) {
        $th->getMessage();
    }
}

    function deleteReclamation($id)
    {
        $config = config::getConnexion();
        try {
            // Get the reclamation before deleting it
            $reclamationToDelete = $this->getReclamationById($id);
    
            // Delete the reclamation
            $sql = "DELETE FROM reclamation WHERE idR= :idR";
            $req = $config->prepare($sql);
            $req->bindValue(':idR', $id);
            $req->execute();
    
            // Trigger historique entry
            $actionType = 'suppression';
            $tableConcernee = 'reclamation';
            $idLigneModifiee = $id; // ID of the deleted reclamation
            $utilisateurId = $_SESSION["user_id"]; // Replace with actual user ID
            HistoriqueDAO::addHistorique($actionType, $tableConcernee, $idLigneModifiee, $utilisateurId);
    
            // Return the deleted reclamation in case it's needed
            return $reclamationToDelete;
        } catch (PDOException $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function chercherReclamationParEmail($email)
    {
        $query = "SELECT * FROM reclamation WHERE Email LIKE :email";
        $conn = config::getConnexion();
        try {
            $stmt = $conn->prepare($query);
            $stmt->bindValue(':email', '%' . $email . '%', PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage();
        }
    }

   
}
    
    