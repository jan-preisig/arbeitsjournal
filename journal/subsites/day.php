<?php
include("../db_connection.php");
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta charset="UTF-8">
	<title>Journal von Jan</title>
</head>
<body>
	<form method="POST" action="">
		<?php
		$getpos = "SELECT date FROM position WHERE p_id=1;";
		foreach(mysqli_query($db, $getpos) as $row){
			$datepos = $row['date'];
		}			
		$sql = "SELECT * FROM date_path WHERE date='".$datepos."'";
		?>		
		<table class="daytable" id="d7">
			<tr>
				<td colspan="4" width="600">
					<center><b><?php echo $datepos; ?></b></center>
				</td>
			</tr>
			<tr>
				<td class="subtitles">
					Ziele
				</td>

				<td class="subtitles">
					Was habe ich gemacht
				</td>

				<td class="subtitles">
					Ziele Erreicht? Wieso?
				</td>

				<td class="subtitles">
					Hilfe von...
				</td>
			</tr>

			<?php

			$bool = true;
			foreach (mysqli_query($db, $sql) as $row) {
				$bool = false;
				#echo $row['d_id']." ".$row['date']." " . $row['day']."<br/>";
				#echo "Path: ".$row['path']."<br/><br/>";

				$file = $row['path'];
				
				$file_handle = fopen("../textfiles/".$file, 'r')or die("Datei nicht lesbar!");
				
				while ($line=fgets($file_handle, 1024)) {
					echo "<tr>";

					$array = explode(";;",$line);
					echo "<td>".$array[0]."</td><td>".$array[1]."</td><td>".$array[2]."</td><td>".$array[3]."</td>";

					echo "</tr>";

				}

				fclose($file_handle);

			}

			if($bool){
				
				$getaction = "SELECT last_action FROM position";
				$lastaction = mysqli_query($db, $getaction);
				while($row1 = mysqli_fetch_object($lastaction)){
					nextOrPrev($row1->last_action);
				}
			}

			function nextOrPrev($id){
				global $db;

				foreach(mysqli_query($db,"SELECT date FROM position WHERE p_id=1")as $row) {
					
					$datenow = $row['date'];
					$date=date_create($datenow);
					if($id=="w"){
						date_add($date,date_interval_create_from_date_string("1 days"));
					}else if($id == "z"){
						date_sub($date,date_interval_create_from_date_string("1 days"));
					}
					$newdate = date_format($date,"Y-m-d");
					foreach(mysqli_query($db, "SELECT MAX(date) AS highdate, MIN(date) AS lowdate FROM date_path;")as $rowHighDate){
						$maxdate = $rowHighDate['highdate'];
						$lowdate = $rowHighDate['lowdate'];
						if($newdate<=$maxdate && $newdate>=$lowdate){
							$update_pos = "UPDATE position SET date='".$newdate."',last_action='".$id."' WHERE p_id=1";
							mysqli_query($db, $update_pos)or die("ERROR: unable to update!" . mysqli_error());
							header('Location: day.php');
						}
					}
				}
			}
			?>
			<tr>
				<td class="buttonCell">
					<button name='zurück' id="zurück">Zurück</button>
				</td>

				<td colspan="2">
					<a href="../home.php"><center>HOME</center></a>
				</td>

				<td class="buttonCell">
					
					<button name="weiter" id="weiter">Weiter</button>
				</td>
			</tr>

		</table>
		<?php
		if(isset($_POST['weiter'])){

			nextOrPrev("w");
			
		}else if(isset($_POST['zurück'])){
			nextOrPrev("z");
		}
		?>
	</form>
</body>


</html>