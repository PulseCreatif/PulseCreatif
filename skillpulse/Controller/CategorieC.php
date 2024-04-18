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
        $sql = "INSERT INTO categorie (ID_Categorie_Primaire, Nom_Categorie, Description_Categorie) VALUES (:ID_Categorie_Primaire, :Nom_Categorie, :Description_Categorie)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'ID_Categorie_Primaire' => $category->getID_Categorie_Primaire(),
                'Nom_Categorie' => $category->getNom_Categorie(),
                'Description_Categorie' => $category->getDescription_Categorie()
            ]);
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function updateCategory($category)
    {
        $sql = "UPDATE categorie SET Nom_Categorie=:Nom_Categorie, Description_Categorie=:Description_Categorie WHERE ID_Categorie_Primaire=:ID_Categorie_Primaire";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'ID_Categorie_Primaire' => $category->getID_Categorie_Primaire(),
                'Nom_Categorie' => $category->getNom_Categorie(),
                'Description_Categorie' => $category->getDescription_Categorie()
            ]);
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteCategory($id)
    {
        $sql = "DELETE FROM categorie WHERE ID_Categorie_Primaire=:ID_Categorie_Primaire";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['ID_Categorie_Primaire' => $id]);
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function getCategoryById($id)
    {
        $sql = "SELECT * FROM categorie WHERE ID_Categorie_Primaire=:ID_Categorie_Primaire";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['ID_Categorie_Primaire' => $id]);
            $category = $query->fetch();
            return $category;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
}

?>
