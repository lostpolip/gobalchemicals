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

		<link href="css/order.css" rel="stylesheet" type="text/css" />
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
			$result = $dbManagement->select("SELECT * FROM product");

			$i = 0;
			if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
			        $ProductID[$i] = $row["ProductID"];
			        $ProductName[$i] = $row["ProductName"];
			        $Cost[$i] = $row["Cost"];
			        $ImageProduct[$i] = $row["ImageProduct"];
			        $ProductAmount[$i] = $row["ProductAmount"];
			        $ProductWeight[$i] = $row["ProductWeight"];
			        $i++;
			    }
			}
		?>
	
		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l"><br>
						<label id="label1">สินค้าทั้งหมด&nbsp;</label>
						<tr>
							<td>
							
					<form action="orderAddSQL.php" method="POST">		
						<!-- Button trigger modal -->
							<button type="button" class="btn btn-primary btn-lg" id="button-basket" data-toggle="modal" data-target="#myModal">
							</button>
						<!-- Button trigger modal -->

						<!-- Modal -->
							<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel">รายการสั่งซื้อ</h4>
							      </div>
							      <div class="modal-body">

             						 <table  class="table table-bordred table-striped">
             						 	<thead>
				                        		<th>ชื่อสินค้า</th>
				                                <th>จำนวน (ตัน)</th>
				                                <th>ปริมาณ (หน่วย)</th>
				                                <th>ราคา/หน่วย (บาท)</th>
				                                <th>รวมทั้งสิ้น (บาท)</th>
							                    <th>ลบ</th>
										</thead>
	   									<tbody id="showOrder">
	   										<?php 
	   											for($j=0; $j<$i; $j++){
	   										?>
	   										<tr id="<?php echo 'row' . $ProductID[$j];?>" class="hide">
											    <td><label id="productName"><?php echo $ProductName[$j];?></label></td>
											    <td><label id="<?php echo 'totalProductOrder' . $ProductID[$j];?>"></label></td>											   
											    <td><label id="<?php echo 'totalUnitOrder'. $ProductID[$j]; ?>"></label></td>
											    <td><label><?php echo $Cost[$j];?></label></td>
											    <td><label id="<?php echo 'totalPriceOrder'. $ProductID[$j]; ?>"></label></td>
											    
											     <td><a href="#" class="confirm-delete btn mini red-stripe" role="button" data-title="<?php echo $ProductName[$j];?>" data-id="<?php echo 'row' . $ProductID[$j];?>" data-dismiss="modal"><span class="glyphicon glyphicon-trash"></span></a></td>
<!-- 											    <td>
											    	<p data-placement="top" data-toggle="tooltip" title="Delete">
											    		<button class="btn btn-danger btn-xs" data-title="<?php echo $ProductName[$j];?>" data-toggle="modal" data-target="#delete" >
											    			<span class="glyphicon glyphicon-trash"></span>
											    		</button>
											    	</p>
											    </td> -->
											</tr>
											
											<input type="hidden" id="<?php echo 'hiddenproductID' . $ProductID[$j]; ?>" name="<?php echo 'hiddenproductID' . $ProductID[$j]; ?>" value="<?php echo $ProductID[$j];?>" disabled>
											
<!-- 											
											<input type="hidden" id="<?php echo 'hiddenproductName' . $ProductID[$j]; ?>" name="<?php echo 'hiddenproductName' . $ProductID[$j]; ?>" value="<?php echo $ProductName[$j];?>" disabled> -->

											<input type="hidden" id="<?php echo 'hiddenProductOrder' . $ProductID[$j];?>" name="<?php echo 'hiddenProductOrder' . $ProductID[$j];?>" disabled>

											<input type="hidden" id="<?php echo 'hiddentotalUnitOrder'. $ProductID[$j]; ?>" name="<?php echo 'hiddentotalUnitOrder'. $ProductID[$j]; ?>" disabled>

											<input type="hidden" id="hiddenproductCost" value="<?php echo $Cost[$j];?>" name="hiddenproductCost" value="<?php echo $Cost[$j];?>" disabled>

											<input type="hidden" id="<?php echo 'hiddentotalPriceOrder'. $ProductID[$j]; ?>" name="<?php echo 'hiddentotalPriceOrder'. $ProductID[$j]; ?>" disabled>

											<?php
												}
											?>
											<input type="hidden" id="order-id" name="order-id">

										</tbody>
        							</table>						
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">กลับไปหน้าสินค้า</button>
							        <button type="submit" id="btnCF" class="btn btn-primary">สั่งซื้อสินค้า</button>
							      </div>
							    </div>
							  </div>
							</div>
						<!-- Modal -->
	</form>
	
							</td>
						</tr>
						
					<?php
                        for($j=0;$j<$i;$j++){ 
                    ?>
						<div class="fp_service">	
							<div class="fp_service_box fp_c1">
								<img class="imageProduct" src="<?php echo '../gobalchemicals/images/'. $ImageProduct[$j]; ?>" alt="Image" />
									<p>
										<label><?php echo $ProductName[$j]; ?></label>
									<br>
										<span>รหัสสินค้า :</span>
										<label><?php echo $ProductID[$j]; ?></label>	
									<br>
										<span>ราคาสินค้า :</span>
										<label id="<?php echo 'productPrice' . $ProductID[$j]; ?>"><?php echo $Cost[$j]; ?></label>
										<span>บาท</span>	
									<br>
										<span>จำนวน :</span>	
										<input type="text" id="<?php echo 'totalProduct' . $ProductID[$j]; ?>" name="numberLevel" value="0"  placeholder="0" requried>	
										<span>ตัน</span>	

										&nbsp; &nbsp;<button name="order" data-productname="<?php echo $ProductName[$j]; ?>" data-productid="<?php echo $ProductID[$j]; ?>" data-productprice="<?php echo $Cost[$j]; ?>" data-productweight="<?php echo $ProductWeight[$j]; ?>" class="btn btn-success">หยิบใส่ตะกร้า</button>	

									</p>
								<div class="cleaner"></div>
							</div>
						</div>
						<br>
                        <?php
                        	}
                       	?>
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
