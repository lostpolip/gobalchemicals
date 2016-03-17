<?php
	date_default_timezone_set('Asia/Bangkok');
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$result = $dbManagement->select("SELECT * FROM  claim  
									JOIN customer ON claim.CustomerID=customer.CustomerID
									WHERE StateClaim='Processing'		
									");


	$i = 0;
	if (mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_assoc($result)) {
	        $ClaimID[$i] = $row["ClaimID"];
	        $ClaimDate[$i] = $row["ClaimDate"];
	        $CustomerID[$i] = $row["CustomerID"];
	        $CustomerName[$i] = $row["CustomerName"];
	        $StateClaim[$i] = $row["StateClaim"];
	        $ClaimSendDate[$i] = $row["ClaimSendDate"];
	        $i++;
	    }
	}
echo $i;


?>