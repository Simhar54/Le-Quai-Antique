<?php

require_once 'controllers/MainController.controller.php';
require_once 'models/User/ModifierMotDePasseManager.model.php';


class ModifierMotDePasseController extends MainController
{

    private $modifierMotDePasseManager;

    public function __construct()
    {
        parent::__construct();

        $this->modifierMotDePasseManager = new ModifierMotDePasseManager();
    }



    public function modifier_mot_de_passe()
    {
        $data = [
            'view' => 'views/User/modifierMotDePasse.view.php',
            'template' => 'views/common/template.view.php',
            'page_title' => 'Modifier votre mot de passe',
            'page_description' => 'Page d\'accueil',
            'menuItems' => $this->templateController->getMenuItems(),

        ];
        $this->generatePage($data);
    }

    public function modification_password()
    {
        $old_password = $_POST["old_password"];
        $password = $_POST["password"];
        $id_user = $_SESSION["user"]["id"];
        $user = new QaUser();

        if ($this->checkPassword($old_password, $id_user)) {
            if($this->modifierMotDePasseManager->updatePassword($password, $id_user)){
                Toolbox::addMessageAlerte("Votre mot de passe a bien été modifié, veuillez vous reconnecter", Toolbox::COULEUR_VERTE);
                Securite::unsetCookieConnexion();
                header("Location:" . URL . "connexion");
            } else {
                Toolbox::addMessageAlerte("Une erreur est survenue, veuillez réessayer", Toolbox::COULEUR_ROUGE);
                header("Location:" . URL . "account/modifier_mot_de_passe");}
          
        } else {
            Toolbox::addMessageAlerte("Votre ancien mot de passe est incorrect", Toolbox::COULEUR_ROUGE);
            header("Location:" . URL . "account/modifier_mot_de_passe");
        }
    }


    public function checkPassword($old_password, $id_user)
    {
        $hashedPassword = $this->modifierMotDePasseManager->getHashedPassword($id_user);


        if (password_verify($old_password, $hashedPassword)) {
            return true;
        } else {
            return false;
        }
    }
}
