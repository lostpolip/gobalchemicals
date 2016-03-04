<?php
session_start();

	require 'dbManagement.php';
	$dbManagement = new dbManagement();	
    $customer = $dbManagement->select("SELECT * FROM customer");
    $i = 0;
    if (mysqli_num_rows($customer) > 0) {
        while($row = mysqli_fetch_assoc($customer)) {
            $CustomerID[$i] = $row["CustomerID"];
            $CustomerName[$i] = $row["CustomerName"];
            $CustomerUsername[$i] = $row["CustomerUsername"];
            $i++;
        }              
    }	
    
	$username=$_REQUEST['txtUsername'];
	$x=0;
	for($j=0; $j<$i; $j++){

		if($username ==$CustomerUsername[$j]){
			$x=$username;
			break;
		}
	}
		if (!$x== $username) {
			$dbManagement->insert("INSERT INTO customer(CustomerName, CustomerAddress, AumphurID, ProvinceID, ZipcodeID, CustomerTel, CustomerFax, CustomerEmail, CustomerUsername, CustomerPassword, DistrictID, Latitude, Longitude)  VALUES ('".$_REQUEST['txtName']."','".$_REQUEST['txtAddress']."','".$_REQUEST['txtDistrict']."','".$_REQUEST['province']."','".$_REQUEST['txtZipcode']."','".$_REQUEST['txtTel']."','".$_REQUEST['txtFax']."','".$_REQUEST['txtEmail']."','".$username."','".$_REQUEST['txtPassword']."','".$_REQUEST['txtSubDistrict']."','".$_REQUEST['txtLatitude']."','".$_REQUEST['txtLongitude']."')");

		}
         
	header( "location: /gobalchemicals/register.php" );
?>
