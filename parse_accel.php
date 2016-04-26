<?php
	require("db_config.php");
	$conn= new mysqli(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
	if($conn->connect_error)
	{
		// if unable to connect to database

		die("connection failed" .$conn->connect_error);
	}
	$sql1="SELECT * FROM accelreading";
	$result=$conn->query($sql1);
	$row=mysqli_fetch_all($result,MYSQLI_ASSOC);
	/*foreach ($row as $r) {
		# code...
		echo $r["x"]."\t";
	}*/
	//echo $row[0]["x"];
	$n=mysqli_num_rows($result);
	//echo $n;
	for ($i=0;$i<=$n-2;$i++) {
		# code...
		$x1=$row[$i]["x"];
		$x2=$row[$i+1]["x"];

		$y1=$row[$i]["y"];
		$y2=$row[$i+1]["y"];

		$z1=$row[$i]["z"];
		$z2=$row[$i+1]["z"];

		$xdiff= $x2-$x1;
		$ydiff= $y2-$y1;
		$zdiff= $z2-$z1;
		//echo $xdiff;
		$dist= sqrt(pow($xdiff,2)+pow($ydiff,2)+pow($zdiff,2));
		//echo $dist;
		$distance[$i]=$dist;
		$sql2="INSERT INTO diff (dist) VALUES ('$dist')";//inserting distance bw two consecutive values
		$conn->query($sql2);

	}
	$d=0;
	foreach ($distance as $val) {
		# code...
		$d=$d+$val;

	}
	//echo $d;
	$sql3="INSERT INTO dailydist (dist) VALUES ('$d')";//inserting the total distance
	$conn->query($sql3);


	
?>