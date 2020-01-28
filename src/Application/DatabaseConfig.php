<?php

namespace App\Application;

use \Dotenv\Dotenv;


abstract class DatabaseConfig {

    /**
     * @var PDO
     */
    protected $db;


    private function config () {
        
        // chargement de phpdotenv  ( le chemin ../ est calculé depuis index.php pour trouver .env)
        $dotenv = Dotenv::createImmutable('../');
        $dotenv->load();
        

        try {
            // un \ devant PDO car PDO() n'appartient pas à mon espace de nom
            $this->db = new \PDO('mysql:host=' . getenv('HOSTNAME') . ';dbname=' . getenv('DBNAME'), getenv('USER'), getenv('PASSWORD'), [\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION,\PDO::ATTR_EMULATE_PREPARES=>false]);
        } 
        catch (\PDOException  $e) {
            die('erreur connexion database : ' . $e->getMessage());
        }
    }


    protected function connect () {
      $this->config();
    }
}