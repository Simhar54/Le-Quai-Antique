<?php

require_once 'controllers/MainController.controller.php';
require_once 'models/User/UserManager.model.php';
require_once 'models/User/MotDePasseOublieManager.model.php';


class MotDePasseOublieController extends MainController
{

    private $userManager;
    private $motDePasseOublieManager;

    public function __construct()
    {
        parent::__construct();


        $this->userManager = new UserManager();
        $this->motDePasseOublieManager  = new MotDePasseOublieManager();
    }


    public function mot_de_passe_oublie()
    {
        $data = [
            'view' => 'views/User/motDePasseOublie.view.php',
            'template' => 'views/common/template.view.php',
            'page_title' => 'Mot de passe oublié',
            'page_description' => 'Mod de passe oublie',
            'menuItems' => $this->templateController->getMenuItems(),
            'page_javascript' => [
                'validateForm.js'
            ],

        ];
        $this->generatePage($data);
    }

    public function send_mail_password()
    {
        $email = $_POST['email'];
        $user = new QaUser();

        try {
            $user->setEmail($email);
            //Chek if mail exist
            if ($returnUser = $this->userManager->findMail($user)) {
                $mail = $returnUser->getEmail();
                $id = $returnUser->getId();
                $token = rand(0, 9999);
                $expiration_date = date('Y-m-d H:i:s', strtotime('+1 hour'));
                $used = 0;

                //Create token
                $passwordReset = new PasswordResetToken();
                $passwordReset->setUser_Id($id);
                $passwordReset->setToken($token);
                $passwordReset->setExpiration_date($expiration_date);
                $passwordReset->setUsed($used);

                // Delete old token
                $this->motDePasseOublieManager->cleanTable($id);
                if ($this->motDePasseOublieManager->createPasswordResetEntry($passwordReset)) {

                    //send mail
                    if ($this->mailResetPassword($token, $mail)) {
                        Toolbox::addMessageAlerte("Si votre email est enregisté vous allez recevoir un mail pour réinitialiser votre mot de passe.", Toolbox::COULEUR_VERTE);
                    } else {
                        Toolbox::addMessageAlerte("Mail non envoyé.", Toolbox::COULEUR_ROUGE);
                    }
                } else {
                    Toolbox::addMessageAlerte("Une erreur s'est produite", Toolbox::COULEUR_ROUGE);
                }
                header('Location: ' . URL . 'motDePasseOublie');
            } else {
                Toolbox::addMessageAlerte("Si votre email est enregisté vous allez recevoir un mail pour réinitialiser votre mot de passe.", Toolbox::COULEUR_VERTE);
                
            }
        } catch (InvalidArgumentException $e) {
            error_log($e->getMessage());
            Toolbox::addMessageAlerte("Une erreur s'est produite", Toolbox::COULEUR_ROUGE);
        }
        header('Location: ' . URL . 'connexion');
    }

    public function mailResetPassword($token, $email)
    {
        $urlVerification = URL . "nouveauPassword/" . $token;
        $sujet = "Création de compte sur le site ";
        $message = "Pour valider votre compte veuillez cliquer sur le lien suivant " . $urlVerification;

        return Toolbox::sendMail($email, $sujet, $message);
    }

    public function nouveau_password($token)
    {
        if($this->motDePasseOublieManager->findToken($token)){
            

            $data = [
                'view' => 'views/User/nouveauPassword.view.php',
                'template' => 'views/common/template.view.php',
                'page_title' => 'Nouveau mot de passe',
                'page_description' => 'Nouveau mot de passe',
                'menuItems' => $this->templateController->getMenuItems(),
                'page_javascript' => [
                    'validateForm.js'
                ],
                'token' => $token
            ];
            $this->generatePage($data);
        } else {
            Toolbox::addMessageAlerte("Le lien n'est plus valide", Toolbox::COULEUR_ROUGE);
            header('Location: ' . URL . 'connexion');
        } 
    }

    public function change_password() {
        $token = $_POST['token'];
        $password = $_POST['password'];
        $password_crypte = password_hash($password, PASSWORD_DEFAULT);

        if($result= $this->motDePasseOublieManager->findId($token)){
            $id = $result[0];
            //Update password
                $user = new QaUser();
                try {
                    $user->setId($id);
                    $user->setPassword($password_crypte);
                    if($this->userManager->updatePassword($user)){
                        Toolbox::addMessageAlerte("Votre mot de passe a été modifié", Toolbox::COULEUR_VERTE);
                    } else {
                        Toolbox::addMessageAlerte("Une erreur s'est produite", Toolbox::COULEUR_ROUGE);
                    }

                } catch (InvalidArgumentException $e) {
                    error_log($e->getMessage());
                }
               

        } else {
            Toolbox::addMessageAlerte("Une erreur s'est produite", Toolbox::COULEUR_ROUGE);

        }

        header('Location: ' . URL . 'connexion');
    }

   
}
