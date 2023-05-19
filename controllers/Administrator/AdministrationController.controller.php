<?php

require_once 'controllers/MainController.controller.php';


class AdministrationController extends MainController
{


    public function administration()
    {
        $data = [
            'view' => 'views/Administrator/administration.view.php',
            'template' => 'views/common/template.view.php',
            'page_title' => 'Administration',
            'page_description' => 'Page d\'administration',
            'menuItems' => $this->templateController->getMenuItems(),
            'page_css' => [
                'admin.css'
            ],
           
        ];
        $this->generatePage($data);
    }
}
