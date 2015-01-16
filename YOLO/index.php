<?php
// Richtet die Sessionvariable im Browser und Server $_SESSION für einen Benutzer ein
session_start ();
// In dieser Datei könnt ihr Funktionen für eure DB Abfragen hineinspeichern
require_once 'resources/database.php';
// POST Formulare
if (isset ( $_POST ["form"] )) {
	if ($_POST ["form"] == "login") {
		if (checkUser ( $_POST ["username"], $_POST ["passwort"] )) {
			$_SESSION ["login"] = "ok";
			$_SESSION ["name"] = $_POST ["name"];
			header ( "Location: index.php?site=loggedin" );
		}
	}
}
// GET Formulare
if (isset ( $_GET ["form"] )) {
	if ($_GET ["form"] == "logout") {
		session_destroy ();
		// Wichtig! Neu laden der Seite
		header ( "Location: index.php" );
	}
}
?>
<!DOCTYPE HTML">
<html>
<head>
<?php require_once("resources/head.php"); ?>
</head>
<body>

	<div id="site">
		<?php require_once("resources/pagehead.php"); ?>
		<?php
		
require_once ("resources/navigation.php");
		
		$seitenordner = 'sites/';
		$defaultseite = 'home';
		
		// Wurde eine Seite Übergeben 1.) GET 2.) POST?
		if (! empty ( $_GET ['site'] )) {
			$seite = $_GET ["site"];
		} else if (! empty ( $_POST ['site'] )) {
			$seite = $_POST ["site"];
		} else {
			// Standardseite
			$seite = $defaultseite;
		}
		
		// Gibt es die Datei wirklich?
		if (! file_exists ( $seitenordner . $seite . ".php" )) {
			$seite = $defaultseite . ".php";
		}
		
		// Inhalt einlesen
		include $seitenordner . basename ( $seite . ".php" );
		?>
		</div>
		<?php require_once("resources/footer.php"); ?>
		
	</div>
</body>
</html>

















