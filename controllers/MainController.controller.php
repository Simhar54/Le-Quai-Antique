<?php

require_once 'controllers/Common/TemplateController.controller.php';

abstract class MainController
{

    protected $templateController;

    public function __construct()
    {
        $this->templateController = new TemplateController();
    }


    protected function generatePage($data)
    {
        extract($data);
        ob_start();
        require_once($view);
        $page_content = ob_get_clean();
        require_once($template);
    }
}
