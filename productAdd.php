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

		<link href="css/productAdd.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
		<link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
		<script type="text/javascript" src="js/productAdd.js"></script>


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
                        </div>								  <div id="tooplate_top">
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
			$productType = $dbManagement->select("SELECT * FROM producttype");
			$brand = $dbManagement->select("SELECT * FROM brand");
			$supplier = $dbManagement->select("SELECT * FROM supplier");
			
			$ddProductType = 0;
			if (mysqli_num_rows($productType) > 0) {
			    while($row = mysqli_fetch_assoc($productType)) {
			        $ProductTypeID[$ddProductType] = $row["ProductTypeID"];
			        $ProductTypeName[$ddProductType] = $row["ProductTypeName"];
			        $ddProductType++;
			    }
			   
			}


			$ddBrandName = 0;
			if (mysqli_num_rows($brand) > 0) {
			    while($row = mysqli_fetch_assoc($brand)) {
			        $BrandID[$ddBrandName] = $row["BrandID"];
			        $BrandName[$ddBrandName] = $row["BrandName"];
			        $ddBrandName++;
			    }
			   
			}


			$ddSupplierName = 0;
			if (mysqli_num_rows($supplier) > 0) {
			    while($row = mysqli_fetch_assoc($supplier)) {
			        $SupplierID[$ddSupplierName] = $row["SupplierID"];
			        $SupplierName[$ddSupplierName] = $row["SupplierName"];
			        $ddSupplierName++;
			    }
			   
			}
		?>		

	<form action="productAddSQL.php" method="post" enctype="multipart/form-data">
		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l">

						<h2>เพิ่มสินค้า</h2>
                       
                        <table id="table" style="width: 100%">

                            <tr><input type="hidden" id="txtProductID" name="txtProductID"></tr>

                            <tr>
                                <td><label>ประเภทสินค้า:</label></td>
                                <td>
                                	<select id="type" name="drtypeProduct">
                                	<option value="" selected>------ กรุณาเลือก ------</option>
                               	 	<?php
                        					for($j=0;$j<$ddProductType;$j++){ 
                        			?>	
                                		<option value="<?php echo $ProductTypeID[$j]; ?>"><?php echo $ProductTypeName[$j]; ?></option>
                                	<?php
                        					}
                        			?>
									</select> 
                                </td>
                            </tr>

                            <tr>
                                <td><label>ชื่อผู้จัดจำหน่าย :</label></td>
                                <td>
	                                <select id="supplier" name="drSupplierProduct">
											  <option value="" selected>------ กรุณาเลือก ------</option>
                               	 	<?php
                        					for($j=0;$j<$ddSupplierName;$j++){ 
                        			?>	
                                		<option value="<?php echo $SupplierID[$j]; ?>"><?php echo $SupplierName[$j]; ?></option>
                                	<?php
                        					}
                        			?>
									</select> 
                                </td>
                            </tr>

                            <tr>
                                <td><label>ชื่อยี่ห้อ :</label></td>
                                <td>
                                	<select id="brands" name="drBrandsProduct">
										  <option value="" selected>------ กรุณาเลือก ------</option>
                               	 	<?php
                        					for($j=0;$j<$ddBrandName;$j++){ 
                        			?>	
                                		<option value="<?php echo $BrandID[$j]; ?>"><?php echo $BrandName[$j]; ?></option>
                                	<?php
                        					}
                        			?>
									</select> 
								</td>
                            </tr>

                            <tr>
                                <td><label>ชื่อสินค้า :</label></td>
                                <td><input type="text" id="txtProductName" name="txtProductName"></td>
                            </tr>

							<tr>
                                <td><label><span class="red-star">* </span>น้ำหนักสินค้า :</label></td>
                                <td>
                                	<input type="text" id="txtProductWeight" name="txtProductWeight" >
                                	<label>กิโลกรัม/ถุง</label>
                                </td>
                            </tr>

                            <tr>
                                <td><label><span class="red-star">* </span>ราคาทุน :</label></td>
                                <td>
                                	<input type="text" id="txtCost" name="txtCost" >
                                	<label>บาท</label>
                                </td>
                            </tr>

                            <tr>
                                <td><label><span class="red-star">* </span>ราคาขาย :</label></td>
                                <td>
                                	<input type="text" id="txtPrice" name="txtPrice" >
                                	<label>บาท</label>
                                </td>
                            </tr>

                            <tr>
                                <td><label>อัพโหลดรูป:</label></td>
                                <td>
                                	<input type="file" id="imageProduct" name="imageProduct" >
                                </td>
                            </tr>

                            <tr> <td><input type="hidden" id="txtProductAmount" name="txtProductAmount"></td></tr>

                            <tr> <td>&nbsp;</td></tr>
                            <tr> <td>&nbsp;</td></tr>

                            <tr>
                                    <td><a href="product.php"><button type="button" id="btnBack">กลับไปหน้าหลัก</button></a></td>
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
