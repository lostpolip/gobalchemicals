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

		<link href="css/productPurchaseAdd.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
		<link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
		<script type="text/javascript" src="js/productPurchase.js"></script>
	
		

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
									<li><a href="#">จัดการข้อมูล</a>
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
			$product = $dbManagement->select("SELECT * FROM product");
			$supplier = $dbManagement->select("SELECT * FROM supplier");

			$ddProduct = 0;
			if (mysqli_num_rows($product) > 0) {
			    while($row = mysqli_fetch_assoc($product)) {
			        $ProductID[$ddProduct] = $row["ProductID"];
			        $ProductName[$ddProduct] = $row["ProductName"];
			        $ddProduct++;
			    }
			   
			}


			$ddSupplier = 0;
			if (mysqli_num_rows($supplier) > 0) {
			    while($row = mysqli_fetch_assoc($supplier)) {
			        $SupplierID[$ddSupplier] = $row["SupplierID"];
			        $SupplierName[$ddSupplier] = $row["SupplierName"];
			        $ddSupplier++;
			    }
			   
			}
		?>
	<form action="productPurchaseAddSQL.php">
		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l">

					<h2>สั่งสินค้า</h2>
                    <table id="table" style="width: 100%">
                        	<tr>
                                <td><input type="hidden" id="txtPurchaseID" name="txtPurchaseID"></td>
                            </tr>
                            <tr>
                                <td><label><span class="red-star">* </span>ชื่อสินค้า :</label></td>                       
                                <td><select id="ddProduct" name="ddProduct" >
                                	 	<option value="" selected>-------- กรุณาเลือก --------</option>
                                	 	<?php
                        					for($p=0;$p<$ddProduct;$p++){ 
                        				?>	
                                		<option value="<?php echo $ProductID[$p]; ?>"><?php echo $ProductName[$p]; ?></option>
                                		<?php
                        					}
                        				?>
                                	</select>
                                </td>
                            </tr>


                            <tr id="row_productType">
                                <td><label>ประเภทสินค้า:</label></td>
                                <td><label id="ddProductType" name="ddProductType"></label></td>
                            </tr>

                            <tr id="row-brandName">
                                <td><label>ยี่ห้อ:</label></td>
                                <td><label id="ddBrandName" name="ddBrandName"></label></td>
                            </tr>

                            <tr id="row-supplier">
                                <td><label>ผู้จัดจำหน่าย:</label></td>
                                <td><label id="ddSupplier" name="ddSupplier"></label>
                         			<input type="hidden" id="supplierId" name="supplierId" value="<?php echo $SupplierID[0]; ?>">
                                </td>
                            </tr>

                            <tr id="row-supplierEmail">
                            	<td><label>Email:</label></td>
                                <td><label id="txtSupplierEmail" name="txtSupplierEmail"></label></td>      
                            </tr>


                            <tr>
                                <td><label><span class="red-star">* </span>จำนวนสินค้า :</label></td>
                                <td><input type="text" id="txtProductAmount" name="txtProductAmount" value="0" required>&nbsp;&nbsp;
                                	<label>ตัน</label> 
                                </td>
                            </tr>

                           <tr>
                                <td><label>รายละเอียดเพิ่มเติม :</label></td>
                                <td><textarea id="txtPurchaseDetail" name="txtPurchaseDetail" ></textarea>
                            </tr>                           

                            <tr> <td><input type="hidden" id="txtPurchaseState" name="txtPurchaseState"></td>
                            </tr>

                            <tr> <td>&nbsp;</td></tr>

                            <tr>
                            		<td><a href="productPurchase.php"><button type="button" id="btnBack">กลับไปหน้าหลัก</button></a></td>
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

