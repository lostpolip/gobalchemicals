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

		<link href="css/truckEdit.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
		<link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
		<script type="text/javascript" src="js/truckEdit.js"></script>


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
		                       <form action="index.html" method="get">
		  							<a href="logOutBack.php"><input type="button" name="Search" value="" alt="Search" id="searchbutton" class="sub_btn"  /></a>
								</form>
							</div>
					  </div>						
						<div id="site_title"><h1><a href="indexEmployee.php">Gray Box</a></h1></div>
							<div id="tooplate_menu" class="ddsmoothmenu">
								<ul >
									<li><a href="#" class="selected">จัดการข้อมูล</a>
				                        <ul>
												<li><a href="product.php">ข้อมูลสินค้า</a></li>
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
					</div> <!-- end of tooplate_header -->
				</div><!--end of tooplate_wrapper-->
		</div><!--end of tooplate_body_wrapper-->

		<?php
			require 'dbManagement.php';
			$dbManagement = new dbManagement();
			$result = $dbManagement->select("SELECT * FROM  truck where TruckID='". $_REQUEST['TruckID'] ."'");
			$trucktype = $dbManagement->select("SELECT * FROM trucktype");
			$fuel = $dbManagement->select("SELECT * FROM fuel");

			$ddTruckType = 0;
			if (mysqli_num_rows($trucktype) > 0) {
			    while($row = mysqli_fetch_assoc($trucktype)) {
			        $TruckTypeName[$ddTruckType] = $row["TruckTypeName"];
			        $ddTruckType++;
			    }
			}

			$ddFuel = 0;
			if (mysqli_num_rows($fuel) > 0) {
			    while($row = mysqli_fetch_assoc($fuel)) {
			        $FuelName[$ddFuel] = $row["FuelName"];
			        $ddFuel++;
			    }
			}			

			$i = 0;
			if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
			    	$TruckID[$i] = $row["TruckID"];
			        $TruckName[$i] = $row["TruckName"];
			        $TruckTypeID[$i] = $row["TruckTypeID"];
			        $FuelID[$i] = $row["FuelID"];
			        $TruckWeight[$i] = $row["TruckWeight"];
			        $WeightCapacity[$i] = $row["WeightCapacity"];
			        $WeightQuantity[$i] = $row["WeightQuantity"];
			        $i++;
			    }
			}
		?>

	<form action="editTruckSQL.php" method="post">
		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l">

						<h2>แก้ไขข้อมูลรถบรรทุก</h2>
                       
                        <table id="table" style="width: 100%">

       
                               <input type="hidden" id="txtTruckID" name="txtTruckID" value="<?php echo $TruckID[0]; ?>">
 

                            <tr>
                                <td ><label><span class="red-star">*</span>เลขทะเบียนรถ :</label></td>
                                <td ><input type="text" id="txtTruckName" name="txtTruckName" value="<?php echo $TruckName[0]; ?>" required></td>
                            </tr>

                            <tr>
                                <td><label>ประเภท:</label></td>
                                <td>
                                	<select id="typeTruck" name="typeTruck">
                                			  <option value="<?php echo $TruckTypeID[0]; ?>" selected><?php echo $TruckTypeID[0]; ?></option>
											  <option value="">------ กรุณาเลือก ------</option>
										<?php
                        					for($j=0;$j<$ddTruckType;$j++){ 
                        				?>	
                                			  <option value="<?php echo $TruckTypeName[$j]; ?>"><?php echo $TruckTypeName[$j]; ?></option>
                                		<?php
                        					}
                        				?>
									</select> 
                                </td>
                            </tr>
                            <tr>
                                <td><label><span class="red-star">*</span>ประเภทเชื้อเพลิง :</label></td>
                                <td>
	                                <select id="fuelTruck" name="fuelTruck" required>
	                                          <option value="<?php echo $FuelID[0]; ?>" selected><?php echo $FuelID[0]; ?></option>
											  <option value="">------ กรุณาเลือก ------</option>
										<?php
                        					for($j=0;$j<$ddFuel;$j++){ 
                        				?>	
                                			  <option value="<?php echo $FuelName[$j]; ?>"><?php echo $FuelName[$j]; ?></option>
                                		<?php
                        					}
                        				?>
									</select> 
                                </td>
                            </tr>

                           <tr>
                                <td><label><span class="red-star">*</span>น้ำหนักรถ :</label></td>
                                <td>
                                	<input type="text" id="txtTruckWeight" name="txtTruckWeight" value="<?php echo $TruckWeight[0]; ?>" >
                                	<label>กิโลกรัม</label>
                                </td>
                            </tr>

							<tr>
                                <td><label><span class="red-star">*</span>บรรจุน้ำหนัก :</label></td>
                                <td>
                                	<input type="text" id="txtTruckCapacity" name="txtTruckCapacity" value="<?php echo $WeightCapacity[0]; ?>" >
                                	<label>ตัน</label>
                                </td>

                            </tr>

                            <tr>
                                <td><label><span class="red-star">*</span>ปริมาณสินค้า :</label></td>
                                <td>
                                	<input type="text" id="txtTruckQuantity" name="txtTruckQuantity" value="<?php echo $WeightQuantity[0]; ?>">
                                	<label>ถุง</label>
                                </td>
                            </tr>

                            <tr> <td>&nbsp;</td></tr>
                            <tr> <td>&nbsp;</td></tr>

                            <tr>
                                    <td><a href="truck.php"><button type="button" id="btnBack">กลับไปหน้าหลัก</button></a></td>
                                    <td><button type="submit">บันทึก</button></td>
                                    
                            </tr>

                        </table>
				</div>
			</div>
		</div><!--end of tooplate_main-->
	</form>

		<div id="tooplate_footer_wrapper">
			<div id="tooplate_footer">
					Copyright © 2016 <a href="#">The GobalChemicals CO.,LTD.</a>
				<div class="cleaner"></div><!--end of tooplate_footer-->
			</div><!--end of tooplate_footer-->
		</div> <!--end of tooplate_footer_wrapper-->

	
	</body>
</html>
