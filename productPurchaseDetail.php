<?php
	session_start();
	if(!isset($_SESSION['EmployeeName'])){
		header( "location: /gobalchemicals/indexLogin.html" );
	}
	if (!($_SESSION['PositionID'] == 2 || $_SESSION['PositionID'] == 1)) {
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

		<link href="css/productPurchaseDetail.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
		<link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
		<script type="text/javascript" src="js/productPuchaseDetail.js"></script>
	
		

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
									
									<li><a href="#" class="selected">คลังสินค้า</a>
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
			$result = $dbManagement->select("SELECT * FROM `purchase`
												LEFT JOIN `supplier`ON purchase.SupplierID=supplier.SupplierID
												LEFT JOIN `product`ON purchase.ProductID=product.ProductID
												WHERE PurchaseID ='" . $_REQUEST['PurchaseID'] . "'");
			
			$product = $dbManagement->select("SELECT * FROM `product`
												JOIN producttype ON product.ProductTypeID=producttype.ProductTypeID
												JOIN brand ON product.BrandID=brand.BrandID");

			$i = 0;
			if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
			    	$PurchaseID[$i] = $row["PurchaseID"];
			    	$PurchaseDate[$i] = $row["PurchaseDate"];
			    	$SupplierID[$i] = $row["SupplierID"];
			    	$SupplierName[$i] = $row["SupplierName"];
			    	$SupplierEmail[$i] = $row["SupplierEmail"];
			    	$ProductID[$i] = $row["ProductID"];
			    	$ProductName[$i] = $row["ProductName"];
			    	$PurchaseAmount[$i] = $row["PurchaseAmount"];
			    	$PurchaseDetail[$i] = $row["PurchaseDetail"];

			        $i++;
			    }
			}

			$i = 0;
			if (mysqli_num_rows($product) > 0) {
			    while($row = mysqli_fetch_assoc($product)) {
			    	$ProductTypeID[$i] = $row["ProductTypeID"];
			    	$ProductTypeName[$i] = $row["ProductTypeName"];
			    	$BrandID[$i] = $row["BrandID"];
			    	$BrandName[$i] = $row["BrandName"];


			        $i++;
			    }
			}										

		?>
		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l">

					<h2>สั่งสินค้า</h2>
                    <table id="table" style="width: 100%">
                        	<tr>
                                <td>รหัสการสั่งซื้อ:</td>
                                <td><label id="txtPurchaseID"><?php echo ($PurchaseID[0]); ?></label></td>
                            </tr>

                        	<tr>
                                <td>วันที่สั่งซื้อ:</td>
                                <td><label id="txtDatePurchase"><?php echo ($PurchaseDate[0]); ?></label></td>
                            </tr>

                            <tr>
                            	<td>ผู้จัดจำหน่าย:</td>
                                <td><label id="ddSupplier"><?php echo ($SupplierName[0]); ?></label></td>
                            </tr>

                            <tr>
                            	<td>Email:</td>
                                <td><label id="ddSupplier"><?php echo ($SupplierEmail[0]); ?></label></td>
                            </tr>

                            <tr>
                                <td>ประเภทสินค้า:</td>
                                <td><label id="ddProductType"><?php echo ($ProductTypeName[0]); ?></label></td>
                            </tr>

                            <tr>
                                <td>ยี่ห้อ:</td>                           
                                <td><label id="ddBrandName"><?php echo ($BrandName[0]); ?></label></td>
                            </tr>

                            <tr>
                                <td>ชื่อสินค้า :</td>                           
                                <td><label id="ddProduct"><?php echo ($ProductName[0]); ?></label></td>                       
                            </tr>

                            <tr>
                                <td>จำนวนสินค้า :</td>                           
                                <td><label id="txtProductAmount"><?php echo ($PurchaseAmount[0]); ?></label>&nbsp;&nbsp;&nbsp;ตัน</td>
                            </tr>

                           <tr>
                                <td>รายละเอียดเพิ่มเติม :</td>
                                <td><label id="txtPurchaseDetail"><?php echo ($PurchaseDetail[0]); ?></label></td>
                            </tr>                           

                            <tr> <td><input type="hidden" id="txtPurchaseState" name="txtPurchaseState"></td>
                            </tr>

                            <tr> <td>&nbsp;</td></tr>

                            <tr>
                            		<td><a href="productPurchase.php"><button type="button" id="btnBack">กลับไปหน้าหลัก</button></a></td>

                            </tr>

                        </table>
				</div>
			</div>
		</div><!--end of tooplate_main-->


		<div id="tooplate_footer_wrapper">
			<div id="tooplate_footer">
					Copyright © 2016 <a href="#">The GobalChemicals CO.,LTD.</a>
				<div class="cleaner"></div><!--end of tooplate_footer-->
			</div><!--end of tooplate_footer-->
		</div> <!--end of tooplate_footer_wrapper-->

	
	</body>
</html>
