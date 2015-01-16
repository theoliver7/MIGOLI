<?php
$username = $_POST ['username'];
$vorname = $_POST ['Vorname'];
$nachname = $_POST ['name'];
$mail = $_POST ['email'];
$passwort = $_POST ['Passwort'];
$geburtsdatum = $_POST ['Geburtsdatum'];

// neue Datenbankverbindung
$mysqli = new mysqli ( "localhost", "root", "", "login_data", "3307" );

$query = 'insert into registration (Benutzer_ID, Nachname, Vorname, Mail, Passwort, Geburtsdatum,Username)
             values (null,"' . $nachname . '","' . $vorname . '","' . $mail . '",md5("' . $passwort . '"),"' . $geburtsdatum . '","' . $username . '");';
echo $query;

$mysqli->query ( $query );
echo $mysqli->error;
echo "Du bist eingeloggt!";
header ( "Refresh: 0; url=index.php" );
?>
