<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();	
	$claimSenddate=$_REQUEST['claimDate'];
	$claimid=$_REQUEST['claimid'];
	$orderid=$_REQUEST['hiddenOrderId'];
	$dbManagement->update("UPDATE claim SET ClaimSendDate='".$claimSenddate."' WHERE ClaimID='".$claimid."'");

	require_once('mail.php');
	$mail = new mail;
	$or= "OR";
	$result=$dbManagement->select("SELECT * FROM claimdetail
							JOIN product  ON claimdetail.ProductID = product.ProductID
                            JOIN claim ON claimdetail.ClaimID=claim.ClaimID
							JOIN orders  ON claimdetail.OrderID = orders.OrderID
							WHERE claim.ClaimID ='".$claimid."'
							");

	$claim=$dbManagement->select("SELECT * FROM claim
							JOIN customer  ON claim.CustomerID = customer.CustomerID
							WHERE ClaimID ='".$claimid."'
							");

		$i = 0;
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$ClaimID[$i] = $row["ClaimID"];
				$OrderID[$i] = $row["OrderID"];
				$ProductID[$i] = $row["ProductID"];
				$ProductName[$i] = $row["ProductName"];
				$ClaimAmount[$i] = $row["ClaimAmount"];
				$ClaimProductDetail[$i] = $row["ClaimProductDetail"];
				$i++;
			}
		}

		$i = 0;
		if (mysqli_num_rows($claim) > 0) {
			while($row = mysqli_fetch_assoc($claim)) {
				$CustomerID[$i] = $row["CustomerID"];
				$CustomerName[$i] = $row["CustomerName"];
				$CustomerEmail[$i] = $row["CustomerEmail"];
				$CustomerTel[$i] = $row["CustomerTel"];
				$ClaimDate[$i] = $row["ClaimDate"];
				$ClaimSendDate[$i] = $row["ClaimSendDate"];
				$i++;
			}
		}

$body = '<!DOCTYPE html>
			<html>
				<head>
			    		<meta charset="utf-8">
			            <link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>
				</head>
					<body>
							<div class="floating-box" style="float: left;width: 1240px;height: 1020px;margin: 10px;border: 3px solid #E6E6E6; ">
								<div class="box-Logo" style="width: 220px; height: 100px; margin: 50px 0 0 100px;">
									<a href="http://www.mx7.com/view2/yV8WbW6C4pdEXtTJ" target="_blank"><img border="0" src="http://www.mx7.com/i/e9a/dU2SBm.png" /></a>
								</div>

								<div class="box-POId" style="width: 400px;height: 50px;float: right;font-size: 18px;">
									วันที่ส่งเคลมสินค้า :<label id="labelID" style="font-weight: bold; ">'.$ClaimDate[0].'</label>
									<br>
									เลขที่การเคลมสินค้า :<label id="labelDate">'.$ClaimID[0].'</label>
			                        <br>
			                        วันที่จัดส่งสินค้า :<label id="labelDate">'.$ClaimSendDate[0].'</label>
								</div>

								<div class="box-NamePO" style="font-size: 32px; font-weight: bold; margin: 20px 0 0 100px;">ใบแจ้งเคลมสินค้า</div>
								
								<div class="box-OrderBy" style="font-weight: bold; font-size: 22px; margin: 30px 0 0 100px;">
									ชื่อลูกค้า <br>
									<label style="font-size: 16px; margin: 30px 0 0 10px;">เรียน :'.$CustomerName[0].'</label><br>
									<label style="font-size: 16px; margin: 30px 0 0 10px;">Email :'.$CustomerEmail[0].'</label><br>
									<label style="font-size: 16px; margin: 30px 0 0 10px;">Phone Number :'. $CustomerTel[0].'</label><br>
	

								</div>
								
								<div class="box-Detail" style="width: 1040px; margin: 50px 0 0 100px;">
									<table id="table1" width="100%">
			                        	<tr>
			                        		<th style="border: 1px solid #000000; background-color: #A4A4A4;font-size: 18px;color: #000000;">รหัสสินค้า</th>
			                                <th style="border: 1px solid #000000; background-color: #A4A4A4;font-size: 18px;color: #000000;">ชื่อสินค้า</th>
			                                <th style="border: 1px solid #000000; background-color: #A4A4A4;font-size: 18px;color: #000000;">จำนวน</th>   
			                        	</tr>
			 
			                        	<tr>
			                        		<td id="productid" style="border: 1px solid #000000; background-color: #FFFFFF; font-size: 18px; color: #000000;">'.$ProductID[0].'</td>
			                        		<td id="productname" style="border: 1px solid #000000; background-color: #FFFFFF; font-size: 18px; color: #000000;">'.$ProductName[0].'</td>
			                        		<td id="productamount" style="border: 1px solid #000000; background-color: #FFFFFF; font-size: 18px; color: #000000; text-align: right;">'.$ClaimAmount[0].'</td>
			                        	</tr>
			                        </table>   
			                    </div>

			                    <div class="box-total" style="font-weight: bold; font-size: 19px; margin: 0px 0 0 100px;"> 
				                    	<table id="table1" width="91%">
				                        	<tr>
												<th style="border: 1px solid #000000; background-color: #D8D8D8;font-size: 18px;width: 728px; text-align: right; color: #000000;">รวมจำนวนสินค้าทั้งหมด(ถุง) :</th>
				                                <th style="border: 1px solid #000000; font-size: 18px;color: #000000;">'.$ClaimAmount[0].'</th>
				                            </tr>    
										</table>  
										<br>
										<label id="detail">รายละเอียดการแจ้งเคลม :'.$ClaimProductDetail[0].' </label> 
										<br>
			                    </div>
			                    <br>
			                    <div id="box-footer" style="border: 1px solid #999999; width:1030px; margin-left:100px;" >
			                        <div class="box-OrderBy" style="font-weight: bold; font-size: 22px; float:left;  margin: 30px 0 0 30px; width:300px;">
			                            The GolbalChemicals CO.,LTD 
			                            <br>
			                            <label style="font-size: 16px; margin: 30px 0 0 ">Email : nantiyathongpriwan@gmail.com</label><br>
			                          
			    
			                        </div> 
			                                                <div class="box-OrderBy" style="font-weight: bold; font-size: 22px;  width:700px; margin:0px 0 20px 380px; " >
			                            <br>
			                            <label style="font-size: 16px; margin: 30px 0 0 10px;">ติดต่อสอบถามรายละเอียดเพิ่มเติม</label><br>
			                            <label style="font-size: 16px; margin: 30px 0 0 10px;">สถานที่ติดต่อ :&nbsp; 87/84&nbsp; หมู่ 2&nbsp; ตำบลบางพลับ&nbsp; อำเภอปากเกร็ด&nbsp; จังหวัดนนทบุรี&nbsp; 11120</label><br>
			                            <label style="font-size: 16px; margin: 30px 0 0 10px;">Contact : 87/84  No.2</label>
			                            <label style="font-size: 16px; margin: 30px 0 0 10px;">Bang Pat Sub-district,Amphoe Pak Kret </label>
			                            <label style="font-size: 16px; margin: 30px 0 0 10px;">Nonthaburi  11120</label><br>
			                            <label style="font-size: 16px; margin: 30px 0 0 10px;">Phone Number :(668) 188-9525-0</label><br>
			                            <label style="font-size: 16px; margin: 30px 0 0 10px;">Fax Number :(662) 554-300</label>
			    
			                        </div>   
			                   </div>
							</div>
							
				</body>
			</html>

			';

$mail->sendmail($body,$CustomerEmail[0]);

$dbManagement->update("UPDATE orders SET State='Claimcomplete' WHERE OrderID='".$orderid."'");

header( "location: /gobalchemicals/approveClaim.php" );
?>