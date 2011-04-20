<?php session_start(); 

try { 
  if (isset($_REQUEST['logout'])) {
    session_destroy();
    session_start();
  }
} catch (Exception $e) {
  $status['error'] = $e->getMessage();
}

try {
	if (empty($_SESSION['userAuthenticated']) && $_POST) {
	
		$user = $_POST['user'];
		$pass = $_POST['pass'];

		include("mysql_logon.php");

		$query = "select * from users where email = '$user' AND password = PASSWORD('$pass');";
		$results = mysql_query($query)
		or die("Query error: " . mysql_error());
		
		$row = mysql_fetch_array($results);
		
		if(mysql_num_rows($results))
		{
			extract($row);
			$_SESSION['userFullName'] = "$first_name "."$last_name";
			$_SESSION['userAuthenticated'] = true;
			$_SESSION['userEmail'] = $email;
			$_SESSION['userID'] = $id;
			
			echo("Successful login.");
			#include("successful_login.php");
		} else {
					#echo("Broken :(");
					#include("wrong_login_form.php");
		}
	} 
}catch (Exception $e) {
  $status = $e->getMessage();
  echo $status;
}

?>

<html>
	<head>
		<title>Job Seek :: Home</title>
		<link rel="stylesheet" href="jobseek_styles.css" type="text/css" />
	</head>
	<body>
		<?php include("js_header.php");
		if (empty($_SESSION['userAuthenticated'])) { ?>
		<form method="POST" action="" name="auth">
			<fieldset>
				<legend>User Login</legend>
				<div><label>Email</label><input type="text" name="user"></div>	
				<div><label>Password</label><input type="password" name="pass"></div>
				<br/>
				<div align="right"><input type="submit" value="Login"></div>
			</fieldset>
		</form>
		<div id="loggedin"><span>Not a member? Sign up </span><a href="register_user.php">here</a>.</div>
		<?php }
		if (isset($_SESSION['userAuthenticated'])) {
			include("myaccount.php");
		}
		include("js_footer.php");
		?>
	</body>
</html>
