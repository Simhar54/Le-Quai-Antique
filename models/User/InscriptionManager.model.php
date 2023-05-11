<?php


require_once ("./models/MainManager.model.php");
require_once("./classes/QaUser.class.php");

class InscriptionManager extends MainManager {

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

  
}