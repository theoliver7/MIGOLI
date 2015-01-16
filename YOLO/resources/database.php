<?php
/**
 * DB Funktionen
 * @author Kurt Blaser
 * @version 1.0
 */

require_once ('resources/config.php');

/*
 * Erstellt eine Verbindung zur Datenbank
 */
function connectDb($dbUser,$dbPass) {    
    $con = mysql_connect("localhost", $dbUser, $dbPass);
    if (!$con) {
        die('Could not connect: ' . mysql_error());
    } 
    return $con;
}

/*
 * Trennt die MySQL Verbindung
 */
function disconnectdb($con) {
    mysql_close($con);
}

function checkUser($username, $password) {
    //Wichtig: Macht globale Variabeln in der Funktion verfuegbar
    global $dbUser, $dbPass; 
    
    //Query
    $sql = "SELECT * FROM registration";
    //Verbinden
    $con = connectDb($dbUser, $dbPass);
    //SQL Select
    mysql_select_db("registration", $con);
    //Qurey an DB Senden
    $result = mysql_query($sql, $con);
    //Zeile fuer Zeile auswerten
    while ($row = mysql_fetch_row($result)) {        
        //Testen
        if ($row[0] == $username) {            
            //Wenn der Benutzer gefunden wurde => Passwort pruefen (MD5 verschluesselt)
            if ($row[1] == md5($pass)) {
                return true;
            }
        }
    }
    return false;
}

?>
