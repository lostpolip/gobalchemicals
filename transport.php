<?php
	session_start();
	if(!isset($_SESSION['EmployeeName'])){
		header( "location: /gobalchemicals/indexLogin.html" );
	}
	if (!($_SESSION['PositionID'] == 4 || $_SESSION['PositionID'] == 1)) {
		header( "location: /gobalchemicals/permission.php" );
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
	
	<style>
		a.alert {
			display: inline-block;
			position: relative;
		    padding: 2px 0px 0 4px;
		}
		span.alert {
		    position: absolute;
		    padding: 1px;
		    top: 0px;
		    color: white;
		    background-color: red;
		    font-size: 12px;
		    border-radius: 25px;
		    height: auto;
		    width: auto;
		    left: 28px;
		    display: none;
		}
	</style>

	</head>
	<body>

			<div id="tooplate_body_wrapper">
				<div id="tooplate_wrapper">
					<div id="tooplate_header">	
                    	<div id="tooplate_user">
							<label id="label1"><?php echo $_SESSION['EmployeeName']?> |&nbsp;</label>
                        </div>
                          <div id="imageMenuOrder" style="">

							<a href="approveClaim.php" class="alert">
								<input type="image" src="images/claim.png" alt="Submit" id="menu0rder">
								<span class="alert" id="txtClaim"></span>
							</a>
                            <a class="alert" href="approveOrder.php"><input type="image" src="images/order.png" alt="Submit" id="menu0rder">
                            	<span class="alert" id="txtOrder"></span>
                            </a>
                        </div>

					  <div id="tooplate_top">
							<div id="tooplate_login">
						  		<a href="logOutBack.php"><input type="button" name="Search" value="" alt="Search" id="searchbutton" class="sub_btn"  /></a>
							</div>
					  </div>						
						<div id="site_title"><h1><a href="indexEmployee.php">Gray Box</a></h1>
							<div id="tooplate_menu" class="ddsmoothmenu">
								<ul >
									<li><a href="#" >จัดการข้อมูล</a>
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
												<li><a href="paymentCustomer.php">การชำระเงิน</a></li>
										</ul>
			                        </li>
			                        
			                        <li><a href="#" >คลังสินค้า</a>
										<ul>
											<li><a href="productReceive.php">รับสินค้า</a></li>
											<li><a href="productPurchase.php">สั่งสินค้า</a></li>
											<li><a href="productStock.php">เช็คสินค้า</a></li>
									  	</ul>
									</li>
									
									<li ><a href="#" class="selected">ส่งสินค้า</a>
				                        <ul>
												<li ><a href="transport.php">จัดเส้นทาง</a></li>
												<li ><a href="billTransport.php">ใบส่งสินค้า</a></li>

										</ul>
			                        </li>
			                        
									<li ><a href="#">สรุปรายงาน</a>
			                            <ul>
											<li><a href="reportAll.php">รายงานรายได้</a></li>
											<li><a href="reportExpensesAll.php">รายงานค่าใช้จ่าย</a></li>
											<li><a href="reportCar.php">รายงานการใช้รถบรรทุก</a></li>
											
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
											JOIN aumphur ON orders.AumphurID=aumphur.AumphurID
											WHERE State='processing'
											ORDER BY OrderSendDate
											");

			$popupOrder = 0;
			if (mysqli_num_rows($order) > 0) {
			    while($row = mysqli_fetch_assoc($order)) {
			        $OrderID[$popupOrder] = $row["OrderID"];
			        $OrderDate[$popupOrder] = $row["OrderDate"];
			        $CustomerID[$popupOrder] = $row["CustomerID"];
			        $CustomerName[$popupOrder] = $row["CustomerName"];
			        $latOrder[$popupOrder] = $row["latOrder"];
			        $lonOrder[$popupOrder] = $row["lonOrder"];
			        $Distance[$popupOrder] = $row["Distance"];
			        $UnitProduct[$popupOrder] = $row["UnitProduct"];
			        $AumphurID[$popupOrder] = $row["AumphurID"];
			        $GeoName[$popupOrder] = $row["GeoName"];
			        $OrderSendDate[$popupOrder] = $row["OrderSendDate"];
			        $popupOrder++;
			    }		   
			}

		?>
	<form id="transportAddForm" action="transportMap.php">
		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l">
					<p>จัดเส้นทาง</p>
	           
	                    <input type="hidden" id="txtTransportID" name="txtTransportID">
	                    
	                    <label id="labelDate">วันที่ส่งสินค้า:</label>
	                    <input type="date" id="txtDateTransport" name="txtDateTransport" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" required>
	                    
							<table id="table2" width="100%">
	                        	<tr> 
	                        		<th>เลือก</th>	                                
	                        		<th>วันที่กำหนดส่งสินค้า</th>	                                
	                        		<th>รหัสสั่งซื้อ</th>
	                                <th>ชื่อลูกค้า</th>
	                                <th>ภูมิภาค</th>
	                                <th>น้ำหนักสินค้า(ตัน)</th>
	                        	</tr>
	                        	<?php 
	   								for($j=0; $j<$popupOrder; $j++){
	   							?>
	                        	<tr>
	                        		<td><input type="checkbox" name="destination[]" value="<?php echo $latOrder[$j].','.$lonOrder[$j].'&'. $OrderID[$j] ?>" 
	                        		data-unitproduct="<?php echo $UnitProduct[$j]; ?>"
	                        		data-orderid="<?php echo $OrderID[$j]; ?>">
	                        		</td>
	                        		<td id="orderdate" ><?php echo $OrderSendDate[$j]; ?></td>
	                        		<td id="orderId" ><?php echo $OrderID[$j]; ?></td>
	                        		<td id="customerName"><?php echo $CustomerName[$j]; ?></td>
	                        		<td id="Geo"><?php echo $GeoName[$j]; ?></td>
	                        		<td id="productWeight"><?php echo $UnitProduct[$j]; ?></td>
	                        	</tr>
	                        	<?php
                        			}
                        		?>
                        		
                        	</table>     	
                        	<br>

								<tr> 
								
									<td><label id="labelWeight">รวมน้ำหนักสินค้าทั้งหมด :</label>
										<input type="text" id="txtWeightProduct" name="txtWeightProduct" value="0" readonly> 
										<label id="labelWeight">ตัน</label>
									</td>
								</tr>
								<br>
								<br>

								<div id="timeInfo">
	                         		<label id="title">ช่วงเวลาเดินทาง</label>
			                       		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				                       	<input name="rdoDate" id="rdoDate1" type="radio" value="09:00-16:00" class="time" required>
				                       	<label id="rdoDate" for="rdoDate1">09:00-16:00 น.</label>

										<input name="rdoDate" type="radio" id="rdoDate2" value="10:00-15:00" class="time" required>
										<label id="rdoDate" for="rdoDate2">10:00-15:00 น.</label>

										<input name="rdoDate" type="radio" id="rdoDate3" value="21:00-05:00" class="time" required>
										<label id="rdoDate" for="rdoDate3">21:00-05:00 น.</label>
									<br>
								</div>
								<div id="truckInfo">
										<label id="title">รถบรรทุก</label>
										<br>										
											<tr> 
												<td>
													<div id="truckOther"></div>
												</td>
											</tr>
								</div> 			
								<br>
								<div id="employeeInfo">	
                            		<label id="title">พนักงานขับ</label>
			                            <tr> 
											<td>
												<div id="employeeOther"></div>
											</td>
										</tr>
			                    </div>
	                            <br>
	                            <br>
	                          

	                            <tr id="button-command">
	                            		<td><a href="indexEmployee.php"><button type="button" id="btnBack" class="btn btn-danger btn-md">กลับไปหน้าหลัก</button></a></td>
	                                    <td><button type="button" id="btnCF" class="btn btn-success btn-md">สร้างเส้นทาง</button></td>
	                                    
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
