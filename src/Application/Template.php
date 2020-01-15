<?php

namespace App\Application;

// un \ car Twig ne fait pas partie de notre namespace (Twig n'est pas dans notre dossier src)
use \Twig_Loader_Filesystem;
use \Twig_Environment;

class Template {

        // on peut définir soit public, private ou protected
        private const PATH = "../templates";


        // ici le 2eme * dans /** sert à afficher des comm utilisables par l'extension PHP_Intephense
        /**
        * @var Twig_Loader_Filesystem
        */
        private $loader;

        /**
        * @var Twig_Environment
        */
        private $template;

        // automatiquement lancée à chaque instanciation de la classe
        public function __construct () {
            // self:: car on va chercher dans le même fichier
            $this->loader = new Twig_Loader_Filesystem(self::PATH);

            $this->template = new Twig_Environment(
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
}