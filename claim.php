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
									
									<li><a href="claim.php" class="selected">แจ้งเคลมสินค้า</a></li>
								</ul>
							</div> <!-- end of tooplate_menu -->
					</div> <!-- end of tooplate_header -->
				</div><!--end of tooplate_wrapper-->
		</div><!--end of tooplate_body_wrapper-->

		<?php
					require 'dbManagement.php';
					$dbManagement = new dbManagement();
					$productType = $dbManagement->select("SELECT * FROM producttype");
					$product = $dbManagement->select("SELECT *FROM product");

					$ddProductType = 0;
					if (mysqli_num_rows($productType) > 0) {
					    while($row = mysqli_fetch_assoc($productType)) {
					        $ProductTypeID[$ddProductType] = $row["ProductTypeID"];
					        $ProductTypeName[$ddProductType] = $row["ProductTypeName"];
					        $ddProductType++;
					    }
					   
					}

					$ddProduct = 0;
					if (mysqli_num_rows($product) > 0) {
					    while($row = mysqli_fetch_assoc($product)) {
					        $ProductID[$ddProduct] = $row["ProductID"];
					        $ProductName[$ddProduct] = $row["ProductName"];
					        $ddProduct++;
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

                        	<tr>
                                <td><label><span class="red-star">* </span>วันที่เคลมสินค้า:</label></td>
                                <td><input type="date" id="txtDateClaim" name="txtDateClaim" required > </td>
                            </tr>

                            <tr>
                                <td><label><span class="red-star">* </span>เลขที่ใบสั่งซื้อ:</label></td>
                                <td><input type="text" id="txtOrderID" name="txtOrderID" required ></td>
                            </tr>

                             <tr>
                                <td><label>ประเภทสินค้า:</label></td>
                                <td>
                                	<select id="type" name="ddTypeProduct">
	                                	<option value="" selected>------ กรุณาเลือก ------</option>
		                               	 	<?php
		                        					for($j=0;$j<$ddProductType;$j++){ 
		                        			?>	
		                                		<option value="<?php echo $ProductTypeID[$j]; ?>"><?php echo $ProductTypeName[$j]; ?></option>
		                                	<?php
		                        					}
		                        			?>
									</select> 
                                </td>
                            </tr>

                             <tr>
                                <td><label>ชื่อสินค้า:</label></td>
                                <td>
                                	<select id="type" name="ddProductName">
	                                	<option value="" selected>------ กรุณาเลือก ------</option>
		                               	 	<?php
		                        					for($j=0;$j<$ddProduct;$j++){ 
		                        			?>	
		                                		<option value="<?php echo $ProductID[$j]; ?>"><?php echo $ProductName[$j]; ?></option>
		                                	<?php
		                        					}
		                        			?>
									</select> 
                                </td>
                            </tr>

                            <tr>
                                <td><label><span class="red-star">* </span>จำนวน :</label></td>
                                <td><input type="text" id="txtClaimAmount" name="txtClaimAmount">
                                <label>ถุง</label></td>
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
