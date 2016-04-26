<?php
	session_start();
	require("db_config.php");
	//$dbservername="localhost";
	//$dbusername="richard";
	//$dbpassword="richard";
	//$dbdatabase="projectdummy";
	$message = array();
	$conn= new mysqli(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
	if($conn->connect_error)
	{
		// if unable to connect to database

		die("connection failed" .$conn->connect_error);
	}
	else
	{
		//if connection is OK, then
		if(isset($_POST['submit']))
		{
			//if the form is submitted
			$username=$_POST['username'];
			$password=md5($_POST['password']);

			$username=mysqli_real_escape_string($conn,$username);
			$password=mysqli_real_escape_string($conn,$password);

			$querry="SELECT * FROM admin_details WHERE username='$username'AND password='$password'";
			$row=mysqli_num_rows($conn->query($querry)); //or die(" could not process the query".$conn->connect_error);
			//echo $result;
			if($row==1)
			{
				//if a match is found
				$message[]="<p>Login successful</p>";
				//echo "<p>Login successful</p>";
				$_SESSION['username']=$username;
				header('Refresh: 2; url = http://localhost/moodminer/index.php');
			}
			else
			{
				//if a match is not found
				$message[]="<p>The passowrd or username is wrong or the username doesnot exist.</p>";
				$message[]="<p>Please try again with valid data.</p>";
				//echo "<p>The passowrd or username is wrong or the username doesnot exist.</p>";
				//echo "<p>Please try again with valid data.</p>";
				header('Refresh: 5; url = http://localhost/miniproject/login.php');
			}

		}
	}

?>

<!DOCTYPE HTML>

<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<meta name="viewport" content="width=device-width,
		initial-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!--<link href=	"css/bootstrap.min.css" rel="stylesheet" type="text/css">-->
        <style>

			.form-container{
				background-color: #FFE4C4;
				border-radius: 10px;
				border: 1px solid black;

			}
			.container{
				margin-top: 150px;
			}
			body{
				background-color: #7FFFD4;
			}
			.form-content label{
				font-size: 20px;
			}

        </style>
	</head>

	<body>
		<div class="container">
			<div class="row">
				<div class=" col-md-4">
				</div>
		    	<div class="form-container col-md-4" style="padding-bottom:25px;">
		    		<div class="form-header">
		    			<h1 class="text-center">Login</h1>
		    		</div>
		    		<div class="form-body">
		    			<form method ="post" class="form-content">
		    				<label for="form-username">Username</label>
		    				<input type="text" name="username" class="form-control" placeholder="Enter username" id="form-username"><br>
		    				<label for="form-password">Password</label>
		    				<input type="password" name="password" class="form-control" placeholder="********" id="form-password"><br><br>
		    				
		    				<input type="submit" name="submit" class="btn btn-lg btn-primary btn-block" value="Login"><br>
		    				<div class="text-center"><a href="/moodminer/signup.php">Create an account.</a></div>
		    				
		    			</form>
		    			<?php 	if($message)	{	?>

					<ul class="result">
						<?php
							foreach ($message as $msg) {
								echo "<li>$msg</li>";
							}
						?>
					</ul>
					<?php } ?>
		    		</div>
		    	</div>
		    	<div class="col-md-4">
		    	</div>
		    </div>
	    </div>	
        
         <!-- all the script goes here-->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>

	</body>
</html>