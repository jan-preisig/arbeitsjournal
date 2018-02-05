<?php
include("db_connection.php");
?>
<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="../Arbeitsjournal/jquery/jquery-3.1.1.js"></script>
	<script src="../Arbeitsjournal/jquery-ui-1.12.1/jquery-ui.js"></script>
	<title>Home</title>
</head>
<body>
	<h1>Home</h1>
	<form action="" method="POST">
		<select name=date_choose id="date_choose" onchange="this.form.submit()">
			<option value="default" selected disabled>tag auswählen...</option>}
			option
			<?php
			function redirect($url){
				if (!headers_sent())
				{    
					header('Location: '.$url);
					exit;
				}else{  
					echo '<script type="text/javascript">';
					echo 'window.location.href="'.$url.'";';
					echo '</script>';
					echo '<noscript>';
					echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
					echo '</noscript>'; exit;
				}
			}
			$content = mysqli_query($db, "SELECT * FROM date_path ORDER BY date DESC;");

			while($row = mysqli_fetch_object($content)){
				echo "<option name='".$row->date."' value='".$row->date."'>".$row->date." ".$row->day."</option>";
			}
			?>
		</select>

		<?php

		if(isset($_POST['date_choose'])){
			$date = $_POST['date_choose'];

			$sql = "UPDATE position SET date='".$date."' WHERE p_id = 1;";
			mysqli_query($db, $sql)or die("ERROR" . mysql_error());
			redirect('subsites/day.php');
		}

		?>

		<div class="open">Arbeitsjournal</div>
		<div id="dateTableWrapper" class="hide">
		<table id="august" class="month">
			<tr class="zeilen">
				<td colspan="3"><b>Arbeitsjournal</b></td>
			</tr>

			<tr class="zeilen">
				<td>Datum</td>
				<td>Tag</td>
				<td><center>Öffnen</center></td>
			</tr>

			<?php
			$sqlall = "SELECT * FROM date_path ORDER BY date DESC";
			$result = mysqli_query($db, $sqlall);
			
			while($row = mysqli_fetch_object($result)){
				echo "<tr class='zeilen'><td>".$row->date."</td><td>".$row->day."</td><td class='green'><button name='".$row->date."' class='gotoday'>click here</button></td></tr>";
				
				if(isset($_POST[$row->date])){
					$upd = "UPDATE position SET date='".$row->date."' WHERE p_id=1";
					$update = mysqli_query($db, $upd)or die("ERROR" . mysqli_error());
					redirect("subsites/day.php");
				}						
			}
			?>
		</table>	
		</div>
	</form>
	<form action="subsites/insertDates.php" method="get" accept-charset="utf-8">

	</form>
	<footer>
		<p>
			&copy; Jan Preisig | <a href="mailto:jan_preisig@gmx.net">jan_preisig@gmx.net</a>
		</p>
		<a href="#top" id="totop">to the top</a>
	</footer>
	<script type="text/javascript" src="../Arbeitsjournal/jshome.js"></script>
</body>
</html>