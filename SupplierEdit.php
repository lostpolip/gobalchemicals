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

		<link href="css/supplierEdit.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
		<link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
		<script type="text/javascript" src="js/supplierEdit.js"></script>


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
					</div> <!-- end of tooplate_header -->
				</div><!--end of tooplate_wrapper-->
		</div><!--end of tooplate_body_wrapper-->

		<?php
			require 'dbManagement.php';
			$dbManagement = new dbManagement();
			$result = $dbManagement->select("SELECT * FROM supplier where SupplierID='" . $_REQUEST['SupplierID'] . "'");

			$i = 0;
			if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
			    	$SupplierID[$i] = $row["SupplierID"];
			        $SupplierName[$i] = $row["SupplierName"]; 
			        $SupplierAddress[$i] = $row["SupplierAddress"]; 
			        $SupplierDistrict[$i] = $row["SupplierDistrict"]; 
			        $SupplierProvince[$i] = $row["SupplierProvince"]; 
			        $SupplierZipcode[$i] = $row["SupplierZipcode"]; 
			        $SupplierTel[$i] = $row["SupplierTel"];
			        $SupplierEmail[$i] = $row["SupplierEmail"];
			        $i++;
			    }
			}

		?>	

	<form action="editSupplierSQL.php" method="post">
		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l">

						<h2>แก้ไขผู้จัดจำหน่าย</h2>
                       
                        <table id="table" style="width: 100%">

                                <input type="hidden" id="txtSupplierID" name="txtSupplierID" value="<?php echo $SupplierID[0]; ?>">

                            <tr>
                                <td>ชื่อผู้จัดจำหน่าย:</td>
                                <td><input type="text" id="txtSupplierName" name="txtSupplierName" value="<?php echo $SupplierName[0]; ?>">            	
                                </td>
                            </tr>

                            <tr>
                                <td><span class="red-star">*</span>ที่อยู่ เลขที่ :</td>
                                <td><input type="text" id="txtSupplierAddress" name="txtSupplierAddress" value="<?php echo $SupplierAddress[0]; ?>" required>	
                                </td>
                            </tr>

                            <tr>
                                <td><span class="red-star">*</span>อำเภอ :</td>
                                <td><input type="text" id="txtSupplierDistrict" name="txtSupplierDistrict" value="<?php echo $SupplierDistrict[0]; ?>" required>                               	
                                </td>
                            </tr>

                            <tr>
                                <td><span class="red-star">*</span>จังหวัด :</td>
                                <td><input type="text" id="txtSupplierProvince" name="txtSupplierProvince" value="<?php echo $SupplierProvince[0]; ?>"></input>
                                </td>
                            </tr>

							<tr>
                                <td><span class="red-star">*</span>รหัสไปรษณีย์ :</td>
                                <td>
                                	<input type="text" id="txtSupplierZipcode" name="txtSupplierZipcode" value="<?php echo $SupplierZipcode[0]; ?>" required>                            
                                </td>

                            </tr>

                            <tr>
                                <td><span class="red-star">*</span>เบอร์โทรศัพท์ :</td>
                                <td>
                                	<input type="tel" id="txtSupplierTel" name="txtSupplierTel" value="<?php echo $SupplierTel[0]; ?>" required>                               	
                                </td>
                            </tr>

                            <tr>
                                <td>Email :</td>
                                <td>
                                	<input type="email" id="txtSupplierEmail" name="txtSupplierEmail" value="<?php echo $SupplierEmail[0]; ?>">
                                </td>
                            </tr>

                            <tr> <td>&nbsp;</td></tr>
                            <tr> <td>&nbsp;</td></tr>

                            <tr>
                                    <td><a href="supplier.php"><button type="button" id="btnBack">กลับไปหน้าหลัก</button></a></td>
                                    <td><button id="btnCF">บันทึก</a></button></td>
                                    
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
