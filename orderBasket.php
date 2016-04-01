<?php
	session_start();
	if(!isset($_SESSION['CustomerName'])){
		header( "location: /gobalchemicals/index.html" );
	}
?>
<!DOCTYPE html>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>The GobalChemicals CO.,LTD.</title> 
		<meta charset="utf-8">
		<meta name="keywords" content="" />
		<meta name="description" content="" />

		<link href="css/orderBasket.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
		<script type="text/javascript" src="js/orderBasket.js"></script>

		<script type="text/javascript">
			$( document ).ready(function() {
				 if (window.history && window.history.pushState) {
				    window.history.pushState('forward', null, './order.php');
				    $(window).on('popstate', function() {
				      window.location.href = 'http://localhost/gobalchemicals/order.php';
				    });
				  }
			});
		</script>

		<style type="text/css">
			#OrderID{
				margin: 20px 0 20px 25px;
				font-family: 'quarkbold';
				color: #FFFFFF;
				font-size: 24px;	
			}

			#OrderSendDate{
				margin: 20px 0 20px 140px;
				font-family: 'quarkbold';
				color: #FFFFFF;
				font-size: 22px;	
			}
		</style>

	</head>
	<body>
	<?php 
		$orderId = explode(' ',$_REQUEST['order-id']);
		// print_r($_REQUEST);
		require 'dbManagement.php';
		$dbManagement = new dbManagement();
		date_default_timezone_set('Asia/Bangkok');
		$order=$dbManagement->select("SELECT OrderID FROM orders ");
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
		$newID = 'OR'.$newID;
		$product = $dbManagement->select("SELECT * FROM product WHERE StateProduct='confirm'");
			$i = 0;
			if (mysqli_num_rows($product) > 0) {
			    while($row = mysqli_fetch_assoc($product)) {
			        $ProductID[$i] = $row["ProductID"];
			        $ProductName[$i] = $row["ProductName"];
			        $Price[$i] = $row["Price"];
			        $i++;
			    }
			}
		$result=$dbManagement->select("SELECT * FROM customer
											JOIN province ON customer.ProvinceID=province.ProvinceID
											JOIN aumphur ON customer.AumphurID=aumphur.AumphurID
											JOIN district ON customer.DistrictID=district.DistrictID
											JOIN zipcode ON customer.ZipcodeID=zipcode.ZipcodeID
											WHERE CustomerID='".$_SESSION['CustomerID']."'");

		$rate=$dbManagement->select("SELECT * FROM rate");

			$i = 0;
			if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
			    	$CustomerID[$i] = $row["CustomerID"];
			    	$CustomerName[$i] = $row["CustomerName"];
			        $Distance[$i] = $row["Distance"];	
			        $i++;
			    }
			}
			$r = 0;
			if (mysqli_num_rows($rate) > 0) {
			    while($row = mysqli_fetch_assoc($rate)) {
			    	$RateID[$r] = $row["RateID"];
			    	$WeightOfProduct[$r] = $row["WeightOfProduct"];
			    	$RatePerKm[$r] = $row["RatePerKm"];
			        $r++;
			    }
			}							
		
			$Province = $dbManagement->select("SELECT * FROM province ORDER BY ProvinceName");
			$i = 0;
			if (mysqli_num_rows($Province) > 0) {
			    while($row = mysqli_fetch_assoc($Province)) {
			    	$ProvinceID[$i] = $row["ProvinceID"];
			        $ProvinceName[$i] = $row["ProvinceName"];
			        $i++;
    		    }			   
			}
	?>
	
			<div id="tooplate_body_wrapper">
				<div id="tooplate_wrapper">				
					<div id="tooplate_header">	
                    	<div id="tooplate_user">
							<label id="label1"><?php echo $_SESSION['CustomerName']?> |&nbsp;</label>
                        </div>						
					  <div id="tooplate_top">
							<div id="tooplate_login">
		                       <form action="index.html" method="get">
		  							<a href="logOut.php"><input type="button" name="Search" value="" alt="Search" id="searchbutton" class="sub_btn"  /></a>
								</form>
							</div>
						</div>
						<div id="site_title"><h1><a href="indexCustomer.php">Gray Box</a></h1></div>
							<div id="tooplate_menu" class="ddsmoothmenu">
								<ul>
			                       <li><a href="profileDetail.php">ข้อมูลส่วนตัว</a> </li>
						
									<li><a href="order.php" class="selected">สั่งซื้อสินค้า</a></li>

									<li><a href="orderList.php" >รายการสั่งซื้อ</a></li>
									
									<li><a href="claim.php" >แจ้งเคลมสินค้า</a></li>
								</ul>
							</div> <!-- end of tooplate_menu -->
					</div> <!-- end of tooplate_header -->
				</div><!--end of tooplate_wrapper-->
		</div><!--end of tooplate_body_wrapper-->


	<form action="orderAddSQL.php">
		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l"><br>

						<label id="label1">รายการสั่งซื้อ</label>
						<br>

						<tr>
	                        <td><label id="OrderDate">วันที่สั่งซื้อ: </label></td>
	                        <td><label id="txtOrderID" name="txtOrderID" ><?php echo date("Y-m-d"); ?></label>
	                        	<input type="hidden" id="hiddenOrderDate" name="hiddenOrderDate" value="<?php echo date("Y-m-d"); ?>" >


	                        <td><label id="OrderID">รหัสการสั่งซื้อ:</label></td>
	                        <td><label id="txtOrderID" name="txtOrderID" ><?php echo $newID ?></label>
	                        	<input type="hidden" id="hiddenOrderID" name="hiddenOrderID" value="<?php echo $newID ?>">
	                        </td>

	                        <td><label id="OrderSendDate">กำหนดวันส่งสินค้า: </label></td>
	                        <td><input type="date" id="hiddenOrderSendDate" name="hiddenOrderSendDate" min="<?php echo date("Y-m-d"); ?>"></td>

	                    </tr>

                    	<div id="informationCustomer">
							<input type="image" src="images/tabCustomer.png" id="informationCustomer">

						<br>
						<br>

                            <tr>
                                <td><label style="font-family: 'quarkbold'; color: #000; font-size: 22px;">จังหวัด :</label></td>
                                <td>
                                	<select id="province" name="province" required>
                                	<option value="" selected>--- เลือกจังหวัด ---</option>
                                	 	<?php
                        					for($j=0;$j<$i;$j++){ 
                        				?>	
                                		<option value="<?php echo $ProvinceID[$j]; ?>"><?php echo $ProvinceName[$j]; ?></option>
                                		<?php
                        					}
                        				?>
									</select> 
								</td>
                            </tr>         
                            <br>
                            <tr id="district-row">
                                <td><label style="font-family: 'quarkbold'; color: #000; font-size: 22px;">อำเภอ :</label></td>
                                <td><select id="txtDistrict" name="txtDistrict">                                                              
                                </select> 
                                </td>
                            </tr>
                            <br>
                            <tr id="subDistrict-row">
                                <td><label style="font-family: 'quarkbold'; color: #000; font-size: 22px;">ตำบล :</label></td>
                                <td><select id="txtSubDistrict" name="txtSubDistrict">
                                </select>
                                </td>
                            </tr>                            
                            <br>                         
                            <tr id="zipcode-row">
                                <td><label style="font-family: 'quarkbold'; color: #000; font-size: 22px;">รหัสไปรษณีย์ :</label></td>
                                <td><select type="text" id="txtZipcode" name="txtZipcode" >
                                </select>
                                </td>
                            </tr>
                            <br>
                            <br>
							<tr>   
                                     <td><button type="button" id="btnCF" class="btn btn-primary" style="margin-left: 380px; font-family: 'quarklight'; font-size: 22px;">ค้นหา</button></td>  
                            </tr>

                            <br>
                            <br>
                      

							<tr>
								<div id="mapInfo">
									<label id="labelMap" style="font-family: 'quarkbold'; color: #F7D358; font-size: 24px;margin-left: 300px;">กรุณาลากตำแหน่งที่จะส่งสินค้า</label>
			                            <div id="map_canvas" style="width:820px; height:400px; margin-left:0px; "></div>     
			                                    <input type="hidden" name="lat_value" type="text" id="lat_value" > 
			                                    <input type="hidden" name="lon_value" type="text" id="lon_value" > 
			                                    <input type="hidden" id="txtDistance" name="txtDistance">
			                                    <button type="button" id="btncalculator"  class="btn btn-warning" style="margin: 30px 0 30px 360px; font-family: 'quarklight'; font-size: 22px;">คำนวณแผนที่</button>  
								</div>
							</tr>
							<br>
                    	</div>

						<div class="button-menu">
							<input type="image" src="images/buttonBasket1.png" alt="Submit" id="menu0rder">

						</div>

						<table id="table2" width="95%">
                        	<tr>
                        		<th>รหัสสินค้า</th>
                                <th>ชื่อสินค้า</th>
                                <th>จำนวน (ตัน)</th>
                                <th>จำนวน (ถุง)</th>
                                <th>ราคา</th>
                                <th>รวม</th>
                        	</tr>


                        	<?php 
                        		$totalPrice = 0;
                        		$totalCost = 0;
                        		$ExtendedPrice = 0;
                        		$unitProduct = 0;
                        		$productIdAll = '';
                        		$uniteachproduct='';
                        		foreach ($orderId as $key => $value) {
                        			$totalPrice = $totalPrice+$_REQUEST["hiddentotalPriceOrder$value"];
                        			$totalCost = $totalCost+$_REQUEST["hiddentotalCostOrder$value"];
                        			$unitProduct = $unitProduct+$_REQUEST["hiddenProductOrder$value"];
                        			if ($key == 0) {
                        				$productIdAll = $productIdAll.$value;
                        				$uniteachproduct=$uniteachproduct.$_REQUEST["hiddenProductOrder$value"];
                        			} else {
                        				$productIdAll = $productIdAll.','.$value;
                        				$uniteachproduct=$uniteachproduct.','.$_REQUEST["hiddenProductOrder$value"];
                        			}
                        	?>
                        	<tr id="orderList">
                        		<td id="productid"><?php echo $value ?></td>
                        		<td id="productname"><?php echo $ProductName[array_search($value ,$ProductID)] ?></td>
                        		<td id="orderamount"><?php echo $_REQUEST["hiddenProductOrder$value"] ?></td>
                        		<td id="totalUnit"><?php echo number_format($_REQUEST["hiddentotalUnitOrder$value"]); ?></td>
                        		<td id="productprice"><?php echo number_format($Price[array_search($value ,$ProductID)]); ?></td>
                        		<td id="totalprice"><?php echo number_format($_REQUEST["hiddentotalPriceOrder$value"]); ?></td>


                        		<input type="hidden" name="<?php echo 'hiddenProductId' ?>" value="<?php echo $productIdAll ?>">
                        		<input type="hidden" name="<?php echo 'hiddenOrderAmount'.$value ?>" value="<?php echo $_REQUEST["hiddenProductOrder$value"] ?>">
                        		<input type="hidden" name="<?php echo 'hiddenTotalUnit'.$value ?>" value="<?php echo $_REQUEST["hiddentotalUnitOrder$value"] ?>">
                        		<input type="hidden" name="<?php echo 'hiddenTotalPrice'.$value ?>" value="<?php echo $_REQUEST["hiddentotalPriceOrder$value"] ?>">
                        		<input type="hidden" name="<?php echo 'hiddenTotalCost'.$value ?>" value="<?php echo $_REQUEST["hiddentotalCostOrder$value"] ?>">
                        		<input type="hidden" name="hiddenUnitProductAll" value="<?php echo $unitProduct ?>">
                        		<input type="hidden" name="hiddenTotalCostAll" value="<?php echo $totalCost ?>">
                        		<input type="hidden" name="hiddenEachUnit" value="<?php echo $uniteachproduct ?>"></input>
                        	</tr>
                        	<?php
                        		}
                        		$vat = $totalPrice*7/100;
                        		for ($x=0; $x < $r ; $x++) { 
									if ($unitProduct<=$WeightOfProduct[$x]) {
										break;
									}
								}	
								
								$ExtendedPrice= $totalPrice+$vat;
                        	?>
                          
                        </table> 
 

                    <br>
                    <div class="col_w540"><br> 
                    	<div class="boxPayment">
                    		<label><span id="star">*</span>เงื่อนไขในการชำระเงิน : เครดิต 30 วัน</label>   		
                    	</div>

                    	<div class="boxSummaryPrice">
                    		<table id="table3">
                    			<tr>
	                    			<td>
	                    				<label>ราคาสินค้า :</label>
	                    			</td>
	                    			<td>
		                        		<input id="totalPriceAll" name="totalPriceAll" value="<?php echo number_format($totalPrice); ?>" readonly> 
		                        		<label>บาท</label>
		                        	</td>
		                        </tr>

                    			<tr>
	                    			<td>
	                    				<label>ภาษีมูลค่าเพิ่ม 7% :</label>
	                    			</td>
	                    			<td>
		                        		<input id="totalVat" name="totalVat" value="<?php echo number_format($vat); ?>" readonly> 
		                        		<label>บาท</label>
		                        	</td>
		                        </tr>		                      

		                        <tr>
		                        	<td>
	                    				<label>ค่าขนส่ง :</label>
	                    			</td>
	                    			<td>
	                    				<input type="hidden" id="rate" name="rate" value="<?php echo $RatePerKm[$x];?>">
		                        		<input id="totalTransaction" name="totalTransaction" value="0" readonly> 
		                        		<label>บาท</label>
		                        	</td>
		                        </tr>

		                        <tr>
		                        	<td>
	                    				<label>รวมทั้งหมด :</label>
	                    			</td>
	                    			<td>
	                    				<input type="hidden" id="extended" name="extended" value="<?php echo $ExtendedPrice ?>">
		                        		<input id="totalExtendPrice" name="totalExtendPrice" value="0" readonly> 
		                        		<label>บาท</label>
		                        	</td>
		                        </tr>
                    		</table>
                    	</div>
                    	<br>
                    	<tr>
                            	<td><button type="button" id="btnBack" style="margin-left: 300px;"><a href="indexCustomer.php?">ยกเลิก</a></button></td>
                                <td><button type="submit" id="btnOK">ตกลง</button></td>     
                            </tr>
                    </div>
				</div>   
			</div>
		</div><!--end of tooplate_main-->
	</form>


		<div id="tooplate_footer_wrapper">
			<div id="tooplate_footer">
	        
				<div class="col_w240">
						<h4>ติดต่อสอบถามรายละเอียดเพิ่มเติม</h4>
					<ul class="footer_link">
						<div class="cleaner"></div>
						<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สถานที่ติดต่อ :&nbsp; 87/84&nbsp; หมู่ 2&nbsp; ตำบลบางพลับ&nbsp; อำเภอปากเกร็ด&nbsp; จังหวัดนนทบุรี&nbsp; 11120</li>
						<li>โทรศัพท์ : (668) 188-9525-0&nbsp;&nbsp; Fax : (662) 554-300</li>
						<li>Email : nantiyathongpriwan@gmail.com</li>
					</ul>
				</div>			

					Copyright © 2016 <a href="#">The GobalChemicals CO.,LTD.</a>
				<div class="cleaner"></div><!--end of tooplate_footer-->
			</div><!--end of tooplate_footer-->
		</div> <!--end of tooplate_footer_wrapper-->

	
	</body>
</html>