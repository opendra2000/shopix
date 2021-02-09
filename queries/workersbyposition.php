<?php
	session_start();
	if (!$_SESSION["logged_in"]) {
		header('location: ../login.php');
	}
	
	require_once( "../inputs/config.php");

	/* $smth - is a variable. This post method gets data from input with name="worker-position".
	   Use the similar method to get data from your html pages. */
	/* Get your data for SQL "WHERE" here and assign it to variable. */
	$worker_position = $_POST['worker-position'];

	/* In my example I had used input with select options, you can do whatever select types you want, just be sure you 
	   handle types like 'date' properly when you want to display output */

	/* Also be sure to change page titles and links. */
	/* Best, Khurshid. */

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
	<title>Find Workers Query | Shopix</title>
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
					
					/* Modify this sql statement as one of the queries from our shopixdb.sql file of your choice. */
					/* We use double quotes for whole sql statement, single quotes to handle strings.
					   In my case $worker_position is a string, thats why I:
					   1) open single quote;
					   2) close double quote;
					   3) use . (dot) to append the string I obtained from html and reverse the steps above. */
					$sql = "SELECT * FROM Workers WHERE Position = '". $worker_position ."'";

					/* You do NOT need to change code below. It only displays output */
					$result = $conn->query($sql);

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
			<a href="../inputs/workersall.php">View full table</a>
		</div>
	</div>
</body>
</html>
