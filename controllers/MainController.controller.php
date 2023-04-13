<?php

abstract class MainController
{
    protected function generatePage($data)
    {
        extract($data);
        ob_start();
        require_once($view);
        $page_content = ob_get_clean();
        require_once($template);
    }

    public function errorPage($msg)
    {
        $data = [
            'view' => 'views/common/error.view.php',
            'template' => 'views/common/template.view.php',
            'msg' => $msg,
            'page_title' => 'Page d\'erreur',
            'page_description' => 'Page d\'erreur',
        ];
        $this->generatePage($data);
    }
}
