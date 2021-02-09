<?php
	session_start();
	if (!$_SESSION["logged_in"]) {
		header('location: ../login.php');
	}

	require_once( "config.php");

	$shop_name 			 = $_POST['shop-name'];
	$shop_workers_number = $_POST['shop-workers-number'];
	$shop_type 			 = $_POST['shop-type'];
	$shop_location 		 = $_POST['shop-location'];

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
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
	<link rel="stylesheet" href="../style.css">
	<title>Input Shops | Shopix</title>
</head>
<body>
	<div class="container">
		<div class="navbar">
			<div class="logo desktop">
				<img src="../img/logo.png" alt="">
			</div>

			<ul class="nav-list">
				<li><a class="" href="../index.html"><span>Homepage</span></a></li>
				<li><a class="margin-left desktop" href="../imprint.html"><span>Imprint</span></a></li>
				<li><a class="button-link margin-left" href="../maintenance.php"><span>Maintenance</span></a></li>
			</ul>
		</div>

		<div class="input-form">
			<h2>Result</h2>
			<p>
				<?php
					echo "Connection to database successful. <br> Instance added to 'Shops' table: <br> " . $shop_name . "<br>" . $shop_workers_number . "<br>" . $shop_type . "<br>" . $shop_location . "<br>";

					$sql = "INSERT INTO Shops (name, num_workers, store_type, location) VALUES ('" . $shop_name . "', ". $shop_workers_number . ", '". $shop_type ."', '". $shop_location ."')";

					if ($conn->query($sql) === TRUE) {
					  echo "New record created successfully";
					} else {
					  echo "Error: " . $sql . "<br>" . $conn->error;
					}

					$conn->close();
				?>
			</p>
			<a href="shopsall.php">View full table</a>
		</div>
	</div>
</body>
</html>
