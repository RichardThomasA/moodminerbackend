<?php

require ('db_config.php');

$x=null;
$y=null;
$z=null;

$con=mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);

if (mysqli_connect_errno($con))
{
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
if(isset($_POST['x']))
{
	$x = $_POST['x'];
}
if(isset($_POST['y']))
{
	$y = $_POST['y'];
}
if(isset($_POST['z']))
{
	$z = $_POST['z'];
}
$sql="INSERT INTO accelreading (x,y,z) VALUES ('$x','$y','$z')";
//$result = mysqli_query($con,"INSERT INTO accelreading (x,y,z) VALUES ('$x','$y','$z')");



if($con->query($sql)===True){
//echo $data;
	//echo "success";
	$arr = array('reply' =>"success" );
	echo json_encode($arr);
}
else
{
	//echo "failed";
	$arr = array('reply' =>"failed" );
	echo json_encode($arr);
}
//echo json_encode($arr);

mysqli_close($con);
?>