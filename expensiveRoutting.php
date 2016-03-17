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

		<link href="css/expensiveRoutting.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
		<script type="text/javascript" src="js/expensiveRoutting.js"></script>
		
		

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

				require 'dbManagement.php';
				$dbManagement = new dbManagement();			
				$transport = $dbManagement->select("SELECT * FROM transport
													JOIN truck ON transport.TruckID=truck.TruckID");

				
				if (mysqli_num_rows($transport) > 0) {
				    while($row = mysqli_fetch_assoc($transport)) {
				        $TransportID = $row["TransportID"];
				        $AmountDistance = $row["AmountDistance"];
				        $TruckID = $row["TruckID"];
				        $ConsumptionFuel = $row["ConsumptionFuel"];
				        $FuelID = $row["FuelID"];
				        $TruckCost = $row["TruckCost"];
				        $ResidualValue = $row["ResidualValue"];
				    }
				   
				}
				
			?>
		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l">

 			<form action="expensiveAddSQL.php">
				<input type="hidden" id="transportId" name="transportId" value="<?php echo $TransportID ?>">
				<input type="hidden" id="consumptionExp" name="consumptionExp" value="<?php echo $ConsumptionFuel ?>">
				<input type="hidden" id="truckCost" name="truckCost" value="<?php echo $TruckCost ?>">
				<input type="hidden" id="residualValue" name="residualValue" value="<?php echo $ResidualValue ?>">
	            <br>
	            
		            <div class="expensive">
		              	<p>ค่าใช้จ่ายต่างๆ</p> 
	                        <table id="table" style="width: 100%">

	                            <tr>
	                                <td><label id="fuelId">ชนิดน้ำมัน:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $FuelID ?></label></td>
									
	                            </tr>

	                            <tr>
	                                <td><label>ค่าน้ำมันเชื้อเพลิง:</label>
	                                	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	                                	<input type="text" id="FuelExpensive" name="FuelExpensive" value="35" required>
	                               		 &nbsp;&nbsp;<label>บาท/ลิตร</label>
	                               		
									</td>
	                            </tr>

								<tr>
	                                <td><label>ระยะเวลาค่าเสื่อมราคา :</label>
	                                	&nbsp;&nbsp;&nbsp;&nbsp;
	                               		<input type="text" id="ConsumptionExp" name="ConsumptionExp" value="7" required>
	                                	&nbsp;&nbsp;<label>ปี</label>
	                                </td>
	                            </tr>

	                            <tr>
	                                <td><label>ค่าแรงงาน(ต่อคน) :</label>
	                                	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	                                	<input type="text" id="LaborExpensive" name="LaborExpensive" value="300" required>
	                                	<label>บาท/วัน</label>
	                                </td>
	                            </tr>

	                            <tr>
	                                <td><label>จำนวนพนักงาน :</label>
	                                	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	                                	<input type="text" id="AmountExployee" name="AmountExployee" value="2" required>
	                                	&nbsp;&nbsp;<label>คน</label>
	                                </td>
	                            </tr>

	                            <tr>
	                                <td><label>ค่าซ่อมบำรุง :</label>
	                                	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	                                	<input type="text" id="MaintenanceExp" name="MaintenanceExp" value="4" required>
	                                	&nbsp;&nbsp;<label>บาท/กิโลเมตร</label>
	                                </td>
	                            </tr>

	                          	<tr>
	                                <td><label>จำนวนวันทำงานต่อเดือน :</label>
	                                	<input type="text" id="AmountDate" name="AmountDate" value="25" required>
	                                	&nbsp;&nbsp;<label>วัน</label>
	                                </td>
	                            </tr>	

	                            <tr>
	                                <td><label id="labelDistance">ระยะทางที่วิ่ง :&nbsp;&nbsp; <?php echo $AmountDistance ?></label>
	                                	&nbsp;&nbsp;<label>กิโลเมตร</label> 
	                                </td>
	                            </tr> 
	                            <br>
	                            <tr>
	                            	<td><button type="button" id="btnCalculator" name="calculator" class="btn btn-primary" data-distance="<?php echo $AmountDistance ?>">คำนวณ</button></td>
	                            </tr>                           	                            
							</table>
						</div>
						<br>
						<br>
                        <div class="Fixedcosts">
                        	<p>ต้นทุนคงที่</p>
                        	 <table id="table" style="width: 100%">
	                            <tr> 
	                            	<td><label>ค่าเสื่อมราคา :</label>
	                            		<label id="DepreciationDay"></label>
	                            		<label>(บาท/วัน)</label>
	                            		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	                            	</td>
	                            </tr>
	                            <tr> 
	                            	<td><label>ค่าแรงงาน :</label>
	                            		<label id="LoborExpDay"></label>
	                            		<label>(บาท/วัน)</label>
	                            		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	                            	</td>
	                            </tr>
	                            <tr> 
	                            	<td><label>ต้นทุนคงที่ต่อวัน :</label>
	                            		<label id="FixedcostsDay"></label>
	                            		<label>(บาท/วัน)</label>
	                            		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	                            	</td>
	                            </tr>
	                            <tr> 
	                            	<td><label>ต้นทุนคงที่ต่อรอบ :</label>
	                            		<label id="FixedcostsAround"></label>
	                            		<label>(บาท/รอบ)</label>
	                            	</td>
	                            </tr>
	                            <tr> <td>&nbsp;</td></tr>
                            </table>
                        </div>

                        <div class="Variablecosts">
                        	<p>ต้นทุนผันแปร</p>
                        	 <table id="table" style="width: 100%">
	                            <tr> 
	                            	<td><label>ค่าน้ำมันเชื้อเพลิง :</label>
	                            		<label id="FuelCost"></label>
	                            		<label>(บาท/กม.)</label>
	                            	</td>
	                            </tr>
	                            <tr> 
	                            	<td><label>ค่าซ่อมบำรุง :</label>
	                            		<label id="MaintenanceCost"></label>
	                            		<label>(บาท/กม.)</label>
	                            	</td>
	                            </tr>
	                            <tr> 
	                            	<td><label>ค่าใช้จ่ายแปรผันรวมต่อกิโลเมตร :</label>
	                            		<label id="ExpensesAllKm"></label>
	                            		<label>(บาท/กม.)</label>
	                            	</td>
	                            </tr>

	                            <tr> <td>&nbsp;</td></tr>
                            </table>
                        </div>   

		                <div class="ExpensesAll">
                        	<p>ค่าใช้จ่าย</p>
                        	 <table id="table" style="width: 100%">
	                            <tr> 
	                            	<td><label>ค่าใช้จ่ายรวมต่อวัน :</label>&nbsp;&nbsp;&nbsp;
	                            		<label id="ExpensesPerDay"></label>
	                            		<input type="hidden" id="hiddenExpensesPerDay" name="hiddenExpensesPerDay" value="0" >
	                            		<label>บาท</label>
	                            	</td>
	                            </tr>
	                            <tr> 
	                            	<td><label>ค่าใช้จ่ายรวมต่อรอบ :</label>
	                            		<label id="ExpensesPerAround"></label>
	                            		<input type="hidden" id="hiddenExpensesPerAround" name="hiddenExpensesPerAround" value="0">
	                            		<label>บาท</label>
	                            	</td>
	                            </tr>

	                            <tr> <td>&nbsp;</td></tr>
                            </table>
                        </div>  

                        <div id="btnCB">
			                <tr id="button-command">
			                    <td>
			                    	<a href="indexEmployee.php">
			                    	<button type="button" id="btnBack" class="btn btn-danger btn-md">กลับไปหน้าหลัก</button>
			                    	</a>
			                    </td>
			                    
			                  
			                    <td><button type="submit" id="btnCF" class="btn btn-success btn-md">บันทึกเส้นทาง</button></td>
							
			                </tr>
	            		</div>                
		        </form>           
	                        
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
