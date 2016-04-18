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

		<link href="css/orderList.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
		<link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
		<script type="text/javascript" src="js/order.js"></script>
		<script type="text/javascript" src="js/deleteOrder.js"></script>
		

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

									<li><a href="order.php" >สั่งซื้อสินค้า</a></li>

									<li><a href="orderList.php" class="selected">รายการสั่งซื้อ</a></li>
													
									<li><a href="claim.php" >แจ้งเคลมสินค้า</a></li>
								</ul>
							</div> <!-- end of tooplate_menu -->
					</div> <!-- end of tooplate_header -->
				</div><!--end of tooplate_wrapper-->
		</div><!--end of tooplate_body_wrapper-->

		<?php
			require 'dbManagement.php';
			$dbManagement = new dbManagement();
			$result = $dbManagement->select("SELECT * FROM orders
											 WHERE CustomerID='".$_SESSION['CustomerID']."'");

			$i = 0;
			if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
			        $OrderID[$i] = $row["OrderID"];
			        $OrderDate[$i] = $row["OrderDate"];
			        $State[$i] = $row["State"];
			        $SendOrder[$i] = $row["SendOrder"];
			        $TransportID[$i] = $row["TransportID"];
			        $ExtendedPrice[$i] = $row["ExtendedPrice"];	
			        $i++;
			    }
			}
		?>
	
		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l"><br>
						<label id="label1">รายการสั่งซื้อ&nbsp;</label>

						<table id="table2" width="100%">
                        	<tr>
                        		<th>เลขที่ใบสั่งซื้อ</th>
                                <th>วันที่สั่งซื้อ</th>
                                <th>ยอดสุทธิ</th>
                                <th>สถานะ</th>
                                <th>เลขใบส่งสินค้า</th>
                                <th>วันที่จัดส่งสินค้า</th>
                                <th>คำสั่ง</th>
                                
                        	</tr>
                        	<?php
                        	for($j=0;$j<$i;$j++){ 
                        	?>
                        	<tr>
                        		<td id="productid"><?php echo $OrderID[$j]; ?></td>
                        			<input type="hidden" id="orderID" name="orderID" value="<?php echo $OrderID[$j]; ?>">
                        		<td id="productname"><?php echo date("d-m-Y", strtotime($OrderDate[$j] )) ?></td>
                        		<td id="productprice"><?php echo number_format($ExtendedPrice[$j]); ?></td>
                        		<td id="productstate"><?php echo $State[$j]; ?></td>
                        		<td id="productstate"><?php echo $TransportID[$j]; ?></td>
                        		<td id="datesendOrder"><?php echo date("d-m-Y", strtotime($SendOrder[$j])) ?></td>
                        		<td>
                        			<button id="btnDetail"><a href="orderListDetail.php?OrderID=<?php echo $OrderID[$j]; ?>"> รายละเอียด</a></button>
 
                        		</td>

                        	</tr>
                        	<?php
                        	}
                        	?>

                        </table>     
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
