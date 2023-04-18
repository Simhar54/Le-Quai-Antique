<?php
session_start();


define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://" . $_SERVER['HTTP_HOST'] . $_SERVER["PHP_SELF"]));


require_once('controllers/Common/ErrorController.controller.php');
require_once('controllers/User/AccueilController.controller.php');

$errorcontroller = new ErrorController();
$accueilcontroller = new AccueilController();



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
        default:
            throw new Exception('Page introuvable');
    }
} catch (Exception $e) {
    $errorcontroller->errorPage($e->getMessage());
}
