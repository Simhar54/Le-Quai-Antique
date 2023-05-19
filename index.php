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
require_once('controllers/User/MonCompteController.controller.php');
require_once('controllers/User/ModifierCompteController.controller.php');
require_once('controllers/User/ModifierMotDePasseController.controller.php');
require_once('controllers/Administrator/AdministrationController.controller.php');


$errorController = new ErrorController();
$accueilController = new AccueilController();
$inscriptionController = new InscriptionController();
$connexionController = new ConnexionController();
$motDePasseOublieController = new MotDePasseOublieController();
$monCompteController = new MonCompteController();
$modifierCompteController = new ModifierCompteController();
$modifierMotDePasseController = new ModifierMotDePasseController();
$administrationController = new AdministrationController();


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
        case "account":
            if (!Securite::isConnected()) {
                Toolbox::addMessageAlerte("Vous devez être connecté pour accéder à cette page", Toolbox::COULEUR_ROUGE);
                header("Location:" . URL . "connexion");
                exit();
            } elseif (!Securite::checkAuthentification()) {
                Toolbox::addMessageAlerte("Veuillez vous reconnecter", Toolbox::COULEUR_ROUGE);
                header("Location:" . URL . "connexion");
                exit();
            } else {
                Securite::genererCookieConnexion();
                switch ($url[1]) {
                    case "mon_compte":
                        $monCompteController->mon_compte();
                        break;
                    case "deconnexion":
                        $monCompteController->deconnexion();
                        break;
                    case "modifier_compte":
                        $modifierCompteController->modifier_compte();
                        break;
                    case "modification_account_information":
                        $modifierCompteController->modification_account_information();
                        break;
                    case "supprimer_compte":
                        $modifierCompteController->supprimer_compte();
                        break;
                    case "modifier_mot_de_passe":
                        $modifierMotDePasseController->modifier_mot_de_passe();
                        break;
                    case "modification_password":
                        $modifierMotDePasseController->modification_password();
                        break;

                    default:
                        throw new Exception('Page introuvable');
                }
            }
            break;
        case "admin":
            if (!Securite::isConnected()) {
                Toolbox::addMessageAlerte("Vous devez être connecté pour accéder à cette page", Toolbox::COULEUR_ROUGE);
                header("Location:" . URL . "connexion");
                exit();
            } elseif (!Securite::isAdmin()) {
                Toolbox::addMessageAlerte("Vous n'avez pas les droits pour accéder à cette page", Toolbox::COULEUR_ROUGE);
                header("Location:" . URL . "connexion");
            } else {
                Securite::genererCookieConnexion();
                switch ($url[1]) {
                    case "Administration":
                        $administrationController->administration();
                        break;
                }
            }

        default:
            throw new Exception('Page introuvable');
    }
} catch (Exception $e) {
    $errorController->errorPage($e->getMessage());
}
