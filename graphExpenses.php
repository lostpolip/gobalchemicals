<?php
		require 'dbManagement.php';
		$dbManagement = new dbManagement();

		$sumExpensesOrder=$dbManagement->select("SELECT SUM(`TotalTransport`) AS TotalTransport,`OrderSendDate`
											FROM `orders` 
											JOIN transportdetail ON orders.`TransportID`=transportdetail.TransportID 
											GROUP BY `OrderSendDate`
										 	");
		$i = 0;
		if (mysqli_num_rows($sumExpensesOrder) > 0) {
			while($row = mysqli_fetch_assoc($sumExpensesOrder)) {
		        if ($i == 0) {
					$OrderSendDate = $row["OrderSendDate"];
			        $TotalTransport = $row["TotalTransport"];
			     
		        } else {
		        	$OrderSendDate = $OrderSendDate.','.$row["OrderSendDate"];
			        $TotalTransport = $TotalTransport.','.$row["TotalTransport"];
			 
		        }
		        
		        $i++;
			}
		}

		$sumExpenses=$dbManagement->select("SELECT SUM(`ExpensesPerAround`) AS ExpensesPerAround ,TransportDate 
											FROM expensesdetail 
											JOIN transportdetail ON expensesdetail.`TransportID`=transportdetail.TransportID 
											GROUP BY TransportDate
										 	");
		$e = 0;
		if (mysqli_num_rows($sumExpenses) > 0) {
			while($row = mysqli_fetch_assoc($sumExpenses)) {
		        if ($e == 0) {
					$TransportDate = $row["TransportDate"];
			        $ExpensesPerAround = $row["ExpensesPerAround"];
			     
		        } else {
		        	$TransportDate = $TransportDate.','.$row["TransportDate"];
			        $ExpensesPerAround = $ExpensesPerAround.','.$row["ExpensesPerAround"];
			 
		        }
		        
		        $e++;
			}
		}




	$info = [
		'dateOrder' => $OrderSendDate,
		'expensesOrder' => $TotalTransport,
		'expenses' => $ExpensesPerAround,
	];
	
	echo json_encode($info);
?>