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

		<link href="css/employeeEdit.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
		<link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
		<script type="text/javascript" src="js/employeeEdit.js"></script>


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
					</div> <!-- end of tooplate_header -->
				</div><!--end of tooplate_wrapper-->
		</div><!--end of tooplate_body_wrapper-->


			<?php 
			require 'dbManagement.php';
			$dbManagement = new dbManagement();
			$result = $dbManagement->select("SELECT * FROM employee 
														JOIN aumphur ON employee.AumphurID=aumphur.AumphurID
														JOIN province ON employee.ProvinceID=province.ProvinceID
														JOIN  district ON employee.DistrictID=district.DistrictID
														JOIN zipcode ON employee.ZipcodeID=zipcode.ZipcodeID
														JOIN position ON employee.PositionID=position.PositionID
												WHERE EmployeeID ='" . $_REQUEST['EmployeeID'] . "'");

			$province = $dbManagement->select("SELECT * FROM province ORDER BY ProvinceName");
			$ddprovince = 0;
			if (mysqli_num_rows($province) > 0) {
				while($row = mysqli_fetch_assoc($province)) {
					$ProvinceID[$ddprovince] = $row["ProvinceID"];
					$ProvinceName[$ddprovince] = $row["ProvinceName"];
					$ddprovince++;
				}
					   
			}

			$i = 0;
			if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
			    	$EmployeeUsername[$i] = $row["EmployeeUsername"];
			    	$EmployeeID[$i] = $row["EmployeeID"];
			        $EmployeeName[$i] = $row["EmployeeName"];
			        $PositionID[$i] = $row["PositionID"];
			        $PositionName[$i] = $row["PositionName"];
			        $EmployeeAddress[$i] = $row["EmployeeAddress"];
			        $DistrictID[$i] = $row["DistrictID"];
			        $DistrictName[$i] = $row["DistrictName"];
			        $AumphurID[$i] = $row["AumphurID"];
			        $AumphurName[$i] = $row["AumphurName"];
			        $ProvinceID[$i] = $row["ProvinceID"];
			        $ProvinceName[$i] = $row["ProvinceName"];
			        $ZipcodeID[$i] = $row["ZipcodeID"];
			        $Zipcode[$i] = $row["Zipcode"];
			        $EmployeeTel[$i] = $row["EmployeeTel"];

			        $i++;
			    }
			}
		?>

	<form action="editEmployeeSQL.php" method="post">
		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l">

						<h2>แก้ไขข้อมูลพนักงาน</h2>
                       
                        <table id="table" style="width: 100%">

                                <input type="hidden" id="txtUsername" name="txtUsername" value="<?php echo $EmployeeUsername[0]; ?>">
                                <input type="hidden" id="txtPassword" name="txtPassword" value="<?php echo $EmployeePassword[0]; ?>">
                                <input type="hidden" id="txtEmployeeID" name="txtEmployeeID" value="<?php echo $EmployeeID[0]; ?>">
                            

                            <tr>
                                <td><label>ชื่อพนักงาน :</label></td>
                                <td><input type="text" id="txtEmployeeName" name="txtEmployeeName" value="<?php echo $EmployeeName[0]; ?>"></td>
                            </tr>

                            <tr>
                                <td><label>ตำแหน่ง:</label></td>
                                <td>
                                	<select id="position" name="txtEmployeePosition" >
                                			<option value="<?php echo $PositionID[0]; ?>"><?php echo $PositionName[0]; ?></option>
											 <option value="" >------ กรุณาเลือก ------</option>
                                	 	<?php
                        					for($p=0;$p<$i;$p++){ 
                        				?>	
                                			<option value="<?php echo $PositionID[$p]; ?>"><?php echo $PositionName[$p]; ?></option>
                                		<?php
                        					}
                        				?>
									</select> 
                                </td>
                            </tr>

                            <tr>
                                <td><label>ที่อยู่ เลขที่ :</label></td>
                                <td><input type="text" id="txtEmployeeAddress" name="txtEmployeeAddress" value="<?php echo $EmployeeAddress[0]; ?>"></td>
                            </tr>
                            
                           <tr>
                                <td><span class="red-star">* </span><label>จังหวัด :</label></td>
                                <td>
                                	<select id="province" name="province" required>
                                	<option value="<?php echo $ProvinceID[0]; ?>" selected><?php echo $ProvinceName[0]; ?></option>
                                	<option value="" >------ เลือกจังหวัด ------</option>
                                	 	<?php
                        					for($j=0;$j<$ddprovince;$j++){ 
                        				?>	
                                		<option value="<?php echo $ProvinceID[$j]; ?>"><?php echo $ProvinceName[$j]; ?></option>
                                		<?php
                        					}
                        				?>
									</select> 
								</td>
                            </tr>         

                            <tr id="district-row">
                                <td><label><span class="red-star">* </span>อำเภอ :</label></td>
                                <td><select id="txtDistrict" name="txtDistrict">
                                	<option value="<?php echo $AumphurID[0]; ?>" selected><?php echo $AumphurName[0]; ?></option>
                                	</select> 
                                </td>
                            </tr>

                            <tr id="subDistrict-row">
                                <td><label><span class="red-star">* </span>ตำบล :</label></td>
                                <td><select id="txtSubDistrict" name="txtSubDistrict">
                                	<option value="<?php echo $DistrictID[0]; ?>" selected><?php echo $DistrictName[0]; ?></option>
                                	</select>
                                </td>
                            </tr>                            

                                                      
                            <tr id="zipcode-row">
                                <td><label><span class="red-star">* </span>รหัสไปรษณีย์ :</label></td>
                                <td><select type="text" id="txtZipcode" name="txtZipcode" >
                                	<option value="<?php echo $ZipcodeID[0]; ?>" selected><?php echo $Zipcode[0]; ?></option>
                                	</select>
                                </td>
                            </tr>

                            <tr>
                                <td><label>เบอร์โทรศัพท์ :</label></td>
                                <td>
                                	<input type="tel" id="txtEmployeeTel" name="txtEmployeeTel" value="<?php echo $EmployeeTel[0]; ?>">
                                </td>
                            </tr>
                            
                            <tr> <td>&nbsp;</td></tr>
                            <tr> <td>&nbsp;</td></tr>

                            <tr>
                                     <td><a href="employee.php"><button type="button" id="btnBack">กลับไปหน้าหลัก</button></a></td>
                                     <td><button type="submit" id="btnCF">บันทึก</button></td>
                                   
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
