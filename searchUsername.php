
<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$result = $dbManagement->select("SELECT * FROM  customer  WHERE CustomerUsername = '".$_REQUEST['name']."'");
	
	$dup = 0;
	if (mysqli_num_rows($result) > 0) {
		$dup	=	1;
	}
	
	
	echo $dup;
?>
