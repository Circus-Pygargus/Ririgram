<?php

namespace App\Application;

use Dotenv\Dotenv;

class DatabaseConfig {

    /**
     * @var PDO
     */
    public $db;


    private function config () {
        // chargement de phpdotenv  ( le chemin ../ est calculé depuis index.php pour trouver .env)
        $dotenv = \Dotenv\Dotenv::create('../');
        $dotenv->load();
        

        try {
            // un \ devant PDO car PDO() n'appartient pas à mon espace de nom
            $this->db = new \PDO
                ('mysql:host=' . getenv('HOSTNAME') . ';
                dbname=' . getenv('DBNAME'), getenv('USER'), getenv('PASSWORD'));
        } 
        catch (exception $e) {
            die('erreur : ' . $e->get->message());
        }
    }


    public function connect () {
      $this->config();
    }
}