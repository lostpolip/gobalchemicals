<?php
require 'dbManagement.php';
$dbManagement = new dbManagement();
$datetransport = $_REQUEST['datetransport'];

$order = $dbManagement->select("SELECT * FROM orders
								JOIN customer ON orders.CustomerID=customer.CustomerID
								JOIN aumphur ON orders.AumphurID=aumphur.AumphurID
								WHERE State='processing' AND OrderSendDate = '".$datetransport."'
								");

$popupOrder = 0;
if (mysqli_num_rows($order) > 0) {
    while($row = mysqli_fetch_assoc($order)) {
        $OrderID[$popupOrder] = $row["OrderID"];
        $OrderDate[$popupOrder] = $row["OrderDate"];
        $CustomerID[$popupOrder] = $row["CustomerID"];
        $CustomerName[$popupOrder] = $row["CustomerName"];
        $latOrder[$popupOrder] = $row["latOrder"];
        $lonOrder[$popupOrder] = $row["lonOrder"];
        $Distance[$popupOrder] = $row["Distance"];
        $UnitProduct[$popupOrder] = $row["UnitProduct"];
        $AumphurID[$popupOrder] = $row["AumphurID"];
        $GeoName[$popupOrder] = $row["GeoName"];
        $OrderSendDate[$popupOrder] = $row["OrderSendDate"];
        $popupOrder++;
    }		   
}

$order = [
	'OrderID' => $OrderID,
	'OrderDate' => $OrderDate,
	'CustomerName' => $CustomerName,
	'UnitProduct' => $UnitProduct,
	'GeoName' => $GeoName,
	'OrderSendDate' => $OrderSendDate,
];

echo json_encode($order);
?>