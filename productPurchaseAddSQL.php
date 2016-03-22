<?php
	require 'dbManagement.php';
	date_default_timezone_set('Asia/Bangkok');
	$dbManagement = new dbManagement();

	$purchase=$dbManagement->select("SELECT PurchaseID FROM purchase ");
	$i = 0;
	$maxID = 0;
	if (mysqli_num_rows($purchase) > 0) {
		while($row = mysqli_fetch_assoc($purchase)) {
	        $PurchaseID[$i] = $row["PurchaseID"];

	        if ($maxID < str_replace('PO','',$PurchaseID[$i])) {
	        	$maxID = str_replace('PO','',$PurchaseID[$i]);
	        }
	        $i++;
		}
	}
	$newID = $maxID + 1;
	$newID = 'PO'.$newID;

	$dbManagement->insert("INSERT INTO purchase(PurchaseID, PurchaseDate, SupplierID, ProductID, PurchaseAmount, StatePurchase,PurchaseDetail,AmountMinusReceive) VALUES ('".$newID."','".date("Y-m-d")."','".$_REQUEST['supplierId']."','".$_REQUEST['ddProduct']."','".$_REQUEST['txtProductAmount']."','processing','".$_REQUEST['txtPurchaseDetail']."','".$_REQUEST['txtProductAmount']."')");


require_once('mail.php');
$mail = new mail;
$or= "OR";
$result=$dbManagement->select("SELECT * FROM purchase
						JOIN supplier ON purchase.SupplierID = supplier.SupplierID
						JOIN product  ON purchase.ProductID = product.ProductID
						WHERE PurchaseID ='".$newID."'");

					$i = 0;
					if (mysqli_num_rows($result) > 0) {
					    while($row = mysqli_fetch_assoc($result)) {
					        $PurchaseID[$i] = $row["PurchaseID"];
					        $PurchaseDate[$i] = $row["PurchaseDate"];
					        $SupplierID[$i] = $row["SupplierID"];
					        $SupplierName[$i] = $row["SupplierName"];
					        $SupplierEmail[$i] = $row["SupplierEmail"];
					        $ProductID[$i] = $row["ProductID"];
					        $ProductName[$i] = $row["ProductName"];
					        $PurchaseAmount[$i] = $row["PurchaseAmount"];
					        $PurchaseDetail[$i] = $row["PurchaseDetail"];
					        $i++;
					    }
					}

$body = '<!DOCTYPE html>
			<html>
				<head>
				</head>
					<body>
				<div class="floating-box" style="float: left;width: 1040px;height: 900px;margin: 10px;border: 3px solid #E6E6E6; ">
					<div class="box-Logo" style="width: 220px; height: 100px; margin: 50px 0 0 100px;">
						<a href="http://www.mx7.com/view2/yV8WbW6C4pdEXtTJ" target="_blank"><img border="0" src="http://www.mx7.com/i/e9a/dU2SBm.png" /></a>
					</div>

					<div class="box-POId" style="width: 300px;height: 50px;float: right;font-size: 18px;">
						P.O Number :<label id="labelID" style="font-weight: bold;">' .$newID. '</label>
						<br>
						P.O Date :<label id="labelDate">'.$PurchaseDate[0].'</label>
					</div>

					<div class="box-NamePO" style="font-size: 32px; font-weight: bold; margin: 20px 0 0 100px;">Purchase Order</div>

					<div class="box-OrderBy" style="font-weight: bold; font-size: 22px; margin: 30px 0 0 100px;">
						Ordered By <br>
						<label style="font-size: 16px; margin: 30px 0 0 10px;">The GolbalChemicals CO.,LTD</label><br>
						<label style="font-size: 16px; margin: 30px 0 0 10px;">87/84  No.2</label><br>
						<label style="font-size: 16px; margin: 30px 0 0 10px;">Bang Pat Sub-district,Amphoe Pak Kret </label><br>
						<label style="font-size: 16px; margin: 30px 0 0 10px;">Nonthaburi  11120</label><br>	
						<label style="font-size: 16px; margin: 30px 0 0 10px;">Phone Number :(668) 188-9525-0</label><br>
						<label style="font-size: 16px; margin: 30px 0 0 10px;">Fax Number :(662) 554-300</label>

					</div>

					<div class="box-Detail" style="width: 840px; margin: 50px 0 0 100px;">
						<table id="table1" width="100%">
                        	<tr>
                        		<th style="border: 1px solid #000000; background-color: #A4A4A4;font-size: 18px;color: #000000;">Part No.</th>
                                <th style="border: 1px solid #000000; background-color: #A4A4A4;font-size: 18px;color: #000000;">Description</th>
                                <th style="border: 1px solid #000000; background-color: #A4A4A4;font-size: 18px;color: #000000;">Quanity</th>
                                
                        	</tr>
 
                        	<tr>
                        		<td id="productid" style="border: 1px solid #000000; background-color: #FFFFFF; font-size: 18px; color: #000000;">'.$ProductID[0].'</td>
                        		<td id="productname" style="border: 1px solid #000000; background-color: #FFFFFF; font-size: 18px; color: #000000;">'.$ProductName[0].'</td>
                        		<td id="productamount" style="border: 1px solid #000000; background-color: #FFFFFF; font-size: 18px; color: #000000; text-align: right;">'.$PurchaseAmount[0].'</td>


                        	</tr>
                        </table>   
                    </div>

                    <div class="box-total" style="font-weight: bold; font-size: 19px; margin: 0px 0 0 100px;"> 
                    	<table id="table1" width="91%">
                        	<tr>
								<th style="border: 1px solid #000000; background-color: #D8D8D8;font-size: 18px;width: 728px; text-align: right; color: #000000;">Total Quanity(Ton) :</th>
                                <th style="border: 1px solid #000000; font-size: 18px;color: #000000;">'.$PurchaseAmount[0].'</th>
                            </tr>    
						</table>  
						<label id="detail">More Detail :'.$PurchaseDetail[0].' </label>  
                    </div>  
				</div>
				</body>
			</html>
			';

$mail->sendmail($body,$SupplierEmail[0]);

header( "location: /gobalchemicals/productPurchase.php" );
?>