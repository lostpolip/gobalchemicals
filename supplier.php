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

		<link href="css/supplier.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
		<link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/ddsmoothmenu.js"></script>


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
		  							<a href="logOutBack.php"><input type="button" name="Search" value="" alt="Search" id="searchbutton" class="sub_btn"  /></a>
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
			$result = $dbManagement->select("SELECT SupplierID,SupplierName,SupplierTel,SupplierEmail 
											 FROM supplier
											 WHERE StateSupplier = 'confirm'
											 ");

			$i = 0;
			if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
			        $SupplierID[$i] = $row["SupplierID"];
			        $SupplierName[$i] = $row["SupplierName"];
			        $SupplierTel[$i] = $row["SupplierTel"];
			        $SupplierEmail[$i] = $row["SupplierEmail"];
			        $i++;
			    }
			}
		?>	

		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l">

					<h2>ผู้จัดจำหน่าย</h2>
                        <p>
                            <button id="btnAdd"><a href="supplierAdd.php">เพิ่มผู้จัดจำหน่าย</a></button>
                        </p>
<!--                         <table id="table" style="width: 100%">
                            <tr>
                                <td><label>ค้นหาข้อมูล</label> &nbsp;&nbsp;
                                    <input ID="txtSearch"></input>
                                &nbsp;&nbsp;
                                   <Button id="btnOK">ตกลง</Button>
                                </td>
                            </tr>                           
                        </table>   -->

				</div>
			</div>	
						<table id="table2" width="100%">
			        		<tr>
                        		<th>รหัสผู้จัดจำหน่าย</th>
                                <th>ชื่อผู้จัดจำหน่าย</th>
                                <th>เบอร์โทรศัพท์</th>
                                <th>Email</th>
                                <th>คำสั่ง</th>
                                
                        	</tr>

                        	<?php
                        	for($j=0;$j<$i;$j++){ 
                        	?>		
                        	<tr>

                        	<tr>
                        		<td id="supplierid"><?php echo $SupplierID[$j] ?></td>
                        		<td id="suppliername"><?php echo $SupplierName[$j] ?></td>
                        		<td id="suppliertel"><?php echo $SupplierTel[$j] ?></td>
                        		<td id="supplieremail"><?php echo $SupplierEmail[$j] ?></td>
                        		<td>
                        			<button id="btnDetail"><a href="supplierDetail.php?SupplierID=<?php echo $SupplierID[$j]; ?>">รายละเอียด</a></button>
                        			<button id="btnEdit"><a href="supplierEdit.php?SupplierID=<?php echo $SupplierID[$j]; ?>">แก้ไข</a></button>
                        			<button id="btnDelete"><a href="deleteSupplierSQL.php?SupplierID=<?php echo $SupplierID[$j]; ?>">ลบ</a></button>
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
