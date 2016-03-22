<?php
    require("../connect-db.php");
	// require("getJson.php");
	
	
	if(isset($_GET["ID"])){
		$ID=$_GET["ID"];
	}
	else{
		$ID="";
	}
	

	if(isset($_GET["TYPE"])){

		$type=$_GET["TYPE"];

	}

	// $ID="1";
	// $type="Proviance";
	
	if($type=='Proviance'){
		$query="SELECT PROVINCE_ID, PROVINCE_NAME FROM province ORDER BY PROVINCE_NAME ASC ";
	}else if($type=='District') {
		$query="SELECT AMPHUR_ID, AMPHUR_NAME FROM amphur WHERE PROVINCE_ID='".$ID."'";
	} else if($type=='Subdistrict'){
		$query="SELECT DISTRICT_ID, DISTRICT_NAME FROM district WHERE AMPHUR_ID='".$ID."'";
	} else if($type=='Postcode'){
		$query="SELECT POST_CODE FROM amphur_postcode WHERE AMPHUR_ID='".$ID."'";
	}
	$result=mysqli_query($connectHost,$query);
	$num=mysqli_num_rows($result);


	while($rows = mysqli_fetch_array($result)){
              
              $ResultRows[] = $rows;
	}

	echo json_encode($ResultRows);


?>