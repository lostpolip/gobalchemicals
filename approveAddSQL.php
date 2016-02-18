<?php
require 'dbManagement.php';
$dbManagement = new dbManagement();

// $claim=$dbManagement->select("SELECT ClaimID FROM claim ");
// 	 			$ddClaim = 0;
// 	 				if (mysqli_num_rows($claim) > 0) {
// 	 		   			 while($row = mysqli_fetch_assoc($claim)) {
// 	 				        $ClaimID[$ddClaim] = $row["ClaimID"];
// 	 				        $ddClaim++;
// 	 		    		}
// 	 				}
// $cm=$_REQUEST[$ClaimID];
$claim=$dbManagement->insert("INSERT INTO claim (ClaimSendDate) VALUES ('".$_REQUEST['claimDate']."') ");
// header( "location: /gobalchemicals/approveOrder.php" );
?>