<?php

require_once 'controllers/MainController.controller.php';


class AccueilController extends MainController
{


    public function accueil()
    {
        $data = [
            'view' => 'views/User/accueil.view.php',
            'template' => 'views/common/template.view.php',
            'page_title' => 'Accueil',
            'page_description' => 'Page d\'accueil',
            'menuItems' => $this->templateController->getMenuItems(),
        ];
        $this->generatePage($data);
    }
}
