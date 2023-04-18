<?php


require_once 'models/Common/TemplateManager.model.php';

class TemplateController
{


    public function getMenuItems()
    {
        $templatemanager = new TemplateManager();
        $menuItems = $templatemanager->getMenuItems();
        return $menuItems;
    }
}
