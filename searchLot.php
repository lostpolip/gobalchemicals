
<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$lots = $_REQUEST['lot'];
	$result = $dbManagement->select("SELECT * FROM  productreceive  WHERE Lot = '".$lots."'");

	$dup = 0;
	if (mysqli_num_rows($result) > 0) {
		$dup	=	1;
	}
	
	
	echo $dup;
?>
