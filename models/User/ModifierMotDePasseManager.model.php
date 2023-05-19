<?php 

require_once ("./models/MainManager.model.php");
require_once("./classes/QaUser.class.php");


class ModifierMotDePasseManager extends MainManager {

   public function getHashedPassword($id_user) {
      $req = "SELECT password FROM qa_user WHERE id = :id_user";
      $stmt = $this->getBdd()->prepare($req);
      $stmt->bindValue(":id_user", $id_user, PDO::PARAM_INT);
      $stmt->execute();
      $user = $stmt->fetch(PDO::FETCH_OBJ);
      $stmt->closeCursor();
      return $user->password;
  }
  
  public function updatePassword($password, $id_user){
   $req = "UPDATE qa_user SET password = :password WHERE id = :id_user";
   $stmt = $this->getBdd()->prepare($req);
   $stmt->bindValue(":password", password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
   $stmt->bindValue(":id_user", $id_user, PDO::PARAM_INT);
   $stmt->execute();
   $stmt->closeCursor();

   return true;
  }

}