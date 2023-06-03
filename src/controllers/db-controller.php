<?php

class CRUD
{

    private $pdo;

    public function __construct($db)
    {
        $this->pdo = $db;
    }

    public function addUser($name, $email, $username, $password, $uuid)
    {

        $data = [$username, md5($password), $name, $email, $uuid];
        $status = 0;

        try {

            $sql = "INSERT IGNORE INTO users (login, pass, name, email, uuid) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);

            if ($stmt->rowCount() > 0) $status = 1;
            else $status = 3;
        } catch (PDOException $e) {
        }

        return $status;
    }


    public function checkLogin($username, $password)
    {

        $data = [$username, md5($password)];
        $uuid = false;

        try {

            $sql = "SELECT uuid FROM users WHERE login = ? AND pass = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results) $uuid = $results[0]['uuid'];
        } catch (PDOException $e) {
        }

        return $uuid;
    }

    public function getProfile($uuid)
    {

        $data = [$uuid];
        $profile = false;

        try {

            $sql = "SELECT 

             id_user id,
             login,
             name, 
             email,
             rank
            
             FROM users WHERE uuid = ?";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results) $profile = $results[0];
            
        } catch (PDOException $e) {
        }

        return $profile;
    }


























    
    public function getXsteamConfig()
    {

        $info = false;

        try {

            $sql = "SELECT * FROM xtream";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results) $info = $results[0];
            
        } catch (PDOException $e) {
        }

        return $info;
    }
}
