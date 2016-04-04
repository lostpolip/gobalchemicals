<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$result = $dbManagement->select("SELECT * FROM customer 
														JOIN aumphur ON customer.AumphurID=aumphur.AumphurID
														JOIN province ON customer.ProvinceID=province.ProvinceID
														JOIN  district ON customer.DistrictID=district.DistrictID
														JOIN zipcode ON customer.ZipcodeID=zipcode.ZipcodeID
														where CustomerID='" .$_REQUEST['idCustomer']. "'");

					$i = 0;
					if (mysqli_num_rows($result) > 0) {
					    while($row = mysqli_fetch_assoc($result)) {
					        $CustomerID[$i] = $row["CustomerID"];  
					       	$DistrictID[$i] = $row["DistrictID"];
					       	$DistrictName[$i] = $row["DistrictName"];
					        $ProvinceID[$i] = $row["ProvinceID"];
					        $ProvinceName[$i] = $row["ProvinceName"];
					        $ZipcodeID[$i] = $row["ZipcodeID"];
					        $Zipcode[$i] = $row["Zipcode"];
					        $AumphurID[$i] = $row["AumphurID"];
					        $AumphurName[$i] = $row["AumphurName"];
					        $i++;
					    }
					}
	
	$address = [
		'provinceID'		=> $ProvinceID[0],
		'provinceName'		=> $ProvinceName[0],
		'aumphurID'	=> $AumphurID[0],
		'aumphurName'	=> $AumphurName[0],
		'districtID'	=> $DistrictID[0],
		'districtName'	=> $DistrictName[0],
		'zipcodeID'	=> $ZipcodeID[0],
		'zipcode'	=> $Zipcode[0],
	];
	echo json_encode($address);

?>