
<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$username = $_REQUEST['nameEm'];
	$result = $dbManagement->select("SELECT * FROM  employee  WHERE EmployeeUsername = '".$username."'");
	
	$dup = 0;
	if (mysqli_num_rows($result) > 0) {
		$dup	=	1;
	}
	
	
	echo $dup;
?>
