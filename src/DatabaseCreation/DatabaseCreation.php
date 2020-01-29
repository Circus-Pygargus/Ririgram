<?php


class DatabaseCreation
{

    // Configuration de la BDD
    private string $dbHost = 'localhost';
    private string $dbRoot = 'root';
    private string $dbRootPassword = 'online@2017';

    private string $dbName = 'ririgram';
    private string $dbUser = 'ririgram-user';
    private string $dbUserPassword = 'online@2017';

    /**
     * @var PDO
     */
    protected $db;

    /**
     * PDO STATEMENT
     */
    private $sth;



    // create the database and associated user
    public function createDatabase ()
    {
        try {
            // un \ devant PDO car PDO() n'appartient pas à mon espace de nom
            $conn = new \PDO('mysql:host=' . $this->dbHost, $this->dbRoot, $this->dbRootPassword);

            // set the PDO error mode to exception
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            // create database
            $sql = "CREATE DATABASE IF NOT EXISTS `$this->dbName` DEFAULT CHARACTER SET utf8;
                CREATE USER '$this->dbUser'@'$this->dbHost' IDENTIFIED BY '$this->dbUserPassword';
                GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, INDEX, ALTER, CREATE TEMPORARY TABLES, CREATE VIEW, EVENT, TRIGGER, SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE, EXECUTE ON `$this->dbName`.* TO '$this->dbUser'@'$this->dbHost';
                FLUSH PRIVILEGES;";
            
            // use exec() because no results are returned
            $conn->exec($sql)
            or die(print_r($conn->errorInfo(), true));
            echo "Database and db user created successfully.";
        } 
        catch (\PDOException  $e) {
            die('erreur database : ' . $e->getMessage());
        }

        $conn = null;
    }



    private function connect ()
    {
        try {
            // un \ devant PDO car PDO() n'appartient pas à mon espace de nom
            $this->db = new \PDO('mysql:host=' . $this->dbHost .';dbname='. $this->dbName, $this->dbUser, $this->dbUserPassword);
        } 
        catch (\PDOException  $e) {
            die('erreur connexion database : ' . $e->getMessage());
        }
    }

    private function prepare (string $sql):void {
        $this->connect();
        $this->sth = $this->db->prepare($sql);
    }

    private function execute ():void {
        $this->sth->execute();
    }


    // Create the user table
    public function createUserTable ()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `$this->dbName`.`user` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `username` VARCHAR(20) NOT NULL,
            `email` VARCHAR(255) NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            `create_time` DATETIME NOT NULL,
            `update_time` DATETIME,
            PRIMARY KEY (`id`),
            UNIQUE INDEX `email_UNIQUE` (`email` ASC),
            UNIQUE INDEX `username_UNIQUE` (`username` ASC) )
          DEFAULT CHARACTER SET = utf8";

        $this->prepare($sql);
        $this->execute();
    }
}


$base = new DatabaseCreation();

// will create the database if not exists
$base->createDatabase();

// wil create the user table if not exists
$base->createUserTable();