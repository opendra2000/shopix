<?php
	session_start();
	if (!$_SESSION["logged_in"]) {
		header('location: login.php');
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
	<link rel="stylesheet" href="style.css?v=1.1">
	<title>Maintenance | Shopix</title>
</head>
<body>
	<div class="container">
		<div class="navbar">
			<div class="logo">
				<img src="img/logo.png" alt="">
			</div>

			<ul class="nav-list">
				<li><a class="desktop" href="index.html"><span>Homepage</span></a></li>
				<li><a class="margin-left" href="imprint.html"><span>Imprint</span></a></li>
				<li><a class="button-link margin-left" href="maintenance.html"><span>Maintenance</span></a></li>
			</ul>
		</div>

		<h3>Autocomplete (Assignment 10):</h3>
		<div class="query-list">
			<div class="query-container">
				<p>01</p>
				<a href="autocomplete/productsbyavailability.php">
					<h1>Products by name</h1>
				</a>
			</div>
		</div>

		<h3>Queries (Assignment 7):</h3>

		<div class="query-list">
			<div class="query-container">
				<p>01</p>
				<a href="queries/workersbyposition.html">
					<h1>Workers by position</h1>
				</a>
			</div>
			<div class="query-container">
				<p>02</p>
				<a href="queries/productsbyavailability.html">
					<h1>Products by name</h1>
				</a>
			</div>
			<div class="query-container">
				<p>03</p>
				<a href="queries/shop_at_location.html">
					<h1>Shops by location</h1>
				</a>
			</div>
		</div>

		<h3>Inputs (Assignment 6):</h3>

		<div class="query-list">
			<div class="query-container">
				<p>01</p>
				<a href="inputs/shops.html">
					<h1>Shops</h1>
				</a>
			</div>
			<div class="query-container">
				<p>02</p>
				<a href="inputs/workers.html">
					<h1>Workers</h1>
				</a>
			</div>
			<div class="query-container">
				<p>03</p>
				<a href="inputs/products.html">
					<h1>Products</h1>
				</a>
			</div>
			<div class="query-container">
				<p>04</p>
				<a href="inputs/clients.html">
					<h1>Clients</h1>
				</a>
			</div>
			<div class="query-container">
				<p>05</p>
				<a href="inputs/payments.html">
					<h1>Payments</h1>
				</a>
			</div>
			<div class="query-container">
				<p>06</p>
				<a href="inputs/manufacturers.html">
					<h1>Manufacturers</h1>
				</a>
			</div>
		</div>
	</div>
</body>
</html>