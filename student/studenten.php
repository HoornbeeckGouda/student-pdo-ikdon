<?php
include 'inc/header.php';
include 'classes/Student.php';
?>
<?php
// initialiseren/declareren
$contentTable = "";
//tabelkop samenstellen
$table_header = '<table id="students">
                    <tr>
                        <th>studentnr</th>
                        <th>voornaam</th>
                        <th>tussenvoegsel</th>
                        <th>achternaam</th>
                        <th>straat</th>
                        <th>postcode</th>
                        <th>woonplaats</th>
                        <th>email</th>
                        <th>klas</th>
                        <th>geboortedatum</th>
                        <th>actie</th>
                    </tr>';
$student = new Student($dbconn);
$result = $student->getStudent();
try {
    $result->execute();
    $result->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error:". $e->getMessage();
    exit;
}

$count_records = $student->getStudentCount();
if ($count_records>0) { // wel studenten ophalen
    foreach($result as $row) {
        $contentTable .= "<tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . $row['voornaam'] . "</td>
                            <td>" . $row['tussenvoegsel'] . "</td>
                            <td>" . $row['achternaam'] . "</td>
                            <td>" . $row['straat'] . "</td>
                            <td>" . $row['postcode'] . "</td>
                            <td>" . $row['woonplaats'] . "</td>
                            <td>" . $row['email'] . "</td>
                            <td>" . $row['klas'] . "</td>
                            <td>" . $row['geboortedatum'] . "</td>
                            <td>" . "<a href='edit.php?id=" . $row['id'] . "'>Edit</a></td>
                        </tr>";
    }
}
$table_student = $table_header . $contentTable . "</table>";

echo $table_student;
?>
<?php
include 'inc/footer.php';
?>

