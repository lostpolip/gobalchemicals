<?php
		require 'dbManagement.php';
		$dbManagement = new dbManagement();

		$sumExpenses=$dbManagement->select("SELECT ExpensesDate,SUM(ExpensesPerDay) AS ExpensesPerDay 
										 FROM expenses
										 WHERE ExpensesDate between '".$_REQUEST['startdate']."' and '".$_REQUEST['enddate']."'
										 	GROUP BY ExpensesDate
										 ");
		$i = 0;
		if (mysqli_num_rows($sumExpenses) > 0) {
			while($row = mysqli_fetch_assoc($sumExpenses)) {
		        if ($i == 0) {
					$ExpensesDate = $row["ExpensesDate"];
			        $ExpensesPerDay = $row["ExpensesPerDay"];
			     
		        } else {
		        	$ExpensesDate = $ExpensesDate.','.$row["ExpensesDate"];
			        $ExpensesPerDay = $ExpensesPerDay.','.$row["ExpensesPerDay"];
			 
		        }
		        
		        $i++;
			}
		}
	$info = [
		'date' => $ExpensesDate,
		'expenses' => $ExpensesPerDay,
	];
	
	echo json_encode($info);
?>