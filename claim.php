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

		<link href="css/claim.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
		<link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
		<script type="text/javascript" src="js/claim.js"></script>

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
						
									<li><a href="order.php">สั่งซื้อสินค้า</a></li>

									<li><a href="orderList.php" >รายการสั่งซื้อ</a></li>
									
									<li><a href="claim.php" class="selected">แจ้งเคลมสินค้า</a></li>
								</ul>
							</div> <!-- end of tooplate_menu -->
					</div> <!-- end of tooplate_header -->
				</div><!--end of tooplate_wrapper-->
		</div><!--end of tooplate_body_wrapper-->

		<?php
					require 'dbManagement.php';
					$dbManagement = new dbManagement();
					$product = $dbManagement->select("SELECT *FROM product");
					$Orders = $dbManagement->select("SELECT *FROM orders");

					$ddProduct = 0;
					if (mysqli_num_rows($product) > 0) {
					    while($row = mysqli_fetch_assoc($product)) {
					        $ProductID[$ddProduct] = $row["ProductID"];
					        $ProductName[$ddProduct] = $row["ProductName"];
					        $ddProduct++;
					    }
					   
					}	


					$ddOrders = 0;
					if (mysqli_num_rows($Orders) > 0) {
					    while($row = mysqli_fetch_assoc($Orders)) {
					        $OrderID[$ddOrders] = $row["OrderID"];
					        $ddOrders++;
					    }
					   
					}		
	

				?>
	<form action="claimAddSQL.php">
		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l">
					<div class="col_w630 float_l">

					<h2>เคลมสินค้า</h2>
                    <table id="table" style="width: 100%">
                            <tr>
                                <td><input type="hidden" id="txtClaimID" name="txtClaimID"></td>
                            </tr>
                            <tr>
                                <td><input type="hidden" id="txtCustomerID" name="txtCustomerID" value="<?php echo $_SESSION['CustomerID']?>"></td>
                            </tr>
                            <br>
 <!--                        	<tr>
                                <td><label><span class="red-star">* </span>วันที่เคลมสินค้า:</label></td>
                                <td><input type="date" id="txtDateClaim" name="txtDateClaim" required></td>
                            </tr> -->

                            <tr>
                                <td><label><span class="red-star">* </span>เลขที่ใบสั่งซื้อ:</label></td>
                                <td><select id="txtOrderID" name="txtOrderID" >
                                	 	<option value="" selected>-------- กรุณาเลือก --------</option>
                                	 	<?php
                        					for($j=0;$j<$ddOrders;$j++){ 
                        				?>	
                                		<option value="<?php echo $OrderID[$j]; ?>"><?php echo $OrderID[$j]; ?></option>
                                		<?php
                        					}
                        				?>
                                	</select>
                                </td>	
                                
                            </tr>

                            <tr>
                                <td><label><span class="red-star">* </span>ชื่อสินค้า :</label></td>                       
                                <td><select id="ddProduct" name="ddProduct" >
                                	 	<option value="" selected>-------- กรุณาเลือก --------</option>
                                	 	<?php
                        					for($p=0;$p<$ddProduct;$p++){ 
                        				?>	
                                		<option value="<?php echo $ProductID[$p]; ?>"><?php echo $ProductName[$p]; ?></option>
                                		<?php
                        					}
                        				?>
                                	</select>
                                </td>
                            </tr>

                            <tr id="row_productType">
                                <td><label>ประเภทสินค้า:</label></td>
                                <td><label id="ddProductType" name="ddProductType"></label></td>
                            </tr>

                            <tr id="row-brandName">
                                <td><label>ยี่ห้อ:</label></td>
                                <td><label id="ddBrandName" name="ddBrandName"></label></td>
                            </tr>


                            <tr>
                                <td><label><span class="red-star">* </span>จำนวน :</label></td>
                                <td><input type="text" id="txtClaimAmount" name="txtClaimAmount" required>
                                <label>ถุง</label></td>
                            </tr>

                            <tr>
                                <td><label>รายละเอียดเพิ่มเติม :</label></td>
                                <td><textarea id="txtClaimDetail" name="txtClaimDetail"></textarea>
                               
                            </tr>

                            <tr> <td>&nbsp;</td></tr>
                            <tr>
                                <td><input type="hidden" id="txtClaimState" name="txtClaimState"></td>
                            </tr>

                            <tr>
                            		<td><a href="indexCustomer.php"><button type="button" id="btnBack">กลับไปหน้าหลัก</button></a></td>
                                    <td><button type="submit" id="btnCF">บันทึก</button></td>
                                    
                            </tr>

                        </table>

					</div>
				</div>
			</div>
		</div><!--end of tooplate_main-->
	</form>

		<div id="tooplate_footer_wrapper">
			<div id="tooplate_footer">
	        
				<div class="col_w240">
						<h4>ติดต่อสอบถามรายละเอียดเพิ่มเติม</h4><br>
					<ul class="footer_link">
						<li>สถานที่ติดต่อ :&nbsp; 87/84&nbsp; หมู่ 2&nbsp; ตำบลบางพลับ&nbsp; อำเภอปากเกร็ด&nbsp; จังหวัดนนทบุรี&nbsp; 11120</li>
						<li>โทรศัพท์ : (668) 188-9525-0&nbsp;&nbsp; Fax : (662) 554-300</li>
						<li>Email : nantiyathongpriwan@gmail.com</li>
					</ul>
				</div>
			
				
				<div class="cleaner h40"></div>
					Copyright © 2016 <a href="#">The GobalChemicals CO.,LTD.</a>
				<div class="cleaner"></div><!--end of tooplate_footer-->
			</div><!--end of tooplate_footer-->
		</div> <!--end of tooplate_footer_wrapper-->

	
	</body>
</html>
