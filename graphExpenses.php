<?php
		require 'dbManagement.php';
		$dbManagement = new dbManagement();

		$sumExpenses=$dbManagement->select("SELECT ExpensesDate,SUM(ExpensesPerAround) AS ExpensesPerAround 
										 FROM expenses
										 JOIN expensesdetail ON expenses.ExpensesID=expensesdetail.ExpensesID
										 WHERE ExpensesDate between '".$_REQUEST['startdate']."' and '".$_REQUEST['enddate']."'
										 	GROUP BY ExpensesDate
										 ");
		$i = 0;
		if (mysqli_num_rows($sumExpenses) > 0) {
			while($row = mysqli_fetch_assoc($sumExpenses)) {
		        if ($i == 0) {
					$ExpensesDate = $row["ExpensesDate"];
			        $ExpensesPerAround = $row["ExpensesPerAround"];
			     
		        } else {
		        	$ExpensesDate = $ExpensesDate.','.$row["ExpensesDate"];
			        $ExpensesPerAround = $ExpensesPerAround.','.$row["ExpensesPerAround"];
			 
		        }
		        
		        $i++;
			}
		}
	$info = [
		'date' => $ExpensesDate,
		'expenses' => $ExpensesPerAround,
	];
	
	echo json_encode($info);
?>