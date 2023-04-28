<?php

require_once 'controllers/MainController.controller.php';


class InscriptionController extends MainController
{


    public function inscription()
    {
        $data = [
            'view' => 'views/User/inscription.view.php',
            'template' => 'views/common/template.view.php',
            'page_title' => 'Inscription',
            'page_description' => 'Page d\'inscription',
            'menuItems' => $this->templateController->getMenuItems(),
            'page_javascript' => [
                'allergyInput.js',
                'validateForm.js'
            ],
           
        ];
        $this->generatePage($data);
    }
}
