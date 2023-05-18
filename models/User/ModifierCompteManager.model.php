<?php 

require_once ("./models/MainManager.model.php");
require_once("./classes/QaUser.class.php");


class ModifierCompteManager extends MainManager {

   public function getUserMail($id_user) {
    $req = "SELECT email FROM qa_user WHERE id = :id_user";
    $stmt = $this->getBdd()->prepare($req);
    $stmt->bindValue(":id_user", $id_user, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_OBJ);
    $stmt->closeCursor();
    return $user;

   }

   public function updateUser($user, $id_user) {
    $req = "UPDATE qa_user SET lastName = :lastName, firstName = :firstName, email = :email, guests = :guests, allergy = :allergy WHERE id = :id_user";
    $stmt = $this->getBdd()->prepare($req);
    $stmt->bindValue(":lastName", $user->getLastName(), PDO::PARAM_STR);
    $stmt->bindValue(":firstName", $user->getFirstName(), PDO::PARAM_STR);
    $stmt->bindValue(":email", $user->getEmail(), PDO::PARAM_STR);
    $stmt->bindValue(":guests", $user->getGuests(), PDO::PARAM_INT);
    $stmt->bindValue(":allergy", $user->getAllergy(), PDO::PARAM_STR);
    $stmt->bindValue(":id_user", $id_user, PDO::PARAM_INT);
    $stmt->execute();
    $isUpdated = ($stmt->rowCount() > 0);
    $stmt->closeCursor();

    return $isUpdated;
   }


}