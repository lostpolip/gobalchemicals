<?php
		require 'dbManagement.php';
		$dbManagement = new dbManagement();

		$sumExpenses=$dbManagement->select("SELECT TransportDate,transport.TruckID,COUNT(transport.TruckID) AS AmountTruck,TruckTypeID 
			FROM transport JOIN truck ON transport.TruckID=truck.TruckID 
			 WHERE TransportDate between '".$_REQUEST['startdate']."' and '".$_REQUEST['enddate']."'
			 GROUP BY TruckTypeID
			 ORDER BY TransportDate
		 ");
		$i = 0;
		if (mysqli_num_rows($sumExpenses) > 0) {
			while($row = mysqli_fetch_assoc($sumExpenses)) {
		        if ($i == 0) {
					$TransportDate = $row["TransportDate"];
			        $TruckTypeID = $row["TruckTypeID"];
			        $AmountTruck = $row["AmountTruck"];
			     
		        } else {
		        	$TransportDate = $TransportDate.','.$row["TransportDate"];
			        $TruckTypeID = $TruckTypeID.','.$row["TruckTypeID"];
			        $AmountTruck = $AmountTruck.','.$row["AmountTruck"];
			 
		        }
		        
		        $i++;
			}
		}
	$info = [
		'date' => $TransportDate,
		'type' => $TruckTypeID,
		'amount' => $AmountTruck,
	];
	
	echo json_encode($info);
?>