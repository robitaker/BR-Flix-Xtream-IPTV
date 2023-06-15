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


    public function getIDCache($id, $type)
    {

        $data = [$id, $type];

        $info = false;

        try {

            $sql = "SELECT id FROM cache_info WHERE id_video = ? AND type = ? LIMIT 1;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results) $info = $results[0];

        } catch (PDOException $e) {
            print_r($e);
        }

        return $info;
    }

    public function addCache($info)
    {

        $data = [
            $info->id, 
            $info->type, 
            $info->name, 
            $info->img,

            $info->id, 
            $info->type
        ];

        $last_id = false;

        try {

            $sql = "INSERT INTO cache_info (id_video, type, name, img)
            SELECT ?, ?, ?, ?
            WHERE NOT EXISTS (
                SELECT 1
                FROM cache_info
                WHERE id_video = ? AND type = ?
                LIMIT 1
            );";

            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);

            if ($stmt->rowCount() > 0 ) {
                $last_id = $this->pdo->lastInsertId();
            }

        } catch (PDOException $e) {
            print_r($e);
        }

        return $last_id;
    }


    public function addList($info, $id_profile)
    {

        $data = [
            $id_profile, 
            $info->id, 
            $info->type
        ];

        $status = false;

        try {

            $sql = "INSERT IGNORE INTO favorites (id_user, id_video, type) VALUES (?, ?, ?)";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);

            $status = $stmt->rowCount() > 0 ? true : false;

        } catch (PDOException $e) {
            print_r($e);
        }

        return $status;
    }



    public function removeList($id, $type, $id_profile)
    {

        $data = [$id_profile, $id, $type];

        $status = false;

        try {

            $sql = "DELETE FROM favorites WHERE id_user = ? AND id_video = ? AND type = ? LIMIT 1;";
            
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
            $type,

            $id_profile,
            $id
        ];

        $results = false;

        try {

            $sql = "SELECT 
            (SELECT cache_info.id AS favorite
             FROM favorites
             JOIN cache_info ON favorites.id_video = cache_info.id_video AND favorites.type = cache_info.type
             WHERE favorites.id_user = ? 
               AND favorites.id_video = ? 
               AND favorites.type = ?

            ) AS favorite ,

            (
            SELECT JSON_ARRAYAGG(JSON_OBJECT('id', id, 'ep', id_ep, 'type', type, 'checkpoint', checkpoint))
            FROM watched
            WHERE id_user = ? AND id_video = ?
            
            ) AS watched;";



 
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            print_r($e->getMessage());
        }

        return $results;
    }





    public function addWatch($profile, $id, $id_ep, $type)
    {

        $data = [
            $profile, 
            $id,
            $id_ep,
            $type,

            $profile, 
            $id,
            $id_ep,
            $type
        ];

        $last_id = false;

        try {

            $sql = "INSERT INTO watched (id_user, id_video, id_ep, type)
            SELECT ?, ?, ?, ?
            WHERE NOT EXISTS (
                SELECT 1
                FROM watched
                WHERE id_user = ? AND id_video = ? AND id_ep = ? AND type = ?
                LIMIT 1
            );";


            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);

            if ($stmt->rowCount() > 0 ) {
                $last_id = $this->pdo->lastInsertId();
            }

        } catch (PDOException $e) {
            print_r($e);
        }

        return $last_id;
    }



    public function setCheckpoint($profile, $id, $checkpoint)
    {

        $data = [
            $checkpoint,
            $id,
            $profile
        ];

        $status = false;

        try {

            $sql = "UPDATE watched SET checkpoint = ? WHERE id = ? AND id_user = ?;";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);

            $status = $stmt->rowCount() > 0 ? true : false;

        } catch (PDOException $e) {
            print_r($e);
        }

        return $status;
    }


    public function getProfileData($id_profile)
    {

        $data = [$id_profile, $id_profile];

        $results = false;

        try {

            $sql = "SELECT 
            (
              SELECT JSON_ARRAYAGG(JSON_OBJECT('id', c.id_video, 'type', c.type, 'name', c.name, 'img', c.img))
              FROM (
                SELECT c.id_video, c.type, c.name, c.img
                FROM cache_info c
                JOIN favorites f ON c.id_video = f.id_video AND c.type = f.type AND f.id_user = ?
                GROUP BY c.id_video, c.type, c.name, c.img
                ORDER BY MAX(f.id) DESC
              ) AS c
            ) AS list,
            (
              SELECT JSON_ARRAYAGG(JSON_OBJECT('id', w.id_video, 'type', w.type, 'name', w.name, 'img', w.img))
              FROM (
                SELECT c.id_video, MIN(c.type) AS type, MIN(c.name) AS name, MIN(c.img) AS img
                FROM cache_info c
                JOIN watched w ON c.id_video = w.id_video AND c.type = w.type AND w.id_user = ?
                GROUP BY c.id_video
                ORDER BY MAX(w.id) DESC
                LIMIT 30
              ) AS w
            ) AS watched; ";

            

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $results = $results[0];

        } catch (PDOException $e) {
            print_r($e->getMessage());
        }

        return $results;
    }

    
    public function getRecentsVideos($id_profile)
    {

        $data = [$id_profile];

        $results = false;

        try {

            $sql = "SELECT id_video id, type, name, img 
             FROM (
                SELECT c.id_video, MIN(c.type) AS type, MIN(c.name) AS name, MIN(c.img) AS img
                FROM cache_info c
                JOIN watched w ON c.id_video = w.id_video AND c.type = w.type AND w.id_user = ?
                GROUP BY c.id_video
                ORDER BY MAX(w.id) DESC
                LIMIT 30
              ) AS w
            ";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            print_r($e->getMessage());
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
