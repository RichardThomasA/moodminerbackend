<?php
	require("db_config.php");
	$conn= new mysqli(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
	if($conn->connect_error)
	{
		// if unable to connect to database

		die("connection failed" .$conn->connect_error);
	}
	else 
	{
		if(isset($_POST['submit']))
		{
			//if connection is OK, then
			$username=$_POST['username'];
			$password=md5($_POST['password']);
			$email=$_POST['email'];

			$username=mysqli_real_escape_string($conn,$username);
			$password=mysqli_real_escape_string($conn,$password);
			$email=mysqli_real_escape_string($conn,$email);

			$result="SELECT username FROM admin_details WHERE username='$username'";

			if(mysqli_num_rows($conn->query($result))===0)
			{
				//if the username doesnot exist in the database
				$sql="INSERT INTO admin_details (username,password,email_id)
					  VALUES ('$username','$password','$email')";
				if($conn->query($sql)===true)
				{
					//if the connection is successful
					echo "<p>Redirecting to admin panel.</p>";
					
					header('Refresh: 2; url = http://localhost/miniproject/index.php');
				}
				else
				{
					//if the connection is unsuccessful
					echo "<p>FAilse to update database.Please try again</p>";
					
				}
			}
			else
			{
				//if the username already exists
				echo "<p>The username already exists.Please try again.</p>";
				header('Refresh: 2; url =http://localhost/miniproject/signup.php');

			}
		}
	}
	$conn->close();



?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Signup</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,
		initial-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<style>
			body{
				background-color: #7FFFD4;
			}
			.form-container{
				background-color: #FFE4C4;
				margin-top: 150px;
				border-radius: 10px;
				border: 1px solid black;
			}
			
		</style>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-4">
				</div>
				<div class ="form-container col-md-4">
					<div class="form-header">
						<h1 id="login-header-text" class="text-center">Signup</h1>
					</div>
					<div class="form-body">
						<form class="form-content" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
							<label for="username">Username</label>
							<input type="text" placeholder="Enter Username" name="username" id="username" class="form-control"><br>

							<label for="password">Password</label>
							<input type ="password" placeholder="********" name ="password" id="password" class="form-control"><br>

							<label for="email">Email-Id</label>
							<input type="text" placeholder="yourname@example.com" name="email" id="email" class="form-control"><br>
							
							<input type="submit" name="submit" value="Signup" class=" btn btn-primary btn-block btn-lg"><br>
							

						</form>
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