<!DOCTYPE html>
<html>
<head>

	<title>Jan P - Arbeitsjournal</title>
<link rel="shortcut icon" href="favicon.ico?v=4f32ecc8f43d">
</head>
<body>
	<h1 id="top">Arbeitsjournal von Jan Preisig</h1>
<?php
		

		$ip = "172.16.44.159";
		$user = "root"; 
		$pw = "Cherub2412";
		$database = "arbeitsjournal";

		$db = new mysqli($ip,$user,$pw,$database)or die("verbindung fehlgeschlagen" . mysqli_connect_error());

		/*$sql = "SELECT * FROM date_path";
		$ergebnis = mysqli_query($db,$sql);
		

		while($row = mysqli_fetch_object($ergebnis)){
			echo $row->path;
		}
		$pdo = new PDO('mysql:host=localhost;dbname=arbeitsjournal', 'root', 'Cherub2412') or die("ERROR" . mysql_error());


		foreach ($pdo->query($sql) as $row) {
				echo $row['d_id']." ".$row['date']." " . $row['day']."<br/>";
				echo "Path: ".$row['path']."<br/><br/>";

				$file = $row['path'];
				$file_handle = fopen("textfiles/".$file, 'r');

				while (!feof($file_handle)) {
					$line = fgets($file_handle);
					echo $line . "<br/>";
				}

			}*/

		


?>

</body>
</html>