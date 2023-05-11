<?php


require_once("./models/MainManager.model.php");
require_once("./classes/PasswordResetToken.class.php");

class MotDePasseOublieManager extends MainManager
{

    public function createPasswordResetEntry($passwordReset)
    {
        $req = "INSERT INTO password_reset_tokens (user_id, token, expiration_date, used) VALUES (:user_id, :token, :expiration_date, :used)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":user_id", $passwordReset->getUser_Id(), PDO::PARAM_INT);
        $stmt->bindValue(":token", $passwordReset->getToken(), PDO::PARAM_INT);
        $stmt->bindValue(":expiration_date", $passwordReset->getExpiration_date(), PDO::PARAM_STR);
        $stmt->bindValue(":used", $passwordReset->getUsed(), PDO::PARAM_INT);
        $stmt->execute();
        $isInserted = ($stmt->rowCount() > 0);
        $stmt->closeCursor();

        return $isInserted;
    }

    public function cleanTable($id)
    {
        $req = "DELETE FROM password_reset_tokens WHERE expiration_date < NOW() OR user_id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function findToken($token)
    {
        $req = "SELECT * FROM password_reset_tokens WHERE token = :token AND expiration_date > NOW()";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":token", $token, PDO::PARAM_INT);
        $stmt->execute();
        $passwordReset = $stmt->fetchObject("PasswordResetToken");
        $stmt->closeCursor();
    
        return $passwordReset;
    }
    

    public function findId($token) {
        $req = "SELECT user_id FROM password_reset_tokens WHERE token = :token";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":token", $token, PDO::PARAM_INT);
        $stmt->execute();
        $id = $stmt->fetch();
        $stmt->closeCursor();

        return $id;
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
