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

		<link href="css/productEdit.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
		<link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
		<script type="text/javascript" src="js/productEdit.js"></script>


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
									
<!-- 									<li><a href="#">ตรวจสอบข้อมูล</a>
				                        <ul>
												<li><a href="#">การสั่งซื้อสินค้า</a></li>
												<li><a href="#">การเคลมสินค้า</a></li>
												
										</ul>
			                        </li> -->
									
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
			$result = $dbManagement->select("SELECT * FROM product where ProductID='" . $_REQUEST['ProductID'] . "'");
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
			$i = 0;
			if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
			        $ProductID[$i] = $row["ProductID"];
			        $ProductTypeID[$i] = $row["ProductTypeID"];
			        $SupplierID[$i] = $row["SupplierID"];
			        $BrandID[$i] = $row["BrandID"];
			        $ProductName[$i] = $row["ProductName"];
			        $ProductWeight[$i] = $row["ProductWeight"];
			        $Cost[$i] = $row["Cost"];
			        $Price[$i] = $row["Price"];
			        $ImageProduct[$i] = $row["ImageProduct"];
			        $i++;
			    }
			}
		?>

	<form action="editProductSQL.php" method="post" enctype="multipart/form-data">
		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l">

						<h2>แก้ไขข้อมูลสินค้า</h2>
                       
                        <table id="table" style="width: 100%">

                                <input type="hidden" id="txtProductID" name="txtProductID" value="<?php echo $ProductID[0]; ?>">
                            

                            <tr>
                                <td><label>ประเภทสินค้า:</label></td>
                                <td>
                                	<select id="type" name="drtypeProduct">
                                			  <option value="<?php echo $ProductTypeID[0]; ?>" selected><?php echo $ProductTypeName[0]; ?></option>
											  <option value="" >------ กรุณาเลือก ------</option>
                              	 	<?php
                        					for($p=0;$p<$ddProductType;$p++){ 
                        			?>	
                                			<option value="<?php echo $ProductTypeID[$p]; ?>"><?php echo $ProductTypeName[$p]; ?></option>
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
	                                		  <option value="<?php echo $SupplierID[0]; ?>" selected><?php echo $SupplierName[0]; ?></option>
											  <option value="" >------ กรุณาเลือก ------</option>
                              	 	<?php
                        					for($s=0;$s<$ddSupplierName;$s++){ 
                        			?>	
                                		<option value="<?php echo $SupplierID[$s]; ?>"><?php echo $SupplierName[$s]; ?></option>
                                	<?php
                        					}
                        			?>
									</select> 
                                </td>
                            </tr>
                            <tr>
                                <td><label>ชื่อยี่ห้อ :</label></td>
                                <td>
                                	<select id="brandProduct" name="drBrandsProduct">
                                	      <option value="<?php echo $BrandID[0]; ?>" selected><?php echo $BrandName[0]; ?></option>
										  <option value="">------ กรุณาเลือก ------</option>
                               	 	<?php
                        					for($b=0;$b<$ddBrandName;$b++){ 
                        			?>	
                                		<option value="<?php echo $BrandID[$b]; ?>"><?php echo $BrandName[$b]; ?></option>
                                	<?php
                        					}
                        			?>
									</select> 
								</td>
                            </tr>
                            <tr>
                                <td><label>ชื่อสินค้า :</label></td>
                                <td><input type="text" id="txtProduct" name="txtProduct" value="<?php echo $ProductName[0]; ?>"> </td>
                            </tr>

							<tr>
                                <td><label><span class="red-star">* </span>น้ำหนักสินค้า :</label></td>
                                <td>
                                	<input type="text" id="txtProductWeight" name="txtProductWeight" value="<?php echo $ProductWeight[0]; ?>" reguired>
                                	<label>กิโลกรัม/ถุง</label>
                                </td>

                            </tr>

                            <tr>
                                <td><label><span class="red-star">* </span>ราคาทุน :</label></td>
                                <td> 
                                	<input type="text" id="txtCost" name="txtCost" value="<?php echo $Cost[0]; ?>" reguired>
                                	<label>บาท</label>
                                </td>
                            </tr>

                            <tr>
                                <td><label><span class="red-star">* </span>ราคาขาย :</label></td>
                                <td>
                                	<input type="text" id="txtPrice" name="txtPrice" value="<?php echo $Price[0]; ?>" reguired>
                                	<label>บาท</label>
                                </td>
                            </tr>

                            <tr>
                                <td><label>อัพโหลดรูป:</label></td>
                                <td>
                                	<input type="file" id="imageProduct" name="imageProduct">
                                </td>
                            </tr>

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
