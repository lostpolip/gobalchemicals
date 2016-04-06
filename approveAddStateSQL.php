<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$result = $dbManagement->select("SELECT * FROM product ");
		$i = 0;
			if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
			        $ProductID[$i] = $row["ProductID"];
			        $ProductAmount[$i] = $row["ProductAmount"];
			        $i++;
			    }
			}

	$receive = $dbManagement->select("SELECT AmountMinusOrder,ExpiryDate,ProductID 
									 FROM productreceive
									 ORDER BY ExpiryDate ASC
									");

	$r = 0;
	if (mysqli_num_rows($receive) > 0) {
	    while($row = mysqli_fetch_assoc($receive)) {
	        $ExpiryDate[$r] = $row["ExpiryDate"];
		    $ProductIDReceive[$r] = $row["ProductID"];
	        $AmountMinusOrder[$r] = $row["AmountMinusOrder"];	
	        $r++;
	    }
	}
		


	$claimid = explode(',',$_REQUEST['claimIdAll']);
	$totalunit = explode(',',$_REQUEST['totalUnit']);

	$productID = [];
	foreach ($claimid as $key => $value) {
		$temp = $ProductAmount[array_search($claimid[$key],$ProductID)] - $totalunit[$key];

		$dbManagement->update("UPDATE product SET ProductAmount='".$temp."' WHERE ProductID='".$claimid[$key]."'");

		$receive2 = $dbManagement->select("SELECT AmountMinusOrder,ExpiryDate,ProductID  
										 FROM productreceive 
										 WHERE ProductID='".$claimid[$key]."' AND AmountMinusOrder > 0
										 ORDER BY ExpiryDate ASC
										");
		$r2 = 0;
		if (mysqli_num_rows($receive2) > 0) {
		    while($row = mysqli_fetch_assoc($receive2)) {
		        $ExpiryDate2[$r2] = $row["ExpiryDate"];
		        $AmountMinusOrder2[$r2] = $row["AmountMinusOrder"];	
			    $ProductIDReceive2[$r2] = $row["ProductID"];
		        $r2++;
		    }
	}

	for ($i=0;$i<$r2;$i++) {
			$temp2 = $AmountMinusOrder2[$i] - $totalunit[$key];

			if ($AmountMinusOrder2[$i] >= $totalunit[$key]) {
				$dbManagement->update("UPDATE productreceive SET AmountMinusOrder='".$temp2."'
		 					   WHERE ProductID='".$claimid[$key]."'
		 					   AND ExpiryDate='". $ExpiryDate2[$i]."'");
				break;
			} else {
				$totalunit[$key] = $totalunit[$key] -  $AmountMinusOrder2[$i]; 
				$dbManagement->update("UPDATE productreceive SET AmountMinusOrder='0'
		 					   WHERE ProductID='".$claimid[$key]."'
		 					   AND ExpiryDate='". $ExpiryDate2[$i]."'");
			}

			
		}

	}

	$dbManagement->update("UPDATE claim SET StateClaim='complete' WHERE ClaimID='".$_REQUEST['claimId']."'");

		header( "location: /gobalchemicals/approveClaim.php" );
?>