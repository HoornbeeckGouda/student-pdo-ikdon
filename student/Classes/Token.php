<?php
include 'conn/database.php';

class Token {
    private $dbconn;
    private $token;

    public function __construct($dbconn) {
        $this->dbconn = $dbconn;
    }

    public function setToken($email) {
        $this->token = bin2hex(random_bytes(16));
        $token_hash = hash("sha256", $this->token);
        $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

        $sql = "UPDATE gebruiker
                SET reset_token_hash = :token_hash,
                    reset_token_expires_at = :expiry
                WHERE email = :email";

        $stmt = $this->dbconn->prepare($sql);

        $stmt->execute([
            ':token_hash' => $token_hash,
            ':expiry' => $expiry,
            ':email' => $email
        ]);
        return $stmt->rowCount();
    }

    public function getToken($token) {
        $token_hash = hash("sha256", $token);

        $sql = "SELECT * FROM gebruiker
                WHERE reset_token_hash = :token_hash";

        $stmt = $this->dbconn->prepare($sql);

        $stmt->execute([
            ':token_hash' => $token_hash
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getValue() {
        return $this->token;
    }
    
    public function getEmailFromToken($token) {
        $token_hash = hash("sha256", $token);
    
        $sql = "SELECT email FROM gebruiker WHERE reset_token_hash = :token_hash";
        $stmt = $this->dbconn->prepare($sql);
        $result = $stmt->execute([':token_hash' => $token_hash]);
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result ? $result['email'] : null;
    }

    public function nullifyToken($email) {
        $sql = "UPDATE gebruiker
                SET reset_token_hash = NULL,
                    reset_token_expires_at = NULL
                WHERE email = :email";
    
        $stmt = $this->dbconn->prepare($sql);
    
        $stmt->execute([
            ':email' => $email
        ]);
    
        return $stmt->rowCount();
    }
}