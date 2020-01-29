<?php

namespace App\Service;

use App\Entity\UserEntity;


class User extends UserEntity
{

    /**
     * Add a new user
     * 
     * @param string $username
     * @param string $email
     * @param string $password
     * @param string $createTime
     * @param string $updateTime
     * 
     * @return int $id
     */
    public function add (string $username, string $email, string $password, string $createTime, string $updateTime = null):void
    {
        // Add user in db
        $sql = "INSERT INTO user(username, email, password, create_time, update_time)
            VALUES (:username, :email, :password, :create_time, :update_time)";
        $this->prepare($sql);
        $this->bindParam(':username', $username, \PDO::PARAM_STR);
        $this->bindParam(':email', $email, \PDO::PARAM_STR);
        $this->bindParam(':password', $password, \PDO::PARAM_STR);
        $this->bindParam(':create_time', $createTime, \PDO::PARAM_STR);
        $this->bindParam(':update_time', $updateTime, \PDO::PARAM_STR);
        $this->execute();
    }


    /**
     * Check if a user has been recorded
     * 
     * @param string $username
     * @param string $email
     * 
     * @return boolean
     */
    public function isUserRecorded (string $username, string $email):bool
    {
        $sql = "SELECT COUNT(id) FROM user
                WHERE username=:username AND email=:email";
        $this->prepare($sql);
        $this->bindParam(':username', $username, \PDO::PARAM_STR);
        $this->bindParam(':email', $email, \PDO::PARAM_STR);
        $this->execute();
        $resp = $this->fetchAll();
        // should be equal to 1
        if ($resp[0]['COUNT(id)'] !== 0) {
            return true;
        }
        else {
            return false;
        }
    }


    /**
     * Check if username or email already exists in db
     * 
     * @param string $username
     * @param string $email
     * 
     * @return array
     */
    public function isUserAlreadyRegistered (string $username, string $email):array
    {
        $errorflag = false;
        // username test
        $sql = "SELECT COUNT(id) FROM user
            WHERE username=:username";
        $this->prepare($sql);
        $this->bindParam(':username', $username, \PDO::PARAM_STR);
        $this->execute();
        $dbResp = $this->fetchAll();
        // this username is already used
        if ($dbResp[0]['COUNT(id)'] !== 0) {
            $errorflag = true;
            $registered['username'] = 'Ce pseudonyme est déjà utilisé.';
        }

        // email test
        $sql = "SELECT COUNT(id) FROM user
            WHERE email=:email";
        $this->prepare($sql);
        $this->bindParam(':email', $email, \PDO::PARAM_STR);
        $this->execute();
        $dbResp = $this->fetchAll();
        // this email is already used
        if ($dbResp[0]['COUNT(id)'] !== 0) {
            $errorflag = true;
            $registered['email'] = 'Cet email est déjà enregistré.';
        }

        // were there any errors ?
        if (!$errorflag) {
            $registered['general'] = 'ok';
        }
        else {
            $registered['general'] = 'Merci de ne pas choisir des identifiants déjà utilisés.';
        }

        return $registered;
    }

}