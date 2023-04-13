<?php

require_once 'controllers/MainController.controller.php';

class VisitorController extends MainController
{
    public function accueil()
    {
        $data = [
            'view' => 'views/Visitor/accueil.view.php',
            'template' => 'views/common/template.view.php',
            'page_title' => 'Accueil',
            'page_description' => 'Page d\'accueil',
        ];
        $this->generatePage($data);
    }
}
