<?php

require_once(__DIR__ . "/../../config/config.php");

class UserController
{
    public static function listUsers()
    {
        $db = config::getConnexion();
        $sql = "SELECT * from myapp.TABLE_USER";
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $result = $query->fetchAll();
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }

        return $result;
    }
    public static function listStudents()
    {
        $db = config::getConnexion();
        $sql = "SELECT * from myapp.TABLE_USER WHERE USER_ROLE=2";
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $result = $query->fetchAll();
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }

        return $result;
    }
    public function deleteUser($id)
    {
        $sql = "DELETE FROM myapp.TABLE_USER WHERE USER_ID = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addUser($user)
    {
        $sql = "INSERT INTO myapp.TABLE_USER (USER_EMAIL, USER_PHONENUM, USER_NAME, USER_PASSWORD)
        VALUES (:email, :phone, :name, :password)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'email' => $user->getEmail(),
                'name' => $user->getName(),
                'phone' => $user->getPhone(),
                'password' => $user->getPassword()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updateUser($user, $id)
    {
        $sql = "UPDATE myapp.TABLE_USER SET USER_EMAIL = :email, USER_PHONENUM = :phone, USER_ROLE = :role, USER_NAME = :name, USER_PASSWORD = :password WHERE USER_ID= :id";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id,
                'phone' => $user->getPhone(),
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'role' => $user->getRole(),
                'password' => $user->getPassword()
            ]);
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    function showUser($id)
    {
        $sql = "SELECT * from myapp.TABLE_USER where USER_ID = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $user = $query->fetch();
            return $user;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function showUser_byName($username)
    {
        $sql = "SELECT * from myapp.TABLE_USER where USER_NAME = '$username'";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $user = $query->fetch();
            return $user;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
