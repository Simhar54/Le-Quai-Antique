<?php

require_once 'controllers/MainController.controller.php';

class ErrorController extends MainController
{


    public function errorPage($msg)
    {
        $data = [
            'view' => 'views/common/error.view.php',
            'template' => 'views/common/template.view.php',
            'msg' => $msg,
            'page_title' => 'Page d\'erreur',
            'page_description' => 'Page d\'erreur',
            'menuItems' => $this->templateController->getMenuItems(),
        ];
        $this->generatePage($data);
    }
}
