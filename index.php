<?php
session_start();


define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://" . $_SERVER['HTTP_HOST'] . $_SERVER["PHP_SELF"]));


require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once('controllers/Toolbox.php');
require_once('controllers/Common/ErrorController.controller.php');
require_once('controllers/User/AccueilController.controller.php');
require_once('controllers/User/InscriptionController.controller.php');
require_once('controllers/User/ConnexionController.controller.php');


$errorcontroller = new ErrorController();
$accueilcontroller = new AccueilController();
$inscriptioncontroller = new InscriptionController();
$connexioncontroller = new ConnexionController();



try {
    if (empty($_GET['page'])) {
        $page = 'accueil';
    } else {
        $url = explode('/', filter_var($_GET['page'], FILTER_SANITIZE_URL));
        $page = $url[0];
    }


    switch ($page) {
        case 'accueil':
            $accueilcontroller->accueil();
            break;
        case 'inscription':
            $inscriptioncontroller->inscription();
            break;
        case 'validate_suscribe':
            $inscriptioncontroller->validate_suscribe();
            break;
        case 'connexion':
            $connexioncontroller->connexion();
            break;
        default:
            throw new Exception('Page introuvable');
    }
} catch (Exception $e) {
    $errorcontroller->errorPage($e->getMessage());
}
