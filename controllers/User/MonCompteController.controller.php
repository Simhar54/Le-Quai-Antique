<?php

require_once 'controllers/MainController.controller.php';
require_once ("./models/User/UserManager.model.php");


class MonCompteController extends MainController
{
    
   
    private $userManager;

    public function __construct()
    {
        parent::__construct();

        $this->userManager = new UserManager();
    }


    public function mon_compte()
    {

        $id_user = $_SESSION['user']['id'];
        $user = $this->getUserInfo($id_user);

        $user->allergy = explode("/ ", $user->allergy);
        
        $data = [
            'view' => 'views/User/monCompte.view.php',
            'template' => 'views/common/template.view.php',
            'page_title' => 'Profil',
            'page_description' => 'Page de profil',
            'menuItems' => $this->templateController->getMenuItems(), 
            'user' => $user,  
        ];
        $this->generatePage($data);
    }   


    public function getUserInfo($id_user) {
        $user = new QaUser();
        $user = $this->userManager->getUserInfo($id_user);
        return $user;
        
    }

    public function deconnexion()
    {
        unset($_SESSION['user']);
        Securite::unsetCookieConnexion();
        Toolbox::addMessageAlerte("Vous êtes déconnecté(e).", Toolbox::COULEUR_VERTE);
        header('Location: ' . URL. 'accueil');

    }
    
}