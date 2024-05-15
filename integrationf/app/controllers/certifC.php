<?php
require_once(__DIR__ . "/../../config/config.php");

class CertifC
{


    function recuperercertif($Id_Cert)
    {
        $sql = "SELECT * FROM myapp.certificat where Id_Cert=$Id_Cert";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $certif = $query->fetch();
            return $certif;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function listcertif()
    {
        $tab = array();

        $sql = "SELECT * FROM myapp.certificat";
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

    public function deletecertif($Id_Cert)
    {
        $sql = "DELETE FROM myapp.certificat WHERE Id_Cert = :Id_Cert";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':Id_Cert', $Id_Cert);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addcertif($certif)
    {
        $sql = 'INSERT INTO myapp.certificat (Titre_Cert, Date_Cert, Duree_Cert, id_etud, Id_Cours) VALUES (:Titre_Cert, :Date_Cert, :Duree_Cert, :id_etud, :Id_Cours)';
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            // Utilisez les paramètres de liaison pour insérer la valeur de la date
            $query->bindValue(':Titre_Cert', $certif->getTitre_Cert());
            $query->bindValue(':Date_Cert', $certif->getDate_Cert()->format('Y-m-d')); // Utilisez format() pour obtenir la date au bon format
            $query->bindValue(':Duree_Cert', $certif->getDuree_Cert());
            $query->bindValue(':id_etud', $certif->getId_Etud());
            $query->bindValue(':Id_Cours', $certif->getId_Cours1());
            $query->execute();
            //echo "Success " . $cours->getnomcours() . " " . $cours->getNom_Ens(); // Utilisez le point pour concaténer
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
            //echo $e->getMessage();
        }
    }


    function modifiercertif($certif, $Id_Cert)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE myapp.certificat SET 
                Titre_Cert = :Titre_Cert, 
                Date_Cert = :Date_Cert,
                Duree_Cert = :Duree_Cert,
                id_etud = :id_etud,
                Id_cours = :Id_cours
            WHERE Id_Cert = :Id_Cert'
            );

            // Format the Date_Cert property into the expected format
            $dateCertFormatted = $certif->getDate_Cert()->format('Y-m-d');

            $query->execute([
                'Titre_Cert' => $certif->getTitre_Cert(),
                'Date_Cert' => $dateCertFormatted,
                'Duree_Cert' => $certif->getDuree_Cert(),
                'id_etud' => $certif->getId_Etud(),
                'Id_cours' => $certif->getId_Cours1(),
                'Id_Cert' => $Id_Cert
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function searchcertif($search_query)
    {
        // Connect to your database (replace with your database connection code)
        $db = config::getConnexion();

        // Prepare the SQL query to search for certificates
        $query = "SELECT * FROM myapp.certificat WHERE LOWER(Titre_Cert) LIKE LOWER(:search_query) OR LOWER(id_etud) LIKE LOWER(:search_query) OR Id_Cours LIKE :search_query";
        $stmt = $db->prepare($query);

        // Bind the search query parameter
        $search_param = '%' . $search_query . '%';
        $stmt->bindValue(':search_query', $search_param, PDO::PARAM_STR);

        // Execute the query
        $stmt->execute();

        // Fetch the results
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return the filtered results
        return $result;
    }
    public function sortByCriteriaCertif($criteria)
    {
        // Connectez-vous à votre base de données
        $db = config::getConnexion();

        // Définissez la requête SQL de base
        $sql = "SELECT * FROM myapp.certificat";

        // Ajoutez la clause ORDER BY en fonction du critère sélectionné
        switch ($criteria) {
            case "Id_Cert":
                $sql .= " ORDER BY Id_Cert";
                break;
            case "Date_Cert":
                $sql .= " ORDER BY Date_Cert";
                break;
            case "Titre_Cert":
                $sql .= " ORDER BY Titre_Cert";
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
}
