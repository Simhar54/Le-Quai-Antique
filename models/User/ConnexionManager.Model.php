<?php


require_once ("./models/MainManager.model.php");
require_once("./classes/QaUser.class.php");

class ConnexionManager extends MainManager {

   
    public function validateCredentials(QaUser $user)
{
    $req = "SELECT * FROM qa_user WHERE email = :email";
    $stmt = $this->getBdd()->prepare($req);
    $stmt->bindValue(":email", $user->getEmail(), PDO::PARAM_STR);
    $stmt->execute();
    $userFound = $stmt->fetch(PDO::FETCH_OBJ);
    $stmt->closeCursor();

    if ($userFound && password_verify($user->getPassword(), $userFound->password)) {      
        $loggedInUser = new QaUser(
            id :$userFound->id,
            lastName: $userFound->lastName,
            firstName: $userFound->firstName,
            role: $userFound->role
        );
        return $loggedInUser;
    } else {
        return null;
    }
}



}