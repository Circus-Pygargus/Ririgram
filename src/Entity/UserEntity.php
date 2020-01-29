<?php

namespace App\Entity;

use App\Application\Database;

abstract class UserEntity extends Database
{

    // Properties

    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $username;

    /**
     * @var string
     */
    private string $email;

    /**
     * @var string
     */
    private string $password;

    /**
     * @var string
     */
    private string $createTime;

    /**
     * @var string
     */
    private string $updateTime;

    

    // Getters and Setters

    /**
     * Get the value of id
     * 
     * @return int
     */
    public function getId ():int
    {
        return $this->id;
    }

    /**
     * Set the vaue of id
     * 
     * @param  int  $id
     *
     * @return  void
     */
    public function setId (int $id):void
    {
        $this->id = $id;
    }
   

    /**
     * Get the value of username
     * 
     * @return string
     */
    public function getUsername ():string
    {
        return $this->username;
    }

    /**
     * Set the value of username
     * 
     * @param string $username
     * 
     * @return void
     */
    public function setUsername (string $username):void
    {
        $this->username = $username;
    }
   

    /**
     * Get the value of email
     * 
     * @return string
     */
    public function getEmail ():string
    {
        return $this->email;
    }
 
    /**
     * Set the value of email
     * 
     * @param string $email
     * 
     * @return void
     */
    public function setEmail (string $email):void
    {
        $this->email = $email;
    }


    /**
     * Get the value of password
     * 
     * @return string
     */
    public function getPassword ():string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     * 
     * @param string
     * 
     * @return void
     */
    public function setPassword (string $password):void
    {
        $this->password = $password;
    }


    /**
     * Get the value of account creation datetime
     * 
     * @return string
     */
    public function getCreateTime ():string
    {
        return $this->createTime;
    }

    /**
     * Set the value of account creation datetime
     * 
     * @param string
     * 
     * @return void
     */
    public function setCreateTime (string $createTime):void
    {
        $this->createTime = $createTime;
    }


    /**
     * Get the value of account creation datetime
     * 
     * @return string
     */
    public function getUpdateTime ():string
    {
        return $this->updateTime;
    }

    /**
     * Set the value of account creation datetime
     * 
     * @param string
     * 
     * @return void
     */
    public function setUpdateTime (string $updateTime):void
    {
        $this->updateTime = $updateTime;
    }
}