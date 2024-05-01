<?php
require_once 'C:\xampp\htdocs\skillpulse\config.php'; // Include the config.php file
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
            // Optionally, you can return the ID of the inserted row
            // return $db->lastInsertId();
        } catch (PDOException $e) {
            // Handle PDO exceptions
            // For example, you can log the error or display a message to the user
            echo 'Error: ' . $e->getMessage();
        } catch (Exception $e) {
            // Handle other exceptions
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
}

?>
