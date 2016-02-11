<?php
	session_start();
	if(!isset($_SESSION['EmployeeName'])){
		header( "location: /gobalchemicals/indexLogin.html" );
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

		<link href="css/transport.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
		<script type="text/javascript" src="js/approveOrder.js"></script>
		
		

		<script language="javascript" type="text/javascript">
		function clearText(field)
		{
			if (field.defaultValue == field.value) field.value = '';
			else if (field.value == '') field.value = field.defaultValue;
		}
	</script>

	<script type="text/javascript">

		ddsmoothmenu.init({
			mainmenuid: "tooplate_menu", //menu DIV id
			orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
			classname: 'ddsmoothmenu', //class added to menu's outer DIV
			//customtheme: ["#1c5a80", "#18374a"],
			contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
		})

	</script>


	</head>
	<body>

			<div id="tooplate_body_wrapper">
				<div id="tooplate_wrapper">
					<div id="tooplate_header">	
                    	<div id="tooplate_user">
							<label id="label1"><?php echo $_SESSION['EmployeeName']?> |&nbsp;</label>
                        </div>
                        <div id="imageMenuOrder">
                        	<input type="image" src="images/order.png" alt="Submit" id="menu0rder">
                            <input type="image" src="images/claim.png" alt="Submit" id="menu0rder">
                        </div>

					  <div id="tooplate_top">
							<div id="tooplate_login">
						  		<a href="logOutBack.php"><input type="button" name="Search" value="" alt="Search" id="searchbutton" class="sub_btn"  /></a>
							</div>
					  </div>						
						<div id="site_title"><h1><a href="indexEmployee.php">Gray Box</a></h1>
							<div id="tooplate_menu" class="ddsmoothmenu">
								<ul >
									<li><a href="#" class="selected">จัดการข้อมูล</a>
				                        <ul>
												<li><a href="product.php" >ข้อมูลสินค้า</a></li>
												<li><a href="supplier.php">ข้อมูลผู้จัดจำหน่าย</a></li>
												<li><a href="employee.php">ข้อมูลพนักงาน</a></li>
				                                <li><a href="truck.php">ข้อมูลรถ</a></li>
										</ul>
			                        </li>
									
									<li><a href="#">ตรวจสอบข้อมูล</a>
				                        <ul>
												<li><a href="#">การสั่งซื้อสินค้า</a></li>
												<li><a href="#">การเคลมสินค้า</a></li>
												
										</ul>
			                        </li>
									
									<li><a href="#">คลังสินค้า</a>
										<ul>
											<li><a href="productReceive.php">รับสินค้า</a></li>
											<li><a href="productPurchase.php">สั่งสินค้า</a></li>
											<li><a href="productStock.php">เช็คสินค้า</a></li>
									  	</ul>
									</li>
									
									<li ><a href="#">ส่งสินค้า</a>
				                        <ul>
												<li ><a href="#">จัดเส้นทาง</a></li>
												<li ><a href="#">ใบส่งสินค้า</a></li>
												<li ><a href="#">ค่าใช้จ่าย</a></li>
										</ul>
			                        </li>
			                        
									<li ><a href="#">สรุปรายงาน</a>
			                            <ul>
											<li><a href="#">รายงานรายได้</a></li>
											<li><a href="#">รายงานค่าใช้จ่าย</a></li>
											
									  </ul>
									</li>
								</ul>
							</div> <!-- end of tooplate_menu -->
						</div>
					</div> <!-- end of tooplate_header -->
				</div><!--end of tooplate_wrapper-->
		</div><!--end of tooplate_body_wrapper-->

		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l">
					<p>จัดเส้นทาง</p>
	           
	                    <input type="hidden" id="txtTransportID" name="txtTransportID">
	                    
	                    <label id="labelDate">วันที่จัดเส้นทาง:</label>
	                    <input type="date" id="txtDateTransport" name="txtDateTransport">
	                    

	                                <!-- Button trigger modal -->
										<button type="button" class="btn btn-primary btn-lg" id="addPr" data-toggle="modal" data-target="#myModal">เพิ่มใบสั่งซื้อ</button>
									<!-- Button trigger modal -->

									<!-- Modal -->
										<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
										  <div class="modal-dialog" role="document">
										    <div class="modal-content">
										      <div class="modal-header">
										        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										        <h4 class="modal-title" id="myModalLabel">ใบสั่งซื้อ</h4>
										      </div>
										      <div class="modal-body">

			             						 <table  class="table table-bordred table-striped">
							                        	<tr>
							                        		<th>รหัสสินค้า</th>
							                                <th>ชื่อสินค้า</th>
							                                <th>ชื่อลูกค้า</th>
							                                <th>จำนวน</th>
							                                <th>เลือก</th>
							                                
							                        	</tr>

							                        	<tbody id="showOrder">
										                    <tr>    	
															    <td><label></label></td>
															    <td><label></label></td>
															    <td><label></label></td>
															    <td><label></label></td>
															    <td>
															    		<button class="btnAlert" data-title="delete" data-toggle="modal" type="submit" >เลือก</button>
															    	
															    </td>
															</tr>
														</tbody>
			        							</table>

										      </div>
										      <div class="modal-footer">
										        <button type="button" class="btn btn-default" data-dismiss="modal">กลับไปหน้าแรก</button>
										        
										      </div>
										    </div>
										  </div>
										</div>
									<!-- Modal -->
							<br>
							<br>

							<table id="table2" width="100%">
	                        	<tr>
	                        		<th>รหัสสั่งซื้อ</th>
	                                <th>ชื่อลูกค้า</th>
	                                <th>ลบ</th>
	                                
	                        	</tr>
	                        	<tr>
	                        		<td id="orderId"></td>
	                        		<td id="customerName"></td>
	                        		<td>
	                        		
	                        			<button id="btnDelete"><a href="deleteProductSQL.php?ProductID=<?php echo $ProductID[$j]; ?>">ลบ</a></button>
	                        		</td>
	                        	</tr>
                        	</table>     	

	                            <tr> <td>&nbsp;</td></tr>
	                            <tr> <td>&nbsp;</td></tr>
	                            <br>
	                            <tr id="button-command">
	                            		<td><button type="button" id="btnBack">กลับไปหน้าหลัก</button></td>
	                                    <td><button type="submit" id="btnCF">สร้างเส้นทาง</button></td>
	                                    
	                            </tr>

	                        
				</div>
			</div>	
		</div><!--end of tooplate_main-->


		<div id="tooplate_footer_wrapper">
			<div id="tooplate_footer">
					Copyright © 2016 &nbsp;&nbsp;The GobalChemicals CO.,LTD.
				<div class="cleaner"></div><!--end of tooplate_footer-->
			</div><!--end of tooplate_footer-->
		</div> <!--end of tooplate_footer_wrapper-->

	
	</body>
</html>
