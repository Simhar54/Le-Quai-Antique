<?php

require_once 'controllers/MainController.controller.php';
require_once 'models/User/UserManager.model.php';


class MotDePasseOublieController extends MainController
{
    
    private $userManager;

    public function __construct()
    {
        parent::__construct();

        
        $this->userManager = new UserManager();
    }


    public function mot_de_passe_oublie()
    {
        $data = [
            'view' => 'views/User/motDePasseOublie.view.php',
            'template' => 'views/common/template.view.php',
            'page_title' => 'Mot de passe oublié',
            'page_description' => 'Mod de passe oublie',
            'menuItems' => $this->templateController->getMenuItems(),
            'page_javascript' => [
                'validateForm.js'
            ],
           
        ];
        $this->generatePage($data);
    }


}