<?php
	session_start();

	require 'dbManagement.php';
	date_default_timezone_set('Asia/Bangkok');
	$dbManagement = new dbManagement();
	$order=$dbManagement->select("SELECT `OrderID` FROM `orders` ");
	$i = 0;
	$maxID = 0;
	if (mysqli_num_rows($order) > 0) {
		while($row = mysqli_fetch_assoc($order)) {
	        $OrderID[$i] = $row["OrderID"];

	        if ($maxID < str_replace('OR','',$OrderID[$i])) {
	        	$maxID = str_replace('OR','',$OrderID[$i]);
	        }
	        $i++;
		}
	}

	$newID = $maxID + 1;
	$orderID = $_REQUEST['order-id'];
	$orderIDArray = explode(' ',$orderID);

	$dbManagement->insert("INSERT INTO orders(`OrderID`, `CustomerID`, `State`, `OrderDate`) VALUES ('OR' '".$newID."','".$_SESSION['CustomerID']."','no','".date("Y-m-d")."')");


	foreach ($orderIDArray as $orderID) {
	$dbManagement->insert("INSERT INTO orderdetail(ProductID, OrderAmount, TotalVolumn, TotalCost,OrderID) VALUES ('".$_REQUEST['hiddenproductID'.$orderID]."','".$_REQUEST['hiddenProductOrder'.$orderID]."','".$_REQUEST['hiddentotalUnitOrder'.$orderID]."','".$_REQUEST['hiddentotalPriceOrder'.$orderID]."','OR' '".$newID."')");
	}


	// $product=$dbManagement->select("SELECT * 
	// 								  FROM orderdetail 
	// 								  JOIN product ON orderdetail.ProductID = product.ProductID
	// 								  JOIN orders 
	// 								  ON orderdetail.OrderID=orders.OrderID 
	// 								  WHERE CustomerID = '".$_SESSION['CustomerID']."'
	//                                   AND State = 'no' ");

	// 	$i = 0;
	// 	if (mysqli_num_rows($product) > 0) {
	// 		while($row = mysqli_fetch_assoc($product)) {
	// 	        $ProductID[$i] = $row["ProductID"];
	//         	$OrderID[$i] = $row["OrderID"];
		        
	// 	        $i++;
	// 		}
	// 	}

	// 	$productID = $_REQUEST['hiddenproductID' . $ProductID];

	// 	if($productID == $ProductID){
	// 		$dbManagement->update("UPDATE `orderdetail` SET OrderAmount='".$_REQUEST['hiddenProductOrder'.$orderID]."',TotalVolumn='".$_REQUEST['hiddentotalUnitOrder'.$orderID]."',TotalCost='".$_REQUEST['hiddentotalPriceOrder'.$orderID]."'");
	// 	}




// $product=$dbManagement->select("SELECT ProductID 
// 								  FROM orderdetail 
// 								  JOIN orders 
// 								  ON orderdetail.OrderID=orders.OrderID 
// 								  WHERE CustomerID = '".$_SESSION['CustomerID']."'
//                                   AND State = 'no' ");


// 	$i = 0;
// 	if (mysqli_num_rows($product) > 0) {
// 		while($row = mysqli_fetch_assoc($product)) {
// 	        $ProductID[$i] = $row["ProductID"];
// 	        $OrderID[$i] = $row["OrderID"];
// 	        $i++;
// 		}
// 	}
// 	$productID = $_REQUEST['hiddenproductID'.$orderID];

// 	foreach ($ProductID as $productID ) {
// 	$dbManagement->insert("UPDATE `orderdetail` SET OrderID='".$orderID."', ProductID='".$productID."',OrderAmount='".$_REQUEST['hiddenProductOrder'.$orderID]."'");
// 	}

// 	print_r("UPDATE `orderdetail` SET ProductID='".$productID."',OrderAmount='".$_REQUEST['hiddenProductOrder'.$orderID]."'");
	
	header( "location: /gobalchemicals/orderBasket.php" );

?>