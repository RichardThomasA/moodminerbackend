<?php

require ('db_config.php');

$username=null;
$password=null;
$con=mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);

if (mysqli_connect_errno($con))
{
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
if(isset($_POST['username']))
{
	$username = $_POST['username'];
}
if(isset($_POST['password']))
{
	$password = $_POST['password'];
}

$result = mysqli_query($con,"SELECT * FROM users where 
username='$username' and password='$password'");
//$row = mysqli_fetch_array($result);
//$data = $row[0];

$data= mysqli_num_rows($result);
//$arr = array('reply' =>"success" );


if($data>0){
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