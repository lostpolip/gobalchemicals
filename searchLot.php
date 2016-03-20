
<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$lots = $_REQUEST['lot'];
	$result = $dbManagement->select("SELECT * FROM  productreceive  WHERE Lot = '".$lots."'");

	
	echo $lots;
?>
