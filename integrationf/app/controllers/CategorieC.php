<?php

require_once(__DIR__ . "/../../config/config.php");

class CategorieC
{
    function listCategories() 
    {
        $sql = "SELECT * FROM categorie";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $categories = $query->fetchAll();
            return $categories;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function addCategory($category)
    {
        $sql = "INSERT INTO categorie (ID_Categorie, Nom_Categorie, Description_Categorie) VALUES (:ID_Categorie, :Nom_Categorie, :Description_Categorie)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'ID_Categorie' => $category->getID_Categorie(),
                'Nom_Categorie' => $category->getNom_Categorie(),
                'Description_Categorie' => $category->getDescription_Categorie()
            ]);
    
            $actionType = 'ajout';
            $tableConcernee = 'categorie';
            $idLigneModifiee = $db->lastInsertId();
            $utilisateurId = 123;
    
            HistoriqueDAO::addHistorique($actionType, $tableConcernee, $idLigneModifiee, $utilisateurId);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    

    function updateCategory($category)
    {
        $sql = "UPDATE categorie SET Nom_Categorie=:Nom_Categorie, Description_Categorie=:Description_Categorie WHERE ID_Categorie=:ID_Categorie";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'ID_Categorie' => $category->getID_Categorie(),
                'Nom_Categorie' => $category->getNom_Categorie(),
                'Description_Categorie' => $category->getDescription_Categorie()
            ]);
    
            $actionType = 'modification';
            $tableConcernee = 'categorie';
            $idLigneModifiee = $category->getID_Categorie();
            $utilisateurId = 123;
    
            HistoriqueDAO::addHistorique($actionType, $tableConcernee, $idLigneModifiee, $utilisateurId);
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    
    function deleteCategory($ID_Categorie)
    {
        $sql = "DELETE FROM categorie WHERE ID_Categorie=:ID_Categorie";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['ID_Categorie' => $ID_Categorie ]);
    
            $actionType = 'suppression';
            $tableConcernee = 'categorie';
            $idLigneModifiee = $ID_Categorie;
            $utilisateurId = 123;
    
            HistoriqueDAO::addHistorique($actionType, $tableConcernee, $idLigneModifiee, $utilisateurId);
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    

    function getCategoryById($ID_Categorie)
    {
        $sql = "SELECT * FROM categorie WHERE ID_Categorie=:ID_Categorie";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['ID_Categorie' => $ID_Categorie ]);
            $category = $query->fetch();
            return $category;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function listCategoriesSortedByName() 
    {
        $sql = "SELECT * FROM categorie ORDER BY Nom_Categorie";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $categories = $query->fetchAll();
            return $categories;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
}

?>
