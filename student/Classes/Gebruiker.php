<?php 
Class Gebruiker {
    private $dbconn;
    
    public function __construct($dbconn){
        $this->dbconn = $dbconn;
    }

    
    public function resetPassword($email, $wachtwoord) {
        $password_hash = password_hash($wachtwoord, PASSWORD_DEFAULT);
    
        $sql = "UPDATE gebruiker SET wachtwoord = :password_hash WHERE email = :email";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute([
            ':password_hash' => $password_hash,
            ':email' => $email
        ]);
    
        return $stmt->rowCount();
    }
        
}

?>