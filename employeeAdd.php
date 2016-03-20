<?php
	session_start();
	if(!isset($_SESSION['EmployeeName'])){
		header( "location: /gobalchemicals/indexLogin.html" );
	}
	if (!($_SESSION['PositionID'] == 1)) {
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

		<link href="css/employeeAdd.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
		<script type="text/javascript" src="js/employeeAdd.js"></script>


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
												<li ><a href="billTransport.php">ใบส่งสินค้า</a></li>

										</ul>
			                        </li>
			                        
									<li ><a href="#">สรุปรายงาน</a>
			                            <ul>
											<li><a href="reportAll.php">รายงานรายได้</a></li>
											<li><a href="reportExpensesAll.php">รายงานค่าใช้จ่าย</a></li>
											
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
			$province = $dbManagement->select("SELECT * FROM province");
			$position = $dbManagement->select("SELECT * FROM position");

			$ddPosition = 0;
			if (mysqli_num_rows($position) > 0) {
			    while($row = mysqli_fetch_assoc($position)) {
			        $PositionID[$ddPosition] = $row["PositionID"];
			        $PositionName[$ddPosition] = $row["PositionName"];
			        $ddPosition++;
			    }
			   
			}

			$i = 0;
			if (mysqli_num_rows($province) > 0) {
			    while($row = mysqli_fetch_assoc($province)) {
			        $ProvinceID[$i] = $row["ProvinceID"];
			        $ProvinceName[$i] = $row["ProvinceName"];
			        $i++;
			    }
			   
			}
		?>

	<form action="employeeAddSQL.php">
		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l">

					<h2>เพิ่มพนักงาน</h2>
                    <table id="table" style="width: 100%">
                        	<tr>
                                <td><label><span class="red-star">* </span>ชื่อผู้ใช้งาน:</label></td>
                                <td><input type="text" id="txtUsername" name="txtUsername" placeholder="สำหรับเป็น Login" required > </td>
                            </tr>

                            <tr>
                                <td><label><span class="red-star">* </span>รหัสผ่าน:</label></td>
                                <td><input type="password" id="txtPassword" name="txtPassword" placeholder="a-z หรือ A-Z หรือ 0-9" required ></td>
                            </tr>

                            <tr> <td>&nbsp;</td></tr>

                            <tr><td ><input type="hidden" id="txtEmployeeID" name="txtEmployeeID"></input></td></tr>

                             <tr>
                                <td><label><span class="red-star">* </span>ชื่อพนักงาน :</label></td>
                                <td><input type="text" id="txtEmployeeName" name="txtEmployeeName"></td>
                            </tr>

                            <tr>
                                <td><label>ตำแหน่ง:</label></td>
                                <td>
                                	<select id="position" name="positionEmployee">
											  <option value="" >------ กรุณาเลือก ------</option>
                                	 	<?php
                        					for($p=0;$p<$ddPosition;$p++){ 
                        				?>	
                                		<option value="<?php echo $PositionID[$p]; ?>"><?php echo $PositionName[$p]; ?></option>
                                		<?php
                        					}
                        				?>
									</select> 
                                </td>
                            </tr>

                            <tr>
                                <td><label><span class="red-star">* </span>ที่อยู่ เลขที่ :</label></td>
                                <td><input type="text" id="txtEmployeeAddress" name="txtEmployeeAddress"></td>
                            </tr>

                            <tr>
                                <td><label><span class="red-star">* </span>จังหวัด :</label></td>
                                <td>
                                	<select id="province" name="province" required>
                                	<option value="" selected>------ เลือกจังหวัด ------</option>
                                	 	<?php
                        					for($j=0;$j<$i;$j++){ 
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
                                </select> 
                                </td>
                            </tr>

                            <tr id="subDistrict-row">
                                <td><label><span class="red-star">* </span>ตำบล :</label></td>
                                <td><select id="txtSubDistrict" name="txtSubDistrict">
                                </select>
                                </td>
                            </tr>                            

                                                      
                            <tr id="zipcode-row">
                                <td><label><span class="red-star">* </span>รหัสไปรษณีย์ :</label></td>
                                <td><select type="text" id="txtZipcode" name="txtZipcode" >
                                </select>
                                </td>
                            </tr>

                            <tr>
                                <td><label><span class="red-star">* </span>เบอร์โทรศัพท์ :</label></td>
                                <td><input type="tel" id="txtEmployeeTel" name="txtEmployeeTel" required> </td>
                            </tr>
                            
                            <tr> <td>&nbsp;</td></tr>
                            <tr> <td>&nbsp;</td></tr>

                            <tr>
                            		<td><a href="employee.php"><button type="button" id="btnBack">กลับไปหน้าหลัก</button></a></td>
                                    <td><button type="submit" id="btnCF" disabled>บันทึก</button></td>
                                    
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
