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
							<a href="approveClaim.php"><input type="image" src="images/order.png" alt="Submit" id="menu0rder"></a>
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
			        $Latitude[$popupOrder] = $row["Latitude"];
			        $Longitude[$popupOrder] = $row["Longitude"];
			        $Distance[$popupOrder] = $row["Distance"];
			        $UnitProduct[$popupOrder] = $row["UnitProduct"];
			        $popupOrder++;
			    }		   
			}

			$employee = $dbManagement->select("SELECT * FROM employee WHERE `PositionID`=2");

			$ddemployee = 0;
			if (mysqli_num_rows($employee) > 0) {
			    while($row = mysqli_fetch_assoc($employee)) {
			        $EmployeeID[$ddemployee] = $row["EmployeeID"];
			        $EmployeeName[$ddemployee] = $row["EmployeeName"];
			        $ddemployee++;

			    }		   
			}
		?>
	<form action="transportMap.php">
		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l">
					<p>จัดเส้นทาง</p>
	           
	                    <input type="hidden" id="txtTransportID" name="txtTransportID">
	                    
	                    <label id="labelDate">วันที่จัดเส้นทาง:</label>
	                    <input type="date" id="txtDateTransport" name="txtDateTransport" 
	                    min="<?php echo date('Y-m-d');?>">
	                    
							<table id="table2" width="100%">
	                        	<tr> 
	                        		<th>เลือก</th>	                                
	                        		<th>วันที่สั่งซื้อ</th>
	                        		<th>รหัสสั่งซื้อ</th>
	                                <th>ชื่อลูกค้า</th>
	                                <th>น้ำหนักสินค้า(ตัน)</th>
	                        	</tr>
	                        	<?php 
	   								for($j=0; $j<$popupOrder; $j++){
	   							?>
	                        	<tr>
	                        		<td><input type="checkbox" name="destination[]" value="<?php echo $Latitude[$j].','.$Longitude[$j] ?>" 
	                        		data-unitproduct="<?php echo $UnitProduct[$j]; ?>"
	                        		data-orderid="<?php echo $OrderID[$j]; ?>">
	                        		</td>
	                        		<td id="orderDate"><?php echo $OrderDate[$j]; ?></td>
	                        		<td id="orderId" ><?php echo $OrderID[$j]; ?></td>
	                        			<!-- <input type="checkbox" id="Order" name="Order[]" value="<?php echo $OrderID[$j]; ?>" class="hide"> -->
	                        		    <input type="hidden" id="<?php echo 'orderID'. $OrderID[$j]; ?>" name="<?php echo 'orderID'. $OrderID[$j]; ?>" value="<?php echo $OrderID[$j]; ?>">
	                        		<td id="customerName"><?php echo $CustomerName[$j]; ?></td>
	                        		<td id="productWeight"><?php echo $UnitProduct[$j]; ?></td>
	                        	</tr>
	                        	<?php
                        			}
                        		?>
                        		
                        	</table>     	
                        	<br>

								<tr> 
									<input id="example" type="button" value="คำนวณ" class="btn btn-primary"/>
									<td><label id="labelWeight">รวมน้ำหนักสินค้าทั้งหมด :</label>
										<input type="text" id="txtWeightProduct" name="txtWeightProduct" readonly> 
										<label id="labelWeight">ตัน</label>
									</td>
								</tr>
								<br>
								<br>

								<label id="title">รถบรรทุก</label>
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
		                             		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                                	<label id="label">บรรจุน้ำหนักสินค้า :</label> 
		                                	<label id="txtTruckCapacity" name="txtTruckCapacity" ></label>
		                                	<label id="labelWeight">ตัน</label>

		                                </td>
	                            	</tr>
                            	</table>

                            	<label id="title">พนักงานขับ</label>
		                            <tr> 
										<td><label id="labelEmployee">เลือพนักงานขับรถ :</label>
											<select id="ddEmployee" name="ddEmployee" >
	                                	 		<option value="" selected>--------กรุณาเลือก--------</option>
			                                	 	<?php
			                        					for($j=0;$j<$ddemployee;$j++){ 
			                        				?>	
	                                			<option value="<?php echo $EmployeeID[$j]; ?>"><?php echo $EmployeeName[$j]; ?></option>
	                                				<?php
	                        							}
	                        						?>
	                                		</select>
										</td>
									</tr>

								<table id="table3" width="100%">
									<tr id="row-employee">
		                                <td>
		                                	<label id="label">เบอร์โทรศัพท์:</label>	
		                                	<label id="txtTelEmployee" name="txtTelEmployee"></label>
		                       			 </td>	
		                       		</tr>
		                       	</table>
 
		                       	<label id="title">ช่วงเวลาเดินทาง</label>
		                       		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			                       	<input name="rdoDate" type="radio" value="09:00-15:00">
			                       	<label id="rdoDate" >09:00-15:00 น.</label>
									<input name="rdoDate" type="radio" value="21:00-05:00">
									<label id="rdoDate" >21:00-05:00 น.</label>

	                            <br>
	                            <br>
	                            <tr id="button-command">
	                            		<td><button type="button" id="btnBack" class="btn btn-danger btn-md">กลับไปหน้าหลัก</button></td>
	                                    <td><button type="submit" id="btnCF" class="btn btn-success btn-md">สร้างเส้นทาง</button></td>
	                                    
	                            </tr>

	                        
				</div>
			</div>	
		</div><!--end of tooplate_main-->
	</form>

		<div id="tooplate_footer_wrapper">
			<div id="tooplate_footer">
					Copyright © 2016 &nbsp;&nbsp;The GobalChemicals CO.,LTD.
				<div class="cleaner"></div><!--end of tooplate_footer-->
			</div><!--end of tooplate_footer-->
		</div> <!--end of tooplate_footer_wrapper-->

	
	</body>
</html>
