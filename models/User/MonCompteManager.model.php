<?php 

require_once ("./models/MainManager.model.php");
require_once("./classes/QaUser.class.php");

class MonCompteManager extends MainManager {

    public function getUserInfo($id_user) {
        $req  = "SELECT lastName, firstName, email, guests, allergy FROM qa_user WHERE id = :id_user";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id_user", $id_user, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        $stmt->closeCursor();
        return $user;
    }


}