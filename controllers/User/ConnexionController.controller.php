<?php

require_once 'controllers/MainController.controller.php';



class ConnexionController extends MainController
{
    


    public function __construct()
    {
        parent::__construct();

        
        
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
   
   

}
