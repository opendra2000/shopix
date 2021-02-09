<?php
	require_once('../inputs/config.php');
	$conn = mysqli_connect($servername, $username, $password, $dbname) or die($conn); 

	function get_product($conn, $term){ 
		$query = "SELECT * FROM Products WHERE name LIKE '%".$term."%' ORDER BY name ASC";
		$result = mysqli_query($conn, $query); 
		$data = mysqli_fetch_all($result,MYSQLI_ASSOC);
		
		return $data; 
	}
	 
	$getProducts = get_product($conn, $_GET['term']);
	$productList = array();
		
	foreach($getProducts as $product){
		$productList[] = $product['name'];
	}
		
	echo json_encode($productList);
?>