<?php


require_once 'C:\xampp\htdocs\skillpulse\config.php'; // Include the config.php file

class ReclamationsC
{

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

    function getReclamationById($id)
    {
        $sql = "SELECT * FROM reclamation WHERE idR=:id";
        $config = config::getConnexion();
        try {
            $querry = $config->prepare($sql);
            $querry->execute(['id' => $id]);
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
        } catch (PDOException $th) {
            $th->getMessage();
        }
    }




// FRONT CODE 


public function addReclamationWithDetails($reclamation)
{
    $config = config::getConnexion();
    try {
        $query = $config->prepare('INSERT INTO reclamation (Name, Email, Subject, Description) VALUES (:Name, :Email, :Subject, :Description)');
        $query->execute([
            'Name' => $reclamation->getName(),
            'Email' => $reclamation->getEmail(),
            'Subject' => $reclamation->getSubject(),
            'Description' => $reclamation->getDescription()
        ]);
        $reclamation->setIdR($config->lastInsertId());
    } catch (PDOException $th) {
        // Return the error message
        return $th->getMessage();
    }
}







    function modifyReclamation($reclamation)
    {
        $config = config::getConnexion();
        try {
            $querry = $config->prepare('UPDATE reclamation SET Type=:Type, Etat=:Etat, Description=:Description, Email=:Email WHERE idR=:idR');
            $querry->execute([
                'idR' => $reclamation->getIdR(),
                'Type' => $reclamation->getType(),
                'Etat' => $reclamation->getEtat(),
                'Description' => $reclamation->getDescription(),
                'Email' => $reclamation->getEmail()
            ]);
        } catch (PDOException $th) {
            $th->getMessage();
        }
    }

    function deleteReclamation($id)
    {
        $sql = "DELETE FROM reclamation WHERE idR= :idR";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':idR', $id);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}