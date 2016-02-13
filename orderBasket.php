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
		

	</head>
	<body>
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
									
									<li><a href="claim.php" >แจ้งเคลมสินค้า</a></li>
								</ul>
							</div> <!-- end of tooplate_menu -->
					</div> <!-- end of tooplate_header -->
				</div><!--end of tooplate_wrapper-->
		</div><!--end of tooplate_body_wrapper-->

		<?php
			require 'dbManagement.php';
			$dbManagement = new dbManagement();
			$result=$dbManagement->select("SELECT * FROM customer
											JOIN province ON customer.ProvinceID=province.ProvinceID
											JOIN aumphur ON customer.AumphurID=aumphur.AumphurID
											JOIN district ON customer.DistrictID=district.DistrictID
											JOIN zipcode ON customer.ZipcodeID=zipcode.ZipcodeID
											WHERE CustomerID='".$_SESSION['CustomerID']."'");

			$order=$dbManagement->select("SELECT * FROM orderdetail
											JOIN product ON orderdetail.ProductID=product.ProductID");


			$i = 0;
			if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
			    	$CustomerID[$i] = $row["CustomerID"];
			    	$CustomerName[$i] = $row["CustomerName"];
			    	$CustomerTel[$i] = $row["CustomerTel"];
			    	$CustomerAddress[$i] = $row["CustomerAddress"];
			        $DistrictID[$i] = $row["DistrictID"];
			        $DistrictName[$i] = $row["DistrictName"];
			        $AumphurID[$i] = $row["AumphurID"];
			        $AumphurName[$i] = $row["AumphurName"];
			        $ProvinceID[$i] = $row["ProvinceID"];
			        $ProvinceName[$i] = $row["ProvinceName"];
			        $ZipcodeID[$i] = $row["ZipcodeID"];
			        $Zipcode[$i] = $row["Zipcode"];	

			        $i++;
			    }
			}

			$i = 0;
			if (mysqli_num_rows($order) > 0) {
			    while($row = mysqli_fetch_assoc($order)) {
			    	$ProductID[$i] = $row["ProductID"];
			    	$ProductName[$i] = $row["ProductName"];
			    	$Cost[$i] = $row["Cost"];
			    	$OrderAmount[$i] = $row["OrderAmount"];
			    	$TotalVolumn[$i] = $row["TotalVolumn"];
			    	$TotalCost[$i] = $row["TotalCost"];

			        $i++;
			    }
			}			

		?>
	<!-- <form action="orderAddSQL.php"> -->
		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l"><br>

						<label id="label1">รายการสั่งซื้อ</label>
						<br>

						<tr>
	                        <td><label id="OrderDate">วันที่สั่งซื้อ:</label></td>
	                        <td><input type="date" id="txtDateOrder" name="txtDateOrder"></td>


	                        <td><label id="OrderID">รหัสการสั่งซื้อ:</label></td>
	                        <td><input type="text" id="txtOrderID" name="txtOrderID"></td>

	                    </tr>
						<div class="button-menu">
							<input type="image" src="images/buttonBasket1.png" alt="Submit" id="menu0rder">
							<!-- <input type="image" src="images/buttonBasketOrder1.png" alt="Submit" id="menu0rder"> -->
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
                        	for($j=0;$j<$i;$j++){ 
                        	?>  

                        	<tr>
                        		<!-- <td id="orderid"><?php echo ($CustomerTel[0]); ?></td> -->
                        		<td id="productid"><?php echo ($ProductID[$j]); ?></td>
                        		<td id="productname"><?php echo ($ProductName[$j]); ?></td>
                        		<td id="orderamount"><?php echo ($OrderAmount[$j]); ?></td>
                        		<td id="totalUnit"><?php echo ($TotalVolumn[$j]); ?></td>
                        		<td id="productcost"><?php echo ($Cost[$j]); ?></td>
                        		<td id="totalcost"><?php echo ($TotalCost[$j]); ?></td>

                        	</tr>
                        	<?php
                        		}
                        	?>                           
                        </table> 
 

                    <br>
                    <div class="col_w540"><br> 
                    	<div class="boxPayment">
                    		<label>รูปแบบการชำระเงิน :</label>
                    		
                    		<form action="">
							  <input type="radio" name="gender" value="credit">เครดิต30วัน<br>
							  <input type="radio" name="gender" value="money"> ชำระเงินสด<br>
							</form>        		
                    	</div>

                    	<div class="boxSummaryPrice">
                    		<table id="table3">
                    			<tr>
	                    			<td>
	                    				<label>ราคาสินค้า :</label>
	                    			</td>
	                    			<td>
		                        		<input id="totalPrice" name="totalPrice"> 
		                        		<label>บาท</label>
		                        	</td>
		                        </tr>

                    			<tr>
	                    			<td>
	                    				<label>ภาษีมูลค่าเพิ่ม 7% :</label>
	                    			</td>
	                    			<td>
		                        		<input id="totalPrice" name="totalPrice"> 
		                        		<label>บาท</label>
		                        	</td>
		                        </tr>		                      

		                        <tr>
		                        	<td>
	                    				<label>ค่าขนส่ง :</label>
	                    			</td>
	                    			<td>
		                        		<input id="totalTransaction" name="totalTransaction"> 
		                        		<label>บาท</label>
		                        	</td>
		                        </tr>

		                        <tr>
		                        	<td>
	                    				<label>รวมทั้งหมด :</label>
	                    			</td>
	                    			<td>
		                        		<input id="totalOther" name="totalOther"> 
		                        		<label>บาท</label>
		                        	</td>
		                        </tr>

                    		</table>
                    	</div>
                    	<br>
                    	<div id="informationCustomer">
							<input type="image" src="images/tabCustomer.png" id="informationCustomer">

						<div id="billing">	
							<input type="image" src="images/PO.png" id="informationCustomer">
								<table id="table4">

									<tr>
										<td>ชื่อบริษัท :</td>
										<td><label><?php echo $_SESSION['CustomerName']?></label></td>
									</tr>

									<tr>
										<td>โทรศัพท์ :</td>
										<td><label><?php echo ($CustomerTel[0]); ?></label></td>
									</tr>

									<tr>
										<td>ที่อยู่ เลขที่:</td>
										<td><label><?php echo ($CustomerAddress[0]); ?></label></td>
									</tr>

									<tr>
										<td>ตำบล :</td>
										<td><label><?php echo ($DistrictName[0]); ?></label></td>
									</tr>

									<tr>
										<td>อำเภอ:</td>
										<td><label><?php echo ($AumphurName[0]); ?></label></td>
									</tr>

									<tr>
										<td>จังหวัด :</td>
										<td><label><?php echo ($ProvinceName[0]); ?></label></td>
									</tr>

									<tr>
										<td>รหัสไปรษณีย์ :</td>
										<td><label><?php echo ($Zipcode[0]); ?></label></td>
									</tr>

								</table>
							</div>

							<div id="shipping">
								<input type="image" src="images/address.png" id="informationCustomer">
								<table id="table5">

									<tr>
										<td>ชื่อบริษัท :</td>
										<td><label><?php echo $_SESSION['CustomerName']?></label></td>
									</tr>

									<tr>
										<td>โทรศัพท์ :</td>
										<td><label><?php echo ($CustomerTel[0]); ?></label></td>
									</tr>

									<tr>
										<td>ที่อยู่ เลขที่:</td>
										<td><label><?php echo ($CustomerAddress[0]); ?></label></td>
									</tr>

									<tr>
										<td>ตำบล :</td>
										<td><label><?php echo ($DistrictName[0]); ?></label></td>
									</tr>

									<tr>
										<td>อำเภอ:</td>
										<td><label><?php echo ($AumphurName[0]); ?></label></td>
									</tr>

									<tr>
										<td>จังหวัด :</td>
										<td><label><?php echo ($ProvinceName[0]); ?></label></td>
									</tr>

									<tr>
										<td>รหัสไปรษณีย์ :</td>
										<td><label><?php echo ($Zipcode[0]); ?></label></td>
									</tr>

								</table>
							</div>
							<br>
							 <tr>
                            	<td><a href="indexCustomer.php"><button type="button" id="btnBack">กลับไปหน้าหลัก</button></a></td>
                            	<td><a href="#"><button type="button" id="btnPrint">สั่งพิมพ์</button></a></td>
                                 <td><button type="submit" id="btnOK">บันทึก</button></td>     
                            </tr>
                    	</div>
                    </div>
				</div>   
			</div>
		</div><!--end of tooplate_main-->
	<!-- </form> -->

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
