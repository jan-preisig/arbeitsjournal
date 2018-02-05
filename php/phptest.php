	<!DOCTYPE html>
	<html>
	<head>
		<title>test</title>
	</head>
	<body>
		<h1>Test php</h1>
		<?php

			$ip = "127.0.0.1";
			$pw = "Cherub2412";
			$user = "root"; 
			$database = "arbeitsjournal";
			echo "test test";

			$db = new mysqli($ip,$user,$pw,$database);
			#$db = mysql_connect
			if(!$db)
			{
  				exit("Verbindungsfehler: ".mysqli_connect_error());
  				echo "Fehler";
			}
						#$use = mysqli_query("USE test")or die("Fehler!". mysqli_error());
			#mysqli_select_db("test")or die("Fehler!". mysqli_error());
echo "test";
					$sql = "SELECT * FROM date_path";
					$suchergebnis = mysqli_query($db, $sql); #or die ("ERROR HIER ".mysqli_error());
					echo "<br> suchergebnis: "."<br>";
					if($suchergebnis){
 		echo "Successful";
 	}

 	else {
 		echo "ERROR";
 	}
					if ( ! $suchergebnis )
					{
					  die('Suchbegriff nicht gefunden: ' . mysqli_error());
					}
					echo "test2";
					while($row = mysqli_fetch_object($suchergebnis))
					{
						echo $row->path;
						
							
					}
			
					echo "end";


			#$text = file_get_contents("text.txt");
			#echo $text;
		?>

	</body>
	</html>