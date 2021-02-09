<?php
	session_start();
	if (!$_SESSION["logged_in"]) {
		header('location: ../login.php');
	}

	require_once( "config.php");
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
	<title>Input Clients | Shopix</title>
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
			<h2>Shops table</h2>
			<p>
				<?php

					// Run the query.
					$result = $conn->query("SELECT * FROM Shops");

					// Get the result in to a more usable format.
					$query = array();
					while($query[] = mysqli_fetch_assoc($result));
					array_pop($query);

					// Output a dynamic table of the results with column headings.
					echo '<table border="1">';
					echo '<tr>';
					foreach($query[0] as $key => $value) {
					    echo '<td>';
					    echo $key;
					    echo '</td>';
					}
					echo '</tr>';
					foreach($query as $row) {
					    echo '<tr>';
					    foreach($row as $column) {
					        echo '<td>';
					        echo $column;
					        echo '</td>';
					    }
					    echo '</tr>';
					}
					echo '</table>';
				?>
			</p>
		</div>
	</div>
</body>
</html>
