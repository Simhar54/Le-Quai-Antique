<?php

require_once 'controllers/MainController.controller.php';
require_once 'models/User/InscriptionManager.model.php';


class InscriptionController extends MainController
{
    
    private $inscriptionManager;

    public function __construct()
    {
        parent::__construct();

        
        $this->inscriptionManager = new InscriptionManager();
    }


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
    public function validate_suscribe()
    {
        $lastName = $_POST['lastName'];
        $firstName = $_POST['firstName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $guests = $_POST['guests'];
        $allergy_Array = $_POST['allergies'];
        $allergy = implode("/ ", $allergy_Array);
        $passwordCrypte = password_hash($password, PASSWORD_DEFAULT);
    
        $user = new QaUser();
        try {
            $user->setLastName($lastName);
            $user->setFirstName($firstName);
            $user->setEmail($email);
            $user->setPassword($passwordCrypte);
            $user->setGuests($guests);
            $user->setAllergy($allergy);
            $user->setRole("user");
    
            if ($this->inscriptionManager->compareEmail($user)) {
                $this->inscriptionManager->addUser($user);
                Toolbox::addMessageAlerte("Inscription réussie", Toolbox::COULEUR_VERTE);
            } else {
                Toolbox::addMessageAlerte("Email déjà utilisé", Toolbox::COULEUR_ROUGE);
            }
        } catch (InvalidArgumentException $e) {
            Toolbox::addMessageAlerte($e->getMessage(), Toolbox::COULEUR_ROUGE);
            var_dump($user);
        }
    
        header('Location: ' . URL . 'inscription');
    }
    
   

}
