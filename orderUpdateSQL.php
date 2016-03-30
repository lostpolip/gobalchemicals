<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$totalPrice=$_REQUEST['totalOther'];
	$extendedPrice=str_replace(',', '', $totalPrice);
	$result = $dbManagement->select("SELECT * FROM product ");
		$i = 0;
			if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
			        $ProductID[$i] = $row["ProductID"];
			        $ProductAmount[$i] = $row["ProductAmount"];
			        $i++;
			    }
			}
	$orderid = explode(',',$_REQUEST['hiddenProductId']);
	$totalunit = explode(',',$_REQUEST['uniteachproduct']);
	foreach ($orderid as $key => $value) {
		$temp = $ProductAmount[array_search($orderid[$key],$ProductID)] - $totalunit[$key];

		$dbManagement->update("UPDATE product SET ProductAmount='".$temp."' WHERE ProductID='".$orderid[$key]."'");

	}
	
	$dbManagement->update("UPDATE orders SET State='processing',ExtendedPrice='".$extendedPrice."',TotalTransport ='".$_REQUEST['totalTransaction']."' WHERE OrderID='".$_REQUEST['orderID']."'");

	header( "location: /gobalchemicals/order.php" );
?>
