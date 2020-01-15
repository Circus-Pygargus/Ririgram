<?php 

// dirname(__DIR) retourne le chemin indiqué dans apache2.cof
require_once dirname(__DIR__). '/vendor/autoload.php';

$router = new AltoRouter();
/*
    ici les mots /, /produits, /a-propos et /contact sont lus dans l'url en méthode GET
    'c' donne le nom de la classe Controller appelée
    'a' donne le nom de la méthode de la classe ci-dessus
*/
/**
 * Routes
 */
$router->map('GET', '/', array('c' => 'DefaultController', 'a' => 'index'));


/**
 * Router
 */
$match = $router->match();
$controller = 'App\\Controller\\' . $match['target']['c'];
$action = $match['target']['a'];

// instancier l'objet d'après l'url
$object = new $controller();
// ['params'] correspond à ce qu'il y a après /produit/delete/ dans l'url
if (count($match['params']) === 0) {
    $print = $object->{$action}();
}
else {
    $print = $object->{$action}($match['params']);
}

echo $print;
