<?php

require_once 'controllers/MainController.controller.php';
require_once 'models/User/ModifierCompteManager.model.php';
require_once("./models/User/UserManager.model.php");



class ModifierCompteController extends MainController
{

    private $modifierCompteManager;
    private $userManager;

    public function __construct()
    {
        parent::__construct();

        $this->modifierCompteManager = new ModifierCompteManager();
        $this->userManager = new UserManager();
    }




    public function modifier_compte()
    {
        $id_user = $_SESSION['user']['id'];
        $user = $this->getUserInfo($id_user);
        $user->allergy = explode('/', $user->allergy);

        $id_input = count($user->allergy) + 1;



        $data = [
            'view' => 'views/User/modifierCompte.view.php',
            'template' => 'views/common/template.view.php',
            'page_title' => 'Modification du compte',
            'page_description' => 'Modification du compte',
            'menuItems' => $this->templateController->getMenuItems(),
            'user' => $user,
            'page_javascript' => [
                'validateForm.js',
                'allergyInput.js',
            ],
            'id_input' => $id_input,

        ];
        $this->generatePage($data);
    }

    public function getUserInfo($id_user)
    {
        $user = new QaUser();
        $user = $this->userManager->getUserInfo($id_user);
        return $user;
    }


    public function modification_account_information()
    {
        $lastName = $_POST['lastName'];
        $firstName = $_POST['firstName'];
        $email = $_POST['email'];
        $guests = $_POST['guests'];
        $allergy_Array = $_POST['allergies'];
        $allergy_Array = array_filter($allergy_Array);  // Remove empty elements
        $allergy = implode("/ ", $allergy_Array);

        $id_user = $_SESSION['user']['id'];
        $mail_user = $this->modifierCompteManager->getUserMail($id_user);

        $user = new QaUser();
        try {
            $user->setLastName($lastName);
            $user->setFirstName($firstName);
            $user->setEmail($email);
            $user->setGuests($guests);
            $user->setAllergy($allergy);

            if ($mail_user->email != $email) {
                if (!$this->userManager->compareEmail($user)) {
                    Toolbox::addMessageAlerte("Cette adresse mail est déjà utilisée.", Toolbox::COULEUR_ROUGE);
                    header('Location: ' . URL . 'account/modifier_compte');
                    return;
                }
            }
            
           if( $this->modifierCompteManager->updateUser($user, $id_user)){
            Toolbox::addMessageAlerte("Votre compte a bien été modifié.", Toolbox::COULEUR_VERTE);
            header('Location: ' . URL . 'account/mon_compte');
           } else {
            Toolbox::addMessageAlerte("Erreur lors de la modification du compte", Toolbox::COULEUR_ROUGE);
            header('Location: ' . URL . 'account/modifier_compte');
           }
           
            
        } catch (InvalidArgumentException $e) {
            error_log($e->getMessage());
            Toolbox::addMessageAlerte("Erreur lors de l'inscription", Toolbox::COULEUR_ROUGE);
        }
    }
}
