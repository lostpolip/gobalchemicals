<?php

	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$Order = $dbManagement->select("SELECT * FROM orders 
									JOIN customer ON orders.CustomerID=customer.CustomerID
									WHERE State='no'
									");

	$r = 0;
	if (mysqli_num_rows($Order) > 0) {
	    while($row = mysqli_fetch_assoc($Order)) {
	    	$CustomerID[$r] = $row["CustomerID"];
	    	$CustomerName[$r] = $row["CustomerName"];
	    	$OrderID[$r] = $row["OrderID"];
	    	$OrderDate[$r] = $row["OrderDate"];
	    	$TotalPriceOrder[$r] = $row["TotalPriceOrder"];
	    	$TotalTransport[$r] = $row["TotalTransport"];
	    	$ExtendedPrice[$r] = $row["ExtendedPrice"];
	    	$State[$r] = $row["State"];
	        $r++;
	    }
	}

echo $r;

?>