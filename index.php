<?php
session_start();


define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://" . $_SERVER['HTTP_HOST'] . $_SERVER["PHP_SELF"]));


require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once('controllers/Toolbox.php');
require_once('controllers/Securite.php');
require_once('controllers/Common/ErrorController.controller.php');
require_once('controllers/User/AccueilController.controller.php');
require_once('controllers/User/InscriptionController.controller.php');
require_once('controllers/User/ConnexionController.controller.php');
require_once('controllers/User/MotDePasseOublieController.controller.php');


$errorController = new ErrorController();
$accueilController = new AccueilController();
$inscriptionController = new InscriptionController();
$connexionController = new ConnexionController();
$motDePasseOublieController = new MotDePasseOublieController();



try {
    if (empty($_GET['page'])) {
        $page = 'accueil';
    } else {
        $url = explode('/', filter_var($_GET['page'], FILTER_SANITIZE_URL));
        $page = $url[0];
    }


    switch ($page) {
        case 'accueil':
            $accueilController->accueil();
            break;
        case 'inscription':
            $inscriptionController->inscription();
            break;
        case 'validate_suscribe':
            $inscriptionController->validate_suscribe();
            break;
        case 'connexion':
            $connexionController->connexion();
            break;
        case 'validate_connexion':
            $connexionController->validate_connexion();
            break;
            case "motDePasseOublie":
            $motDePasseOublieController->mot_de_passe_oublie();
            break;
        case "send_mail_password":
            $motDePasseOublieController->send_mail_password();
            break;
            case "nouveauPassword":
            $motDePasseOublieController->nouveau_password($url[1]);
            break;
         case "change_password":
            $motDePasseOublieController->change_password();
            break;
        default:
            throw new Exception('Page introuvable');
    }
} catch (Exception $e) {
    $errorController->errorPage($e->getMessage());
}
