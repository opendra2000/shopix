<?php 
	require_once( "../inputs/config.php");
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

	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	 
	<!-- jQuery UI -->
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../style.css?v=1.1">
	<title>Find Store/Item Query | Shopix</title>
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

		<form action="search-productsbyavailability.php" class="input-form" method="POST">
			<h2>Find products by name and which are available</h2>
			<p>Input products here</p>
			<p><u><a href="../inputs/productsall.php">View full table of products</a></u></p>

			<label for="product-name">Name</label>
			<input type="text" id="tags" name="product-name" placeholder="Please enter product name" required>

			<button class="submit-btn" type="submit">View results</button>
		</form>
	</div>

	<script type="text/javascript">
	  $(function() {
	     $( "#tags" ).autocomplete({
	       source: 'search-products.php',
	     });
	  });
	</script>
</body>
</html>