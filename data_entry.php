<?php
	require("db_config.php");
	$x="";
	$y="";
	$z="";
	if (isset($_POST["accelSubmit"])) {
		# code...
		if (isset($_POST["x"])&&isset($_POST["y"])&&isset($_POST["z"])) {
				# code...
				$x=$_POST["x"];
				$y=$_POST["y"];
				$z=$_POST["z"];

				$conn= new mysqli(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
				if($conn->connect_error)
				{
					// if unable to connect to database

					die("connection failed" .$conn->connect_error);
				}
				$sql="INSERT INTO accelreading (x,y,z) VALUES ('$x','$y','$z')";
				if($conn->query($sql)===true)
				{
					// successfull db operation
					echo "success";
				}
				else
				{
					//db operation failed
					echo "fail";
				}
			}	
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Data Entry</title>
</head>
<body>
	<div class ="form-container">
		<div class="" id ="accel-data">
			<div class="form-header">
				Accelereometer Reading
			</div>
			<form method ="post" >
				<label>X:</label>
				<input type="number" step="any" name="x" id="x-value"><br>

				<label>Y:</label>
				<input type="number" step="any" name="y" id="y-value"><br>

				<label>Z:</label>
				<input type="number" step="any" name="z" id="z-value"><br>

				<input type="submit" value ="Submit" name="accelSubmit">

			</form>
			
		</div>
		<div class="" id="gps-data">
			<div class="form-header">
				GPS Reading
			</div>
			<form method ="post" action ="gps.php">
				<label>Latitude:</label>
				<input type ="number" step="any" name="lat" id="lat-gps"><br>

				<label>Longitude:</label>
				<input type ="number" step="any" name="lon" id="lon-gps">

				<input type="submit" value ="Submit" name="gpsSubmit">

			</form>
			
		</div>
	</div>
	
</body>
</html>