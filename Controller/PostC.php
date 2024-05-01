<?php
require_once 'C:\xampp\htdocs\skillpulse\config.php'; // Include the config.php file
class PostC
{

    function listPosts() 
    {
        $sql = "SELECT * FROM post";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $posts = $query->fetchAll();
            return $posts;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
   



    function searchPostsByKeyword($keyword)
    {
        $sql = "SELECT * FROM post WHERE title LIKE :keyword OR contentP LIKE :keyword OR author LIKE :keyword";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':keyword', '%' . $keyword . '%');
            $query->execute();
            $posts = $query->fetchAll();
            return $posts;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function countPosts(){

        $sql = "SELECT count(id_post) FROM post";
        $db = config::getConnexion();
        try{
            $query = $db->query($sql);
            $query->execute();
            $postCount =$query->fetchColumn();
            return $postCount;
        }
        catch(Exception $e){
            die('Error: '.$e->getMessage());
        }   

    }




    function getPostById($id_post)
    {
        $sql = "SELECT * FROM post WHERE id_post=:id_post";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id_post' => $id_post]);
            $post = $query->fetch();
            return $post;
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    
    function addPost($post)
    {
        $sql = "INSERT INTO post (title, contentP, author, date_created, img) VALUES (:title, :contentP, :author, :date_created, :img)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'title' => $post->getTitle(),
                'contentP' => $post->getContentP(),
                'author' => $post->getAuthor(),
                'date_created' => $post->getDate_created(),
                'img' => $post->getImg() // Assuming getImg() returns the image data
            ]);
            $post->setId_post($db->lastInsertId());
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
    function updatePost($post)
    {
        $sql = "UPDATE post SET title=:title, contentP=:contentP, author=:author, date_created=:date_created WHERE id_post=:id_post";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_post' => $post->getId_post(),
                'title' => $post->getTitle(),
                'contentP' => $post->getContentP(),
                'author' => $post->getAuthor(),
                'date_created' => $post->getDate_created(),
            ]);
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
    

      


        function deletePost($id)
        {
            $sql = "DELETE FROM post WHERE id_post=:id_post";
            $db = config::getConnexion();
            try {
                $query = $db->prepare($sql);
                $query->execute(['id_post' => $id]);
            } catch (PDOException $e) {
                die('Error: ' . $e->getMessage());
            }
        }

  





}

?>
