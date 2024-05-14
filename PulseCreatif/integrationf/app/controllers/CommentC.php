<?php

require_once(__DIR__ . "/../../config/config.php");

class CommentC
{
    function listComments()
    {
        $sql = "SELECT c.*, p.title AS post_title , u.USER_NAME as USER_NAME
        FROM comment c inner JOIN table_user u on c.authorC = u.USER_ID
        LEFT JOIN post p ON c.id_post = p.id_post";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $comments = $query->fetchAll();
            return $comments;
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }







    function addComment($comment)
    {
        $sql = "INSERT INTO comment (id_post, authorC, contentC) VALUES (:id_post, :authorC, :contentC)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_post' => $comment->getId_post(),
                'authorC' => $comment->getAuthorC(),
                'contentC' => $comment->getContentC()
            ]);
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function updateComment($comment)
    {
        $sql = "UPDATE comment SET id_post=:id_post, authorC=:authorC, contentC=:contentC WHERE id_comment=:id_comment";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_comment' => $comment->getId_comment(),
                'id_post' => $comment->getId_post(),
                'authorC' => $comment->getAuthorC(),
                'contentC' => $comment->getContentC()
            ]);
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteComment($id)
    {
        $sql = "DELETE FROM comment WHERE id_comment=:id_comment";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id_comment' => $id]);
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function getCommentById($id)
    {
        $sql = "SELECT * FROM comment WHERE id_comment=:id_comment";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id_comment' => $id]);
            $comment = $query->fetch();
            return $comment;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }





    function listCommentsWithCount() 
    {
        $sql = "SELECT id_post, COUNT(*) AS comment_count FROM comment GROUP BY id_post";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $commentsWithCount = $query->fetchAll(PDO::FETCH_ASSOC);
            return $commentsWithCount;
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }




}

?>