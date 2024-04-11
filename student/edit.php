<?php
include 'inc/header.php';
include 'classes/Student.php';
$student = new Student($dbconn);
$id = $_GET['id'];
$currentStudent = $student->getStudentId($id);
?>

<form action="edit.php?id=<?php echo $currentStudent['id']; ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $currentStudent['id']; ?>">
    Voornaam: <input type="text" name="voornaam" value="<?php echo $currentStudent['voornaam']; ?>"><br>
    Tussenvoegsel: <input type="text" name="tussenvoegsel" value="<?php echo $currentStudent['tussenvoegsel']; ?>"><br>
    Achternaam: <input type="text" name="achternaam" value="<?php echo $currentStudent['achternaam']; ?>"><br>
    Straat: <input type="text" name="straat" value="<?php echo $currentStudent['straat']; ?>"><br>
    Postcode: <input type="text" name="postcode" value="<?php echo $currentStudent['postcode']; ?>"><br>
    Woonplaats: <input type="text" name="woonplaats" value="<?php echo $currentStudent['woonplaats']; ?>"><br>
    Email: <input type="text" name="email" value="<?php echo $currentStudent['email']; ?>"><br>
    Klas: <input type="text" name="klas" value="<?php echo $currentStudent['klas']; ?>"><br>
    Geboortedatum: <input type="text" name="geboortedatum" value="<?php echo $currentStudent['geboortedatum']; ?>"><br>
    <input type="submit" value="Update">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student->updateStudent($_POST['id'], $_POST['voornaam'], $_POST['tussenvoegsel'], $_POST['achternaam'], $_POST['straat'], $_POST['postcode'], $_POST['woonplaats'], $_POST['email'], $_POST['klas'], $_POST['geboortedatum']);
    echo "Student gewijzigd";
}
include 'inc/footer.php';
?>