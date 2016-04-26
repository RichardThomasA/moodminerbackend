<?php  
	//require("db_config.php");

	$tiredness=3;
	$tensity=3;
	$displeasure=3;

	$conn= new mysqli(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
	if($conn->connect_error)
	{
		// if unable to connect to database

		die("connection failed" .$conn->connect_error);
	}
	$sql1="SELECT dist FROM dailydist";
	$result=$conn->query($sql1);
	//$result=mysqli_query($conn,$sql1);
	$res=mysqli_fetch_assoc($result);
	//echo $res["dist"];
	$n=mysqli_num_rows($result);
	$total=0;


	//for calculating mean
	for ($i=0; $i <$n ; $i++) { 
		# code...
		$total=$total+$res["dist"];
	}
	//echo $n."n <br>";
	//echo $total."total <br>";
	$mean=$total/$n;
	echo $mean."<br><br>";

	//for calculating mean deviation
	$tot_dev =0;
	$temp=0;
	for ($i=0; $i <$n ; $i++) {
		# code...
		$temp=number_format($res["dist"],3)-number_format($mean,3);
		//echo $res["dist"]."<br>";
		//echo $mean."<br>";
		//echo $temp."<br>";
		//echo "<br>";

		$tot_dev += abs($temp);
	}
	$deviation= $tot_dev/$n;
	echo $deviation;


	$sql2 ="SELECT dist FROM dailydist ORDER BY id DESC LIMIT 1";
	$result2=$conn->query($sql2);
	$res2 =mysqli_fetch_assoc($result2);
	if($res2["dist"]>=($mean - $deviation) && $res2["dist"]<=$mean + $deviation)
	{
		$tiredness =3;// value 3 stands for normal mood 
		$tensity=3;
		$displeasure=3;
	}
	if ($res2["dist"]>$mean+$deviation && $res2["dist"]<=$mean+(2*$deviation)) {
		# code...
	}
	$moodArray = array('tiredness' =>$tiredness ,'tensity' =>$tensity ,'displeasure' =>$displeasure );
	$moodJson=json_encode($moodArray);
	echo $moodJson;
	//var_dump($moodJson);
	//$tiredness =3;
	//$tensity=3;
	//$displeasure=3;
	if ($tiredness = 3 && $tensity =3 && $displeasure) {
		# code...
		echo "mood is normal";
	}

	//echo "mood is normal";

?>