<?php
		require 'dbManagement.php';
		$dbManagement = new dbManagement();

		$sumOrder=$dbManagement->select("SELECT OrderDate,SUM(TotalPriceOrder) AS TotalPriceOrder FROM orders
										 WHERE OrderDate between '".$_REQUEST['startdate']."' and '".$_REQUEST['enddate']."'
										 	GROUP BY OrderDate
										 ");
		$i = 0;
		if (mysqli_num_rows($sumOrder) > 0) {
			while($row = mysqli_fetch_assoc($sumOrder)) {
		        if ($i == 0) {
					$OrderDate = $row["OrderDate"];
			        $TotalPriceOrder = $row["TotalPriceOrder"];
		        } else {
		        	$OrderDate = $OrderDate.','.$row["OrderDate"];
			        $TotalPriceOrder = $TotalPriceOrder.','.$row["TotalPriceOrder"];
		        }
		        
		        $i++;
			}
		}
	$info = [
		'date' => $OrderDate,
		'price' => $TotalPriceOrder,
	];
	
	echo json_encode($info);
?>