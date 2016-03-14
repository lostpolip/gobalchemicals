<?php
		require 'dbManagement.php';
		$dbManagement = new dbManagement();

		$reportOrder=$dbManagement->select("SELECT * FROM orders WHERE OrderDate >'2016-3-14'");

		$sumOrder=$dbManagement->select("SELECT orders.OrderDate,SUM(orders.ExtendedPrice) FROM orders
										 WHERE OrderDate between '".$_REQUEST['startdate']."' and '".$_REQUEST['enddate']."'
										 	GROUP BY OrderDate
										 ");

		$i = 0;
		if (mysqli_num_rows($sumOrder) > 0) {
			while($row = mysqli_fetch_assoc($sumOrder)) {
		        if ($i == 0) {
					$OrderDate = $row["OrderDate"];
			        $ExtendedPrice = $row["ExtendedPrice"];
		        } else {
		        	$OrderDate = $OrderDate.','.$row["OrderDate"];
			        $ExtendedPrice = $ExtendedPrice.','.$row["ExtendedPrice"];
		        }
		        
		        $i++;
			}
		}
	$info = [
		'date' => $OrderDate,
		'price' => $ExtendedPrice,
	];
	echo json_encode($info);
?>