<?php
class Student {
    private $dbconn;

    public function __construct($dbconn) {
        $this->dbconn = $dbconn;
    }

    public function getStudent() {
        $qry_student = "SELECT 
                            id, 
                            voornaam, 
                            tussenvoegsel, 
                            achternaam,
                            straat,
                            postcode,
                            woonplaats,
                            email,
                            klas,
                            geboortedatum
                            FROM student
                            ORDER BY achternaam, voornaam;";

        $result = $this->dbconn->prepare($qry_student);
        $result->execute();
        return $result;
    }

    public function getStudentCount() {
        $qry_count = "SELECT COUNT(*) as count FROM student";
        $stmt = $this->dbconn->prepare($qry_count);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    public function getStudentId($id) {
        $qry_student = "SELECT * FROM student WHERE id = :id";
        $stmt = $this->dbconn->prepare($qry_student);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateStudent($id, $voornaam, $tussenvoegsel, $achternaam, $straat, $postcode, $woonplaats, $email, $klas, $geboortedatum) {
        $qry_update = "UPDATE student SET 
                        voornaam = :voornaam, 
                        tussenvoegsel = :tussenvoegsel, 
                        achternaam = :achternaam,
                        straat = :straat,
                        postcode = :postcode,
                        woonplaats = :woonplaats,
                        email = :email,
                        klas = :klas,
                        geboortedatum = :geboortedatum
                        WHERE id = :id";
    
        $stmt = $this->dbconn->prepare($qry_update);
        $stmt->execute([
            ':id' => $id,
            ':voornaam' => $voornaam,
            ':tussenvoegsel' => $tussenvoegsel,
            ':achternaam' => $achternaam,
            ':straat' => $straat,
            ':postcode' => $postcode,
            ':woonplaats' => $woonplaats,
            ':email' => $email,
            ':klas' => $klas,
            ':geboortedatum' => $geboortedatum
        ]);
    }
}
?>