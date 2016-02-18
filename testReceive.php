<?php
	session_start();
	if(!isset($_SESSION['EmployeeID'])){
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

		<link href="css/productReceiveAdd.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
		<link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/ddsmoothmenu.js"></script>		
		<script type="text/javascript" src="js/testReceive.js"></script>

	

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
			$result = $dbManagement->select("SELECT * FROM `product` 
												JOIN supplier ON product.SupplierID=supplier.SupplierID
												JOIN brand ON product.BrandID=brand.BrandID
												JOIN producttype ON product.ProductTypeID=producttype.ProductTypeID");

			$i = 0;
			if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
			        $ProductID[$i] = $row["ProductID"];
			        $ProductName[$i] = $row["ProductName"];
			        $ProductAmount[$i] = $row["ProductAmount"];
			        $SupplierID[$i] = $row["SupplierID"];
			        $SupplierName[$i] = $row["SupplierName"];
			        $BrandID[$i] = $row["BrandID"];
			        $BrandName[$i] = $row["BrandName"];
			        $ProductTypeID[$i] = $row["ProductTypeID"];
			        $ProductTypeName[$i] = $row["ProductTypeName"];
			        $ProductAmount[$i] = $row["ProductAmount"];
			        $i++;
			    }
			}
		?>

	<!-- <form action="productReceiveAddSQL.php"> -->
		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l">

					<h2>รับสินค้า</h2>
                    <table id="table" style="width: 100%">
                        	<tr>
                                <td><input type="hidden" id="txtReceiveID" name="txtReceiveID"></td>
                            </tr>

                        	<tr>
                                <td><label>วันที่รับสินค้า:</label></td>
                                <td><input type="date" id="txtDateReceive" name="txtDateReceive"></td>
                            </tr>

                        	<tr>
                                <td><label><span class="red-star">* </span>Lot Number:</label></td>
                                <td><input type="text" id="txtLotReceive" name="txtLotReceive" required></td>
                            </tr>

							<tr>
                                <td><label><span class="red-star">* </span>วันหมดอายุ :</label></td>
                                <td><input type="date" id="txtExpiryDate" name="txtExpiryDate"></td>

                            </tr> 
                       </table>
                       <br>
						<table id="table2" width="100%">
                        	<tr>
                        		<th>รหัสสินค้า</th>
                        		<th>ผู้จัดจำหน่าย</th>
                        		<th>ยี่ห้อ</th>
                                <th>ประเภทสินค้า</th>
                                <th>ชื่อสินค้า</th>
                                <th>เพิ่มสินค้า</th>
                                <th>สินค้าทั้งหมด</th>
                                <th>เพิ่ม</th>
                                
                        	</tr>
                        	<?php
                        	for($j=0;$j<$i;$j++){ 
                        	?>
                        	<tr>
                        		<td id="productid" name="ddProduct" value="<?php echo $ProductID[$j]; ?>"><?php echo $ProductID[$j]; ?></td>
                        		<td id="supplierid"><?php echo $SupplierName[$j]; ?></td>
                        		<td id="brandid"><?php echo $BrandName[$j]; ?></td>
                        		<td id="producttypeid"><?php echo $ProductTypeName[$j]; ?></td>
                        		<td id="productname"><?php echo $ProductName[$j]; ?></td>
                        		<td>
                        			<input type="text" id="<?php echo 'totalreceiveAmount' . $ProductID[$j]; ?>" name="txtReceiveAmount" value="0" >&nbsp;&nbsp;
                                	<label>ตัน</label> 
                        		</td>
                        		<td>
                                	<label id="<?php echo 'totalamountProduct' . $ProductID[$j];?>"></label> 
                        		</td>
                        		<td><button name="receive" data-productid="<?php echo $ProductID[$j]; ?>" data-productamount="<?php echo $ProductAmount[$j]; ?>" class="btn btn-success">เพิ่ม</button>
                        		</td>
                        	</tr>
                        	<?php
                        	}
                        	?>

                        </table>  
                        <br>   
                         <table id="table" style="width: 100%">
							<tr> 
								<td><label>คิดเป็น</label></td>
								<td><label id="LabelAmount" name="LabelAmount"></label>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>ถุง</label></td>
							</tr> 

                            <tr> <td><input type="hidden" id="txtReceiveState" name="txtReceiveState"></td>
                            </tr>

                            <tr> <td>&nbsp;</td></tr>

                            <tr>
                            		<td><a href="productReceive.php"><button type="button" id="btnBack">กลับไปหน้าหลัก</button></a></td>
                                    <td><button type="submit" id="btnCF">บันทึก</button></td>
                                    
                            </tr>

                        </table>
				</div>
			</div>
		</div><!--end of tooplate_main-->
	<!-- </form> -->

		<div id="tooplate_footer_wrapper">
			<div id="tooplate_footer">
	        
				<div class="col_w240">
						<h4>ติดต่อสอบถามรายละเอียดเพิ่มเติม</h4>
					<ul class="footer_link">
						<li>สถานที่ติดต่อ :&nbsp; 87/84&nbsp; หมู่ 2&nbsp; ตำบลบางพลับ&nbsp; อำเภอปากเกร็ด&nbsp; จังหวัดนนทบุรี&nbsp; 11120</li>
						<li>โทรศัพท์ : (668) 188-9525-0&nbsp;&nbsp; Fax : (662) 554-300</li>
						<li>Email : nantiyathongpriwan@gmail.com</li>
					</ul>
				</div>
			
				
				<div class="cleaner h40"></div>
					Copyright © 2016 <a href="#">The GobalChemicals CO.,LTD.</a>
				<div class="cleaner"></div><!--end of tooplate_footer-->
			</div><!--end of tooplate_footer-->
		</div> <!--end of tooplate_footer_wrapper-->

	
	</body>
</html>
