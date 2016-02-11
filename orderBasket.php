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

		?>

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
                        		<th>ชื่อสินค้า</th>
                                <th>ชื่อสินค้า</th>
                                <th>จำนวน</th>
                                <th>ราคา</th>
                                <th>รวม</th>
                                <th>แก้ไข</th>
                                
                        	</tr>
  
                        	<tr>
                        		<td id="orderid"></td>
                        		<td id="productid"></td>
                        		<td id="orderamount">
									<input type="text" id="ddOrderAmout" name="ddOrderAmout"></input>
                        			<label>ตัน</label>
                        		</td>
                        		<td id="productcost"></td>
                        		<td id="totalprice"></td>
                        		<td>
                        			<button id="btnCF">บันทึก</button>
                        			<button id="btnDelete">ลบ</button>
                        		</td>
                        	</tr>
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
	                    				<label>ภาษีมูลค่าเพิ่ม :</label>
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
										<td><label></label></td>
									</tr>

									<tr>
										<td>โทรศัพท์ :</td>
										<td><label></label></td>
									</tr>

									<tr>
										<td>ที่อยู่ เลขที่:</td>
										<td><label></label></td>
									</tr>

									<tr>
										<td>ตำบล :</td>
										<td><label></label></td>
									</tr>

									<tr>
										<td>อำเภอ:</td>
										<td><label></label></td>
									</tr>

									<tr>
										<td>จังหวัด :</td>
										<td><label></label></td>
									</tr>

									<tr>
										<td>รหัสไปรษณีย์ :</td>
										<td><label></label></td>
									</tr>

								</table>
							</div>

							<div id="shipping">
								<input type="image" src="images/address.png" id="informationCustomer">
								<table id="table5">

									<tr>
										<td>ชื่อบริษัท :</td>
										<td><label></label></td>
									</tr>

									<tr>
										<td>โทรศัพท์ :</td>
										<td><label></label></td>
									</tr>

									<tr>
										<td>ที่อยู่ เลขที่:</td>
										<td><label></label></td>
									</tr>

									<tr>
										<td>ตำบล :</td>
										<td><label></label></td>
									</tr>

									<tr>
										<td>อำเภอ:</td>
										<td><label></label></td>
									</tr>

									<tr>
										<td>จังหวัด :</td>
										<td><label></label></td>
									</tr>

									<tr>
										<td>รหัสไปรษณีย์ :</td>
										<td><label></label></td>
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
