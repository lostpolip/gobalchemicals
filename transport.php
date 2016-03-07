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
		<script type="text/javascript" src="js/transport.js"></script>
		
		

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
                            <a href="approveOrder.php"><input type="image" src="images/claim.png" alt="Submit" id="menu0rder"></a>
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
												<li><a href="investigateOrder.php">การสั่งซื้อสินค้า</a></li>
												<li><a href="claimList.php">การเคลมสินค้า</a></li>
												
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
												<li ><a href="transport.php">จัดเส้นทาง</a></li>
												<li ><a href="#">ใบส่งสินค้า</a></li>
												<li ><a href="expensiveRoutting.php">ค่าใช้จ่าย</a></li>
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

		<?php
			date_default_timezone_set('Asia/Bangkok');
			require 'dbManagement.php';
			$dbManagement = new dbManagement();			
			$truck = $dbManagement->select("SELECT * FROM truck");

			$ddtruck = 0;
			if (mysqli_num_rows($truck) > 0) {
			    while($row = mysqli_fetch_assoc($truck)) {
			        $TruckID[$ddtruck] = $row["TruckID"];
			        $TruckName[$ddtruck] = $row["TruckName"];
			        $TruckTypeID[$ddtruck] = $row["TruckTypeID"];
			        $FuelID[$ddtruck] = $row["FuelID"];
			        $TruckWeight[$ddtruck] = $row["TruckWeight"];
			        $WeightQuantity[$ddtruck] = $row["WeightQuantity"];
			        $WeightCapacity[$ddtruck] = $row["WeightCapacity"];
			        $StateTruck[$ddtruck] = $row["StateTruck"];
			        $ddtruck++;
			    }
			   
			}

			$order = $dbManagement->select("SELECT * FROM orders
											JOIN customer ON orders.CustomerID=customer.CustomerID
											WHERE State='complete'
											");

			$popupOrder = 0;
			if (mysqli_num_rows($order) > 0) {
			    while($row = mysqli_fetch_assoc($order)) {
			        $OrderID[$popupOrder] = $row["OrderID"];
			        $OrderDate[$popupOrder] = $row["OrderDate"];
			        $CustomerID[$popupOrder] = $row["CustomerID"];
			        $CustomerName[$popupOrder] = $row["CustomerName"];
			        $UnitProduct[$popupOrder] = $row["UnitProduct"];
			        $popupOrder++;
			    }
			   
			}
		?>

		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l">
					<p>จัดเส้นทาง</p>
	           
	                    <input type="hidden" id="txtTransportID" name="txtTransportID">
	                    
	                    <label id="labelDate">วันที่จัดเส้นทาง:</label>
	                    <input type="date" id="txtDateTransport" name="txtDateTransport" 
	                    min="<?php echo date('Y-m-d');?>">
	                    

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
							                        		<th>เลขที่ใบสั่งซื้อ</th>
							                                <th>วันที่สั่งซื้อ</th>
							                                <th>ชื่อลูกค้า</th>
							                                <th>จำนวน</th>
							                                <th>เลือก</th>
							                                
							                        	</tr>
							                        	<?php
                        									for($j=0;$j<$popupOrder;$j++){ 
                        								?>	
							                        	<tbody id="showOrder">
										                    <tr>    	
															    <td>
															    	<label><?php echo $OrderID[$j] ?>
															    	</label>
															    </td>
															    <td>
															    	<label><?php echo $OrderDate[$j] ?>
															    	</label>
															    </td>
															    <td>
															    	<label><?php echo $CustomerName[$j] ?>
															    	</label>
															    </td>
															    <td>
															    	<label><?php echo $UnitProduct[$j] ?>
															    	</label>
															    </td>
															    <td>
															    	<button class="btnAlert" data-title="delete" data-toggle="modal" type="submit" class="btn btn-default">เลือก</button>
															    	
															    </td>
															</tr>
														</tbody>
														<?php
															}
														?>
			        							</table>

										      </div>
										      <div class="modal-footer">
										        <button type="button" class="btn btn-default" data-dismiss="modal">กลับไปหน้าแรก
										        </button>
										      </div>
										    </div>
										  </div>
										</div>
									<!-- Modal -->
							<br>
							<br>

							<table id="table2" width="100%">
	                        	<tr>	                                
	                        		<th>วันที่สั่งซื้อ</th>
	                        		<th>รหัสสั่งซื้อ</th>
	                                <th>ชื่อลูกค้า</th>
	                                <th>น้ำหนักสินค้า(ตัน)</th>

	                                <th>ลบ</th>
	                                
	                        	</tr>
	                        	<tr>
	                        		<td id="orderDate"></td>
	                        		<td id="orderId"></td>
	                        		<td id="customerName"></td>
	                        		<td id="productWeight"></td>
	                        		
	                        		<td>                     
	                        			<button id="btnDelete" class="btn btn-default">
	                        			<a href="deleteProductSQL.php?ProductID=<?php echo $ProductID[$j]; ?>">ลบ</a>
	                        			</button>
	                        		</td>
	                        	</tr>
                        	</table>     	
                        	<br>

								<tr> 
									<td><label id="labelWeight">รวมน้ำหนักสินค้าทั้งหมด :</label>
										<input type="text" id="txtWeightProduct" name="txtWeightProduct" value="0" disabled> 
										<label id="labelWeight">ตัน</label>
									</td>
								</tr>
								<br>
								<p>รถบรรทุก</p>
								<tr> 
									<td><label id="labelTruck">ความจุของรถบรรทุก :</label>
										<select id="ddTruck" name="ddTruck" >
                                	 		<option value="" selected>เลือก</option>
		                                	 	<?php
		                        					for($j=0;$j<$ddtruck;$j++){ 
		                        				?>	
                                			<option value="<?php echo $TruckID[$j]; ?>"><?php echo $WeightCapacity[$j]; ?></option>
                                				<?php
                        							}
                        						?>
                                		</select>
                                		<label id="labelWeight">ตัน</label>
									</td>
								</tr>
								<br>
								<br>
								<table id="table" width="100%">
									<tr id="row-truck">
		                                <td>
		                                	<label id="label">ประเภทรถบรรทุก:</label>	
		                                	<label id="txtTruckType" name="txtTruckType"></label>
		                                	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                                	<label id="label">หมายเลขทะเบียน :</label> 
		                                	<label id="txtTruckName" name="txtTruckName" ></label>
	                                		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                                	<label id="label">เชื้อเพลิง :</label> 
		                                	<label id="txtFuel" name="txtFuel" ></label>
											<br>
		                                	<label id="label">น้ำหนักรถ:</label>	
		                                	<label id="txtTruckWeight" name="txtTruckWeight" ></label>
		                             		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                                	<label id="label">บรรจุน้ำหนักสินค้า :</label> 
		                                	<label id="txtTruckCapacity" name="txtTruckCapacity" ></label>
		                                	<label id="labelWeight">ตัน</label>

		                                </td>
	                            	</tr>
                            	</table>
	                            <br>
	                            <br>
	                            <br>
	                            <tr id="button-command">
	                            		<td><button type="button" id="btnBack" class="btn btn-danger btn-md">กลับไปหน้าหลัก</button></td>
	                                    <td><button type="submit" id="btnCF" class="btn btn-success btn-md">สร้างเส้นทาง</button></td>
	                                    
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
