<?php

namespace App\Application;

// un \ car Twig ne fait pas partie de notre namespace (Twig n'est pas dans notre dossier src)
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;

class Template {

        // on peut définir soit public, private ou protected
        private const PATH = [
            "../templates",
            "../templates/security"
        ];


        // ici le 2eme * dans /** sert à afficher des comm utilisables par l'extension PHP_Intephense
        /**
        * @var FilesystemLoader
        */
        private $loader;

        /**
        * @var Environment
        */
        private $template;

        // automatiquement lancée à chaque instanciation de la classe
        public function __construct () {
            // self:: car on va chercher dans le même fichier
            $this->loader = new FilesystemLoader(self::PATH);

            $this->template = new Environment(
                $this->loader,
                array(
                    // on ne veut pas de système de cache avec twig
                    'cache' => false
                )
            );
        }


        // en php on déclare le retour de la fonction juste après les paramètres
        public function render (string $path, array $params = []):string {
            return $this->template->render(
                $path,
                $params
            );
        }

        public function renderBlock( string $path, string $block, $params = [] ):string
        {
            $templateLoad = $this->template->load( $path );      
            return $templateLoad->renderBlock( $block, $params );
        }
        
        public function load (string $path, array $params =  []) {
            return $this->template->load(
                $path
            );
        }
}