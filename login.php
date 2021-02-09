<?php 
	require_once( "inputs/config.php");
	session_start();

	$conn = new mysqli($servername, $username, $password, $dbname);
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	if(isset($_POST["username"], $_POST["password"])){
		$admin_username = $_POST["username"];
		$admin_password = $_POST["password"];
	    
	    $result = $conn->query("
	    	SELECT username, password FROM Users WHERE username = '".$admin_username."' AND  password = '".$admin_password."'
	    ");

	    if(mysqli_num_rows($result) > 0 ){
	        $_SESSION["logged_in"] = true; 
	        $_SESSION["admin"] = $admin_username;
	    	header('location: maintenance.php');
	    } else {
			echo 'The username or password are incorrect!';
	    }
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-VTS72N4LZH"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-VTS72N4LZH');
	</script>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<title>Login | Shopix</title>
</head>
<body>
	<div class="container">
		<div class="navbar">
			<div class="logo desktop">
				<img src="img/logo.png" alt="">
			</div>

			<ul class="nav-list">
				<li><a class="" href="index.html"><span>Homepage</span></a></li>
				<li><a class="margin-left desktop" href="imprint.html"><span>Imprint</span></a></li>
				<li><a class="button-link margin-left" href="maintenance.php"><span>Maintenance</span></a></li>
			</ul>
		</div>

		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="input-form" method="POST">
			<label for="username">Username</label>
			<input type="text" name="username" placeholder="johndoe" required>

			<label for="password">Password</label>
			<input type="password" name="password" placeholder="doejohn777" required>

			<button class="submit-btn" type="submit">Submit</button>
		</form>
	</div>
</body>
</html>