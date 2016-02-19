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

		<link href="css/orderListDetail.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
		<link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>

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

			$orderdetail=$dbManagement->select("SELECT * FROM `orders` 
												WHERE OrderID='".$_REQUEST['OrderID']."'
												AND CustomerID = '".$_SESSION['CustomerID']."' ");

			$i = 0;
			if (mysqli_num_rows($orderdetail) > 0) {
			    while($row = mysqli_fetch_assoc($orderdetail)) {
			    	// $ProductID[$i] = $row["ProductID"];
			    	// $ProductName[$i] = $row["ProductName"];
			    	// $Cost[$i] = $row["Cost"];
			    	// $OrderAmount[$i] = $row["OrderAmount"];
			    	// $TotalVolumn[$i] = $row["TotalVolumn"];
			    	// $TotalCost[$i] = $row["TotalCost"];
			    	$OrderID[$i] = $row["OrderID"];
			    	$OrderDate[$i] = $row["OrderDate"];
			    	$TotalPrice[$i] = $row["TotalPrice"];
			    	$TotalPriceOrder[$i] = $row["TotalPriceOrder"];
			    	$TotalTransport[$i] = $row["TotalTransport"];
			    	$ExtendedPrice[$i] = $row["ExtendedPrice"];
			        $i++;
			    } 
			} 	

		?>

		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l"><br>

					 <!-- Nav tabs -->
					  <ul class="nav nav-tabs" role="tablist">
					    <li role="presentation" class="active"><a href="#approveOrder" aria-controls="home" role="tab" data-toggle="tab">รายการการสั่งซื้อ</a></li>
					  </ul>

					  <!-- Tab panes -->
					  <div class="tab-content">
					    <div role="tabpanel" class="tab-pane active">
					    	<br>

					    	<table id="table2" width="100%">


		                        	<tr>
		                        		<th>วันที่</th>
		                        		<th>เลขที่ใบสั่งซื้อ</th>
		                        		<th>รหัสสินค้า</th>
		                                <th>ชื่อสินค้า</th>
		                                <th>จำนวน</th>
		                                <th>ราคาสินค้า</th>
		                        	</tr>

					    			<?php
		                        		for($j=0;$j<$i;$j++){ 
		                   			 ?>	

		                        	<tr>
		                        		<td id="date"><?php echo $OrderDate[$j]; ?></td>
		                        		<td id="orderid"><?php echo $OrderID[$j]; ?></td>
		                        		<td id="productid"><?php echo $ProductID[$j]; ?></td>
		                        		<td id="productname"><?php echo $ProductName[$j]; ?></td>
		                        		<td id="productamount"><?php echo $OrderAmount[$j]; ?></td>
		                        		<td id="productprice"><?php echo number_format($TotalPrice[$j]); ?></td>
		                        	</tr>
		                        	<?php
		                        		}
		                    		?>        
							</table> 
					    </div><!--- แจ้งซื้อสินค้า -->

                    	<div class="boxPayment">
                    		<label><span id="star">*</span>เงื่อนไขในการชำระเงิน : เครดิต 30 วัน</label>   		
                    	</div>

                    	<div class="boxSummaryPrice">
                    		<table id="table3">
                    			<tr>
	                    			<td>
	                    				<label>ราคาสินค้าทั้งหมด :</label>
	                    			</td>
	                    			<td>
		                        		<input id="totalPrice" name="totalPrice" value="<?php echo number_format($TotalPriceOrder[0]); ?>" disabled> 
		                        		<label>บาท</label>
		                        	</td>
		                        </tr>

		                        <tr>
		                        	<td>
	                    				<label>รวมยอดสุทธิ :</label>
	                    			</td>
	                    			<td>
		                        		<input id="totalOther" name="totalOther" value="<?php echo number_format($ExtendedPrice[0]); ?>" disabled> 
		                        		<label>บาท</label>
		                        	</td>
		                        </tr>

                    		</table>
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
