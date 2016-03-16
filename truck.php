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

		<link href="css/truck.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
		<link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
		<!--<script type="text/javascript" src="js/index.js"></script>-->


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
					</div> <!-- end of tooplate_header -->
				</div><!--end of tooplate_wrapper-->
		</div><!--end of tooplate_body_wrapper-->

		<?php
			require 'dbManagement.php';
			$dbManagement = new dbManagement();
			$result = $dbManagement->select("SELECT * FROM truck
											 WHERE StateTruck='confirm'
											 ");

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

		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l">

					<h2>รถบรรทุก</h2>
                        <p>
                            <button id="btnAdd"><a href="truckAdd.php">เพิ่มรถบรรทุก</a></button>
                        </p>
<!--                         <table id="table" style="width: 100%">
                            <tr>
                                <td><label>ค้นหาข้อมูล</label> &nbsp;&nbsp;
                                    <input ID="txtSearch">
                                &nbsp;&nbsp;
                                   <button id="btnOK">ตกลง</button>
                                </td>
                            </tr>                           
                        </table>   -->

				</div>
			</div>	
						<table id="table2" width="100%">
                        	<tr>
                        		<th>เลขทะเบียนรถ</th>
                                <th>ประเภทรถ</th>
                                <th>เชื้อเพลิง</th>
                                <th>น้ำหนักรถ</th>
                                <th>บรรจุน้ำหนัก</th>
                                <th>ปริมาณสินค้า</th>
                                <th>คำสั่ง</th>
                                
                        	</tr>

                        	<?php
                        	for($j=0;$j<$i;$j++){ 
                        	?>
                        	<tr>
                        		<td id="carid"><?php echo $TruckName[$j]; ?></td>
                        		<td id="cartype"><?php echo $TruckTypeID[$j]; ?></td>
                        		<td id="carfuel"><?php echo $FuelID[$j]; ?></td>
                        		<td id="carweight"><?php echo number_format($TruckWeight[$j]); ?></td>
                        		<td id="carcapaity"><?php echo number_format($WeightCapacity[$j]); ?></td>
                        		<td id="carquantity"><?php echo number_format($WeightQuantity[$j]); ?></td>
                        		<td>
                        			<button id="btnDetail"><a href="truckDetail.php?TruckID=<?php echo $TruckID[$j]; ?>">รายละเอียด</a></button>
                        			<button id="btnEdit"><a href="truckEdit.php?TruckID=<?php echo $TruckID[$j]; ?>">แก้ไข</a></button>
                        			<button id="btnDelete"><a href="deleteTruckSQL.php?TruckID=<?php echo $TruckID[$j]; ?>">ลบ</a></button>
                        		</td>
                        	</tr>
                        	<?php
                        	}
                        	?>
                        </table>       
		</div><!--end of tooplate_main-->


		<div id="tooplate_footer_wrapper">
			<div id="tooplate_footer">
					Copyright © 2016 <a href="#">The GobalChemicals CO.,LTD.</a>
				<div class="cleaner"></div><!--end of tooplate_footer-->
			</div><!--end of tooplate_footer-->
		</div> <!--end of tooplate_footer_wrapper-->

	
	</body>
</html>
