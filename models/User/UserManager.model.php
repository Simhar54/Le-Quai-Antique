<?php


require_once ("./models/MainManager.model.php");
require_once("./classes/QaUser.class.php");

class UserManager extends MainManager {

    public function compareEmail(QaUser $user)
    {
        $req = "SELECT * FROM qa_user WHERE email = :email";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":email", $user->getEmail(), PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closecursor();
        return(empty($result));
    }

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

    public function findMail(QaUser $user) {
        $req = "SELECT * FROM qa_user WHERE email = :email";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":email", $user->getEmail(), PDO::PARAM_STR);
        $stmt->execute();
        $userFound = $stmt->fetch(PDO::FETCH_OBJ);
        $stmt->closeCursor();

        if($userFound) {
            $user = new QaUser(
                id: $userFound->id,
                email: $userFound->email
            );
            return $user;

        } else {
            return null;
        }
        
    }

    

    public function addUser($user) {
        
        $req = "INSERT INTO qa_user (lastName, firstName, email, password, guests, allergy, role) VALUES (:lastName, :firstName, :email, :password, :guests, :allergy, :role)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":lastName", $user->getLastName(), PDO::PARAM_STR);
        $stmt->bindValue(":firstName", $user->getFirstName(), PDO::PARAM_STR);
        $stmt->bindValue(":email", $user->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(":password", $user->getPassword(), PDO::PARAM_STR);
        $stmt->bindValue(":guests", $user->getGuests(), PDO::PARAM_INT);
        $stmt->bindValue(":allergy", $user->getAllergy(), PDO::PARAM_STR);
        $stmt->bindValue(":role", $user->getRole(), PDO::PARAM_STR);
        $stmt->execute();
        $isInserted = ($stmt->rowCount() > 0);
        $stmt->closeCursor();

        return $isInserted;
    }

    public function updatePassword($user){
        $req = "UPDATE qa_user SET password = :password WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":password", $user->getPassword(), PDO::PARAM_STR);
        $stmt->bindValue(":id", $user->getId(), PDO::PARAM_INT);
        $stmt->execute();
        $isUpdated = ($stmt->rowCount() > 0);
        $stmt->closeCursor();

        return $isUpdated;
    }

}