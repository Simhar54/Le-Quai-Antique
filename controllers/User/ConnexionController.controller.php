<?php

require_once 'controllers/MainController.controller.php';
require_once 'models/User/UserManager.model.php';


class ConnexionController extends MainController
{

    private $userManager;

    public function __construct()
    {
        parent::__construct();

        $this->userManager = new UserManager();
    }


    public function connexion()
    {
        $data = [
            'view' => 'views/User/connexion.view.php',
            'template' => 'views/common/template.view.php',
            'page_title' => 'Connexion',
            'page_description' => 'Page de connexion',
            'menuItems' => $this->templateController->getMenuItems(),
            'page_javascript' => [
                'validateForm.js'
            ],

        ];
        $this->generatePage($data);
    }


    public function validate_connexion()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new QaUser();
        try {
            $user->setEmail($email);
            $user->setPassword($password);
            $loggedInUser = $this->userManager->validateCredentials($user);

            if ($loggedInUser !== null) {
                $_SESSION["user"] = [
                    "id" => $loggedInUser->getId(),
                    "role" => $loggedInUser->getRole()
                ];
                Securite::genererCookieConnexion();
                $lastname = htmlspecialchars($loggedInUser->getLastName());
                $name = htmlspecialchars($loggedInUser->getFirstName());



                Toolbox::addMessageAlerte("Connexion réussie, bienvenu " . $lastname . " " . $name . ".", Toolbox::COULEUR_VERTE);
            } else {
                Toolbox::addMessageAlerte("Email ou mot de passe incorrect
                <p class='mt-2'>Vous avez oublier votre mot de passe <a href='motDePasseOublie' class='qa_link'>Cliquez ici!</a> </p> ", Toolbox::COULEUR_ROUGE);
            }
        } catch (InvalidArgumentException $e) {
            error_log($e->getMessage());
            Toolbox::addMessageAlerte("Une erreur s'est produite.", Toolbox::COULEUR_ROUGE);
        }
        header("Location:" . URL . "connexion");
    }
}
