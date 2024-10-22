<?php 
	include('server.php'); 
	if (isset($_POST['submit'])){
		$username = $_POST['user'];
		$password = $_POST['pass'];

		$sql = "SELECT * from login where username = '$username' and password = 'password'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);
		if($count==1){
			header("Location:index.php");
		}
		else{
			echo '<script>
			window.location.href = "login.php";
			alert("Login failed". Invalid Username or Password"
			</script>';

		}

	}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form name="form" method="POST" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  </form>
</body>
</html>