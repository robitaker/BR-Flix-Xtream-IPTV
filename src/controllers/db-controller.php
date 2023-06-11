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

            $sql = "SELECT id_user AS id, login, name, email, level FROM  users WHERE uuid = ?;";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results) $profile = $results[0];
        } catch (PDOException $e) {
        }

        return $profile;
    }


    public function addList($info, $id_profile)
    {

        $data = [
            $id_profile, 
            $info->id, 
            $info->type, 
            $info->name, 
            $info->img,

            $info->id,
            $id_profile
        ];

        $status = false;

        try {

            $sql = "INSERT INTO favorites (id_user, id_video, type, name, img)
            SELECT ?, ?, ?, ?, ?
            WHERE NOT EXISTS (
                SELECT 1
                FROM favorites
                WHERE id_video = ? AND id_user = ?
                LIMIT 1
            );";

            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);

            $status = $stmt->rowCount() > 0 ? true : false;

        } catch (PDOException $e) {
            print_r($e);
        }

        return $status;
    }


    public function getDetailsVideo($id, $type, $id_profile)
    {

        $data = [
            $id_profile,
            $id, 
            $type
        ];

        $results = false;

        try {

            $sql = "SELECT (SELECT COUNT(id) FROM favorites WHERE id_user = ? AND id_video = ? AND type = ?) AS favorite";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);


        } catch (PDOException $e) {
            
        }

        return $results;
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
