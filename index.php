<?php
session_start();

	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$result = $dbManagement->select("SELECT * FROM customer");

	$i = 0;
	if (mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_assoc($result)) {
	    	$CustomerID[$i] = $row["CustomerID"];
	    	$CustomerName[$i] = $row["CustomerName"];
	        $CustomerUsername[$i] = $row["CustomerUsername"];
	        $CustomerPassword[$i] = $row["CustomerPassword"];	
	        $StateCredit[$i] = $row["StateCredit"];	

	        $i++;
	    }
	}

	for($j=0; $j<$i; $j++){
		if($CustomerUsername[$j] ==  $_REQUEST['username'] && $CustomerPassword[$j] == $_REQUEST['password']){
			$_SESSION['CustomerID'] = $CustomerID[$j];
			$_SESSION['CustomerName'] = $CustomerName[$j];
			$_SESSION['StateCredit'] = $StateCredit[$j];
		}
	}


	$receive = $dbManagement->select("SELECT * FROM productreceive
									JOIN purchase ON productreceive.PurchaseID = purchase.PurchaseID
									WHERE StateReceive ='complete' AND AmountMinusOrder > 0
									ORDER BY ExpiryDate
									");

	$r = 0;
	$y = 0;
	$datenow = date('Y-m-d');

	if (mysqli_num_rows($receive) > 0) {
	    while($row = mysqli_fetch_assoc($receive)) {
	        $ProductPurchase[$r] = $row["ProductID"];
	        $PurchaseID[$r] = $row["PurchaseID"];
	        $ExpiryDate[$r] = $row["ExpiryDate"];
	        $Lot[$r] = $row["Lot"];
	        $ReceiveID[$r] = $row["ReceiveID"];
	        $AmountMinusOrder[$r] = $row["AmountMinusOrder"];

	        if ($ExpiryDate[$r] <= $datenow) {
	        	$alertLot[$y]	= [
	        		'lots'	=> $Lot[$r],
	        		'expirydate'	=> $ExpiryDate[$r],
	        		'purchase'	=> $PurchaseID[$r],
	        		'product'	=> $ProductPurchase[$r],
	        		'receiveid'	=> $ReceiveID[$r],
	        		'amount'	=> $AmountMinusOrder[$r],
	        	];
	        	$y++;
	        }
	        
	        $r++;
	    }
	}

	if ($y > 0) {
		for($l=0;$l<$y;$l++){ 
			$dbManagement->delete("DELETE FROM productreceive WHERE ExpiryDate= '".$alertLot[$l]['expirydate']."'");
		}
	}





	header( "location: /gobalchemicals/indexCustomer.php" );
?>